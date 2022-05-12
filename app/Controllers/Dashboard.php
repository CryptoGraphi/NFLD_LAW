<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Controllers\Contracts;
use App\Services\Auth\Auth;


class Dashboard extends BaseController
{

	public function __construct()
	{
		// check if the sessions are set. 
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		// add the authentication middleware to the controller in question

		if (!Auth::isLoggedIn()['status']) {
			die(Auth::deny());
		}
	}


	/**
	 * 
	 *  @method: index
	 * 
	 * 
	 *  @purpose: to display the default dashboard route.....
	 * 
	 */


	public function index()
	{
		
		return view('/dashboard/template/header') . view('/dashboard/home.php') . view('/dashboard/template/footer');
	}


	/**
	 * 
	 *  @method: contracts 
	 * 
	 *  @purpose: to display the contract dashboard route.....
	 */

	public function contracts($contractType = null)
	{

		return Contracts::getContracts($contractType);
	}

	/**
	 * 
	 *  @method: account
	 * 
	 *  @purpose: to display the account dashboard route.....
	 * 
	 * 
	 */

	public function account()
	{
		return  view('dashboard/template/header') . view('dashboard/account') . view('dashboard/template/footer');
	}
}
