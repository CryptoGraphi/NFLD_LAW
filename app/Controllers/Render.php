<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Users;
use App\Services\Auth\Auth;
use App\Controllers\Contracts;
use App\Models\DocumentStorage;
use Dompdf\Dompdf;
use sessionManager;
use documentEnforcer;


class Render extends BaseController
{

	public function __construct()
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		// make sure the user is logged in inorder to access the page 
		// if not, redirect to the login page
		if (!Auth::isLoggedIn()['status']) {
			return Auth::deny();
		}

	}

	public function index()
	{
		// init the functions of the class 
	}
	
	/**
	 * 
	 *  @method: contract 
	 * 
	 *  @purpose: inorder to display contracts in the application
	 * 
	 */

	public function contract($contractType = null)
	{
		return Contracts::create($contractType);
	}
	
	/**
	 * 
	 *   @method: fetchContract 
	 * 
	 *  @purpose: inorder to fetch the contract from the database
	 * 
	 */


	public function fetchContract($PRODUCT = null)
	{
		helper('documentEnforcer');
		$accessToken = $_SESSION['SESSION_AUTH_HANDSHAKE'];
		$userModel = new Users();
		$documentData = new DocumentStorage();
		$userData = $userModel->lookupBySessionID($accessToken);
		$userID = $userData['userID'];
		$documentData = $documentData->lookupDocuments($userID);

		// load our document Enforcer class
		$documentEnforcer = new documentEnforcer($documentData);

		if ($documentEnforcer->verifyObjectData($documentData) === true) {
			// proccess to filter the document 
			if ($blob = $documentEnforcer->verifyDocumentKey($documentData, $PRODUCT)) {
				// send it for proccessing 
				$this->output($blob);
			} else {
				// document not found 
				return $this->display404Error();
			}
		} else {
			// 404
			return $this->display404Error();
		}
	}
	

	/**
	 * 
	 *  @method: display404Error 
	 * 
	 *  @purpose: inorder to trigger a 404 error within the system 
	 * 
	 */

	private function display404Error()
	{
		http_response_code(404);
		return view('/errors/html/error_404');
	}

	/** 
	 * 
	 *  @method: display404Error 
	 * 
	 *  @purpose: inorder to display a 404 error within the system if a edgecase is met. 
	*/


	private function display400Error()
	{
		http_response_code(400);
		die('bad request');
	}

	/**
	 * 
	 * @method: output
	 * 
	 * @purpose: inorder to preform the render on the said document with in the system. 
	 * 
	 */

	private function output($data)
	{

		if ($data['documentType'] === 'lastwill') {
			$dompdf = new Dompdf();
			$contractData = filter_var_array(json_decode($data['documentData'], true), FILTER_DEFAULT);

			$dompdf->loadHtml(view('/render/template/contract_lastwill', $contractData));
			$dompdf->setPaper('A4', 'landscape');
			$dompdf->render();
			$dompdf->stream();
		} else if ($data['documentType'] === 'poa') {
			$dompdf = new Dompdf();
			$contractData = filter_var_array(json_decode($data['documentData'], true), FILTER_DEFAULT);

			$dompdf->loadHtml(view('/render/template/contract_poa', $contractData));
			$dompdf->setPaper('A4', 'landscape');
			$dompdf->render();
			$dompdf->stream();
		} else {
			// something went wrong error display
			return $this->display400Error();
		}
	}

	/**
	 * 
	 *  @method: deleteContract 
	 * 
	 * 	@purpose: inorder to deleteContracts within the system 
	 * 
	 */

	public function deleteContract($productKey = null)
	{
		helper('documentEnforcer');
		$accessToken = $_SESSION['SESSION_AUTH_HANDSHAKE'];
		$userModel = new Users();
		$documentData = new DocumentStorage();
		$userData = $userModel->lookupBySessionID($accessToken);
		$userID = $userData['userID'];
		$data = $documentData->lookupDocuments($userID);

		// load our document Enforcer class
		$documentEnforcer = new documentEnforcer($data);

		if ($documentEnforcer->verifyObjectData($data) === true) {
			// proccess to filter the document 
			if ($blob = $documentEnforcer->verifyDocumentKey($data, $productKey)) {
				// send it for proccessing 
				// show the success page 
				echo view('/dashboard/template/header');

				if ($documentData->deleteDocument((int) $blob['documentID']) === true) {
					die(view('/dashboard/accounts/failed'));
				} else {
					die(view('/render/delete_success'));
				}
			} else {
				// document not found 
				return $this->display404Error();
			}
		} else {
			// 404
			return $this->display404Error();
		}
	}

	/**
	 *  
	 *  @method: pdf
	 * 
	 *  @purpose: to get a pdf based on if our document session has been met or not. 
	 * 
	 */



	public function pdf()
	{
		$data = $_SESSION['DOCUMENT_RAW_DATA'];
		
		// check to see if the payment gateway set our flag in our document inorder  
		// to let us access the resource
		if ($data['contractPaymentStatus'] === true) {

			switch ($data['contractType']) {
				case 'lastwill':
					$dompdf = new Dompdf();
					$dompdf->loadHtml($data['contractContent']);
					$dompdf->setPaper('A4', 'landscape');
					$dompdf->render();
					$dompdf->stream();
					break;

				case 'poa':
					$dompdf = new Dompdf();
					$dompdf->loadHtml($data['contractContent']);
					$dompdf->setPaper('A4', 'landscape');
					$dompdf->render();
					$dompdf->stream();
					break;

				default:
					// display error page not found 
					http_response_code(403);
					echo view('/dashboard/template/header');
					die(view('/render/documentFailure'));
					echo view('/dashboard/template/footer');
					break;
			}
		} else {
			// trigger error page
			http_response_code(403);
			echo view('/dashboard/template/header');
			die(view('/render/documentFailure'));
		}
	}
}
