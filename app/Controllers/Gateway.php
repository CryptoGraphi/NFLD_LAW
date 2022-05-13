<?php


/// payment proccessor for our application 

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\Auth\Auth;
use App\Controllers\Orders;



class Gateway extends BaseController
{
	public function __construct()
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		// only allow post requests to this controller.... 
		if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
			http_response_code(405);
			die();
		}

		// make sure the user is logged in before accessing the payment gateway. 
		if (!Auth::isLoggedIn()['status']) {
			die(Auth::deny());
		}

		// share objects 

		$this->order = new Orders();
	}

	/**
	 * 
	 * @method: proccess 
	 * 
	 * @purpose: inorder to process the payment for the digital assets purchases. 
	 * 
	 * 
	 * @param [type] $documentName
	 * @param [type] $paymentType
	 * @return void
	 * 
	 * 
	 */

	public function proccess($documentName = null, $paymentType = null)
	{
		// for only support the following a paid document purchase 
		// and free documents
		
		if ($paymentType === 'free') {
			// free documents here.... 
			return $this->order->freeOrder($documentName);
		}

		// for the paid documents.. 
		return $this->order->paidOrder($documentName);
	}
}
