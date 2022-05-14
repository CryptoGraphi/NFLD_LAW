<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\Auth\Auth;
use Dompdf\Dompdf;
use App\Controllers\Render;
use App\Models\Orders;
use App\Models\Documents;
use App\Models\Users;


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

    /** 
     * 
     *  @method: add 
     *  
     *  @purpose: to add a new document to the storage
     * 
     */

    public function add($document = null)
    {
        // check if the document null or empty 
        // and the request is a post request
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            die();
        }

        // does the upload directory exist?
        if (!file_exists($this->storageLocation)) {
            mkdir($this->storageLocation, 0777, true);
        }

        // check to make sure that we have vaild data
        if (empty($_SESSION['DOCUMENT_RAW_DATA']) || empty($_SESSION['DOCUMENT_RAW_DATA']['contractContent'])) {
            http_response_code(400);
            die();
        }

        // get the raw data inorder to form our pdf file. 
        $documentData = isset($_SESSION['DOCUMENT_RAW_DATA']) ? $_SESSION['DOCUMENT_RAW_DATA'] : null;
        $pdfBlob = $this->render($documentData['contractContent']);
        $fileNameHash = hash('sha256', time() . random_bytes(32));

        // do the file operations 
        $fp = fopen($this->storageLocation . $fileNameHash . '.pdf', 'w');
        $filePath = $this->storageLocation . $fileNameHash . '.pdf';

        // make sure we get a file pointer returned
        if ($fp)
        {   
            fwrite($fp, $pdfBlob);
            fclose($fp);
        }
        
        // load our models in order to save the data to the database
        $document = new Documents();
        $orders = new Orders();
        // create our documents entry 
        $documentID = $document->add($filePath);
        $user = new Users();
        $userID = $user->getUserByToken($_SESSION['token'])['id'];
        // now we need to create our order entry
        $orders->add($userID, 250, date('Y-m-d H:i:s'), $documentID);

        // lets do some checks to make sure everything is working as expected
        if ($documentID && $orders) {
            return true;
        }
        return false;
    }
    
}
