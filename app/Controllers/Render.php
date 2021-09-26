<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use Dompdf\Dompdf;

class Render extends BaseController
{
	public function __construct()
	{
		session_start();
	}
	public function index()
	{
		// init the functions of the class 
	}

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
				$contract = filter_var_array(json_decode($_POST['__data__'], true), FILTER_SANITIZE_STRING);

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
					
					

					var_dump($_POST);
					echo view('/render/paymentPage', $data);

				break;
		}

		echo view('/dashboard/template/footer');
	}


	// fetch the document via the documet key 
	// the user to download 


	public function fetchContract($PRODUCT = null)
	{

	}


	public function deleteContract($productKey = null) {
		
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
