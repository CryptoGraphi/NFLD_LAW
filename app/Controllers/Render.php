<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\Auth\Auth;
use App\Controllers\Contracts;
use Dompdf\Dompdf;


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
	 *  @method: display404Error 
	 * 
	 *  @purpose: in order to trigger a 404 error within the system 
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
	 *  @purpose: in order to display a 404 error within the system if a edge case is met. 
	*/


	private function display400Error()
	{
		http_response_code(400);
		die('bad request');
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
		// check that the data is set for our document. 
		if (!isset($_SESSION['DOCUMENT_RAW_DATA']))
		{
			return $this->display404Error();
		}
		// set the data and procceed. 
		$data = $_SESSION['DOCUMENT_RAW_DATA'];

		$dompdf = new Dompdf();
		$dompdf->loadHtml($data['contractContent']);
		$dompdf->setPaper('A4', 'landscape');
		$dompdf->render();
		$dompdf->stream("contract.pdf");
	}
}
