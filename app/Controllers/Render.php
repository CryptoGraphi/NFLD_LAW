<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Users;
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

		echo view('/dashboard/template/header');
		switch ($contractType) {
			case "lastwill":

				if (empty($_POST['__data__'])) {
					$error = [
						"FormSubmissionError" => "Please complete form, a empty form will not be accepted"
					];

					die(view('/render/paymentPage', $error));
				}
				$contract = json_decode($_POST['__data__'], true);

				$_SESSION['DOCUMENT_JSON_DATA'] = $contract;

				$data = [
					"contractData" => $contract,
					"contractType" => $contractType,
					"contractTitle" => "Last Will, and Testament",
					"contractContent" => view('/render/template/contract_lastwill', $contract),
					"contractPayment" => 'true', // is a paid document
					"contractPaymentStatus" => null, // check if payment went though before verifying anything in our rending
				];

				$_SESSION['DOCUMENT_RAW_DATA'] = $data;
				echo view('/render/paymentPage', $data);
				break;


			case "poa":

				if (empty($_POST['_data_'])) {
					$error = [
						"FormSubmissionError" => "Please complete form, a empty form will not be accepted"
					];

					die(view('/render/paymentPage', $error));
				}

				$contract = filter_var_array(json_decode($_POST['_data_'], true), FILTER_SANITIZE_STRING);

				$_SESSION['DOCUMENT_JSON_DATA'] = $contract;


				$data = [
					"contractData" => $contract,
					"contractType" => $contractType,
					"contractTitle" => "Power of Attorney",
					"contractContent" => view('render/template/contract_poa', $contract),
					"contractPayment" => 'true',
					"contractPaymentStatus" => null,
				];

				$_SESSION['DOCUMENT_RAW_DATA'] = $data;
				echo view('/render/paymentPage', $data);

				break;
		}

		echo view('/dashboard/template/footer');
	}


	// fetch the document via the documet key 
	// the user to download 


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
	// return our error for the program if 
	// document where not even sent
	private function display404Error()
	{
		http_response_code(404);
		return view('/errors/html/error_404');
	}


	private function display400Error()
	{
		http_response_code(400);
		die('bad request');
	}

	// display document 

	private function output($data)
	{

		if ($data['documentType'] === 'lastwill') {
			$dompdf = new Dompdf();
			$contractData = filter_var_array(json_decode($data['documentData'], true), FILTER_SANITIZE_STRING);

			$dompdf->loadHtml(view('/render/template/contract_lastwill', $contractData));
			$dompdf->setPaper('A4', 'landscape');
			$dompdf->render();
			$dompdf->stream();
		} else if ($data['documentType'] === 'poa') {
			$dompdf = new Dompdf();
			$contractData = filter_var_array(json_decode($data['documentData'], true), FILTER_SANITIZE_STRING);

			$dompdf->loadHtml(view('/render/template/contract_poa', $contractData));
			$dompdf->setPaper('A4', 'landscape');
			$dompdf->render();
			$dompdf->stream();
		} else {
			// something went wrong error display
			return $this->display400Error();
		}
	}

	// delete contracts
	// delete the table entry 
	// but we will keep the purchase entry for our records 

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


	// get pdf based on if a our session has been set or not 
	public function pdf()
	{
		$data = $_SESSION['DOCUMENT_RAW_DATA'];


		// check to see if the payment gateway set our flag in our document inordr 
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
