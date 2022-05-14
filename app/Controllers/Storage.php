<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\Auth\Auth;
use Dompdf\Dompdf;
use App\Controllers\Render;

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
     * 
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
        // this will add a new document to the database.
        
        // temp while we do some testing
      /*   if ($_SERVER['REQUEST_METHOD'] !== 'POST')
        {
            http_response_code(405);
            die();
        } */


        

        // add the document to the database.... 



        // create file in the file syste

    }


    /***
     * 
     *  
     *  @method: download 
     * 
     *  @purpose: to download a document from the storage
     */

     public function download($document = null)
     {
         // this will download a document from the storage. 
     }


     /***
      *
      *  @method: delete
      *
      *
      *  @purpose: to delete a document from the storage
      */

      public function delete()
      {

      }

      /**
       * 
       *  @method: get
       * 
       *  @purpose: to get all the records from  the storage that 
       *            the user is associated with.
       *  
       */

       public function get()
       {

       }
}
