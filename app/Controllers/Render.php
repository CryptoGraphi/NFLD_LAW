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
					die(view('/render/paymentPage', $_SESSION['DOCUMENT_RAW_DATA']));
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
		}

		echo view('/dashboard/template/footer');
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
