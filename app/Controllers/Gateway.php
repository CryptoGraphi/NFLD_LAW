<?php


/// payment proccessor for our application 

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\Auth\Auth;
use App\Controllers\Orders;
use App\Controllers\Requests;


class Gateway extends BaseController
{
	public function __construct()
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		if (!Auth::isLoggedIn()['status'] ) {
			die(Auth::deny());
		}
		// make sure requests is a post request for this controller. 
		Requests::post();
		$this->order = new Orders();
	}

	/**
	 * 
	 * @method: proccess 
	 * 
	 * @purpose: in order to process the payment for the digital assets purchases. 
	 * 
	 */

	public function proccess($documentName = null, $paymentType = null)
	{
	
		if ($paymentType === 'free') {
			return $this->order->freeOrder($documentName);
		}

		return $this->order->paidOrder($documentName);
	}
}
