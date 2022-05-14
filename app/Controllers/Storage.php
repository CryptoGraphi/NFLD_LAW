<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\Auth\Auth;
use App\Controllers\Requests;
use Dompdf\Dompdf;
use App\Controllers\Render;
use App\Models\Orders;
use App\Models\Documents;
use App\Models\Users;
use CodeIgniter\HTTP\Request;

class Storage extends BaseController
{
    // default path of all the documents that will uploaded to the system...
    private $storageLocation = './uploads/contracts/';

    public function __construct()
    {
        //Do your magic here
        if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		// make sure the user is logged in before accessing the payment gateway. 
		if (!Auth::isLoggedIn()['status']) {
			die(Auth::deny());
		}
    }

    
    /**
     * 
     * 
     *  @method: render 
     * 
     *  @purpose: in order to render the raw pdf file
     * 
     *  @return: binary
     */

    private function render($rawData)
    {

        $dompdf = new Dompdf();
        $dompdf->loadHtml($rawData);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        return $dompdf->output();
    }


    /***
     * 
     *  @method: directoryExist 
     *  
     *  @purpose: inorder to check if a directory exists or not 
     * 
     */

     public function directoryExist($directory)
     {
        if (!file_exists($directory)) {
             mkdir($directory, 0777, true);
        }

        return true;
     }


     /**
      *   @method: sessionDataExist 
      *   
      *  @purpose: inorder to check if data exists 
      *
      */

    public function sessionDataExist()
    {
        if (empty($_SESSION['DOCUMENT_RAW_DATA']) || empty($_SESSION['DOCUMENT_RAW_DATA']['contractContent'])) {
            http_response_code(400);
            die();
        }

        if (!isset($_SESSION['DOCUMENT_RAW_DATA']['contractContent']) || !isset($_SESSION['DOCUMENT_RAW_DATA'])) {
            http_response_code(400);
            die();
        }

        return true;
    }


    /**
     * 
     *  @method: commitDatabaseEntry
     * 
     *  @purpose: in order to commit the data to the database
     * 
     */

    private function commitDatabaseEntry($filePath)
    {
        $document = new Documents();
        $orders = new Orders();
        $documentID = $document->add($filePath);
        $user = new Users();
        $userID = $user->getUserByToken($_SESSION['token'])['id'];
        $orders->add($userID, 250, date('Y-m-d H:i:s'), $documentID);

        if ($documentID && $orders) {
            return true;
        }
        return false;
    }

    /**
     * 
     * 
     *  @method: writeFile
     * 
     *  @purpose: in order to write the file to the system
     * 
     * 
     */

    private function writeFile()
    {
        $data = $_SESSION['DOCUMENT_RAW_DATA'];
        $pdfBlob = $this->render($data['contractContent']); 
        $fileName = hash('sha256', time() . random_bytes(10));

        $fp = fopen($this->storageLocation . $fileName . '.pdf', 'w');
        $path = $this->storageLocation . $fileName . '.pdf';
        fwrite($fp, $pdfBlob);
        fclose($fp);

        return $path;
    }
    
    /** 
     * 
     *  @method: add 
     *  
     *  @purpose: to add a new document to the storage
     * 
     */

    public function add($document = null)
    {
        if ($document != null )
        {
            if (Requests::post())
            {
                $this->directoryExist($this->storageLocation);
                $this->sessionDataExist();
                return $this->commitDatabaseEntry($this->writeFile());
            }
        }

        http_response_code(400);
        die();
    }   
    
}
