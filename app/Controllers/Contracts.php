<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\Auth\Auth;
use App\Models\Users;
use App\Models\Documents;
use App\Models\Orders;

/**
 *  
 *  @class: contracts 
 * 
 *  @purpose: to dispatch the contracts to the correct controller
 * 
 */


class Contracts extends BaseController
{

    /**
     *  
     *  @method: getContacts
     * 
     * 
     *  @purpose: to display the contracts page
     * 
     */

    static function getContracts($contract)
    {   
       
        
        $header = view('/dashboard/template/header');
        $footer = view('/dashboard/template/footer');

        // render the routes of the contracts page. 
		switch ($contract) {
			case "lastwill":

				$data = ['headerTitle' => 'LAST WILL AND TESTAMENT'];
                return $header .  view('/dashboard/contract/' . $contract, $data) . $footer;

			break;
			case 'poa':

				$data = ['headerTitle' => 'Power of attorney'];
				return $header .view('/dashboard/contract/' . $contract, $data) . $footer;
			break;

			default:
				return $header .  view('/dashboard/template/documentSelection'). $footer;
			break;
		}

    }


	/**
	 * 
	 *  @method: lastwill
	 * 
	 *  @purpose: to render the last will and testament page
	 * 
	 */

	 private static function lastwill($contractType)
	 {

		$header = view('/dashboard/template/header');
		$footer = view('/dashboard/template/footer');
		$contract = filter_var_array(json_decode($_POST['__data__'], true), FILTER_DEFAULT);

		$_SESSION['DOCUMENT_JSON_DATA'] = $contract;

		// set the data for the contract. 
		$data = [
			"contractData" => $contract,
			"contractType" => $contractType,
			"contractTitle" => "Last Will, and Testament",
			"contractContent" => view('/render/template/contract_lastwill', $contract),
			"contractPayment" => 'true', // is a paid document
			"contractPaymentStatus" => null, // check if payment went though before verifying anything in our rending
		];

		$_SESSION['DOCUMENT_RAW_DATA'] = $data;
		return $header . view('/render/paymentPage', $data) . $footer;
	 }


	 /**
	  *  @method: poa
	  *
	  *  @purpose: to render the power of attorney page

	  */

	 private static function poa($contractType)
	 {

		$footer = view('/dashboard/template/footer');
		$header = view('/dashboard/template/header');
		$contract = filter_var_array(json_decode($_POST['__data__'], true), FILTER_DEFAULT);

		$_SESSION['DOCUMENT_JSON_DATA'] = $contract;


		// set the data for the contract
		$data = [
			"contractData" => $contract,
			"contractType" => $contractType,
			"contractTitle" => "Power of Attorney",
			"contractContent" => view('render/template/contract_poa', $contract),
			"contractPayment" => 'true',
			"contractPaymentStatus" => null,
		];

		$_SESSION['DOCUMENT_RAW_DATA'] = $data;

		return $header.  view('/render/paymentPage', $data) . $footer;
		
	 }


	 /**
	  *  @method: download 
	  *
	  *  @purpose: to download the contract
	  *
	  */

	  public static function download($contractID)
	  {

		   if (Auth::isLoggedIn()) {
				// verify that sessions are activated 
				if (session_status() === PHP_SESSION_NONE) {
					session_start();
				}

				$userModel = new Users();
				// fetch the users id from the session
				$userID = $userModel->getUserByToken($_SESSION['token']) ? $userModel->getUserByToken($_SESSION['token'])['id'] : null;
				// fetch the document from the database
				$ordersModel = new Orders();
				$documentModel = new Documents();
				$currentDocument  = $ordersModel->where('user_id', $userID)->where('id', $contractID)->first();

				// check if the document exists
				if ($currentDocument)  {
					// check if the document is not empty
					$documentEntry = $documentModel->where('id', $currentDocument['document_id'])->first();
					// check if the file entry exists 
					if ($documentEntry)
					{
						$filePath = $documentEntry['path'];
						// perform test on some urls
						// check if the file exists 
						if (file_exists($filePath)) {
							// download the file
							header('Content-Description: File Transfer');
							header('Content-Type: application/octet-stream');
							header('Content-Disposition: attachment; filename="'.basename($filePath).'"');
							header('Expires: 0');
							header('Cache-Control: must-revalidate');
							header('Pragma: public');
							header('Content-Length: ' . filesize($filePath));
							readfile($filePath);
							exit;
						} 
					}
				}
				http_response_code(404);
				die();
		   }
		   http_response_code(405);
		   die;
	  }


	  /**
	   * 
	   *  @method: delete 
	   * 
	   *  @purpose: to delete the contract
	   * 
	   */

	   public static function delete($contractID)
	   {
		   // @description:
		   // first we need to verify the user own this said document.
		   // and if so then we will delete the document.
		   // and if the delete was successful then we will return a success message.

		   if (Auth::isLoggedIn()) {
			   if(session_status() === PHP_SESSION_NONE) {
				   session_start();
			   }

			   $userModel = new Users();
			   $userID = $userModel->getUserByToken($_SESSION['token']) ? $userModel->getUserByToken($_SESSION['token'])['id'] : null;
			   $ordersModel = new Orders();
			   $documentModel = new Documents();
			   $currentDocument  = $ordersModel->where('user_id', $userID)->where('id', $contractID)->first();

			   if ($currentDocument)  {

					$documentEntry = $documentModel->where('id', $currentDocument['document_id'])->first();
				   if ($documentEntry) {
					   $filePath = $documentEntry['path'];
					   if (file_exists($filePath)) {
						   unlink($filePath);
						   $documentModel->where('id', $documentEntry['id'])->delete();
						   $ordersModel->where('id', $currentDocument['id'])->delete();

						   $data = [
							   'success' => true,
							   'message' => 'The document has been deleted successfully.'
						   ];

						   // return the view with the success message. 
						   return view('/contracts/response', $data);
					   }
				   }
			   }
		   }
		   http_response_code(405);
		   die;
	}

    /**
     * 
     *  @method: create 
     * 
     *  
     *   @purpose: to create the contracts
     * 
     */

     static function create($contractType = null)
     {
        $header = view('/dashboard/template/header');
		$footer = view('/dashboard/template/footer');

		if (empty($_POST['__data__'])) {
			$error = [
				"FormSubmissionError" => "Please complete form, a empty form will not be accepted"
			];

			die($header . view('/render/paymentPage', $error) . $footer);
		}

		switch($contractType)
		{
			case 'lastwill':
				return self::lastwill($contractType);
			break;
				
			case 'poa':
				return self::poa($contractType);
			break;
		}

		return $header . view('/render/paymentPage', ['FormSubmissionError' => 'Contract type not found']) . $footer;
     }
}
