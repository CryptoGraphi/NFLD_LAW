<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Render extends BaseController
{
	public function index()
	{
		// init the functions of the class 
	}

	public function contract($contractType = null) 
	{

		echo view('/dashboard/template/header');
		switch($contractType) {
			case "lastwill":
				$contract = json_decode($_POST['__data__'], true);


				$data = [
					"contractData" => $contract,
					"contractType" => $contractType,
					"contractTitle" => "Last Will, and Testament",
					"contractContent" => view('/render/template/contract_lastwill')
				];
				echo view('/render/paymentPage', $data);
			
			break;

		}


		echo view('/dashboard/template/footer');
	}
}



