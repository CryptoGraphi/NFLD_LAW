<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\Auth\Auth;

class Authentication extends BaseController
{


	public function __construct()
	{
		// anything we want to preload here

		// check if the session are set
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

	}

	public function index()
	{

	}

	/**
	 * 
	 *  @function: login	
	 * 
	 * 	@purpose:  inorder to login the user 
	 * 
	 */

	public function login()
	{
		$user = [
			// place the values of the user in an array
			// our login function will automatically check the array, sanitize the data, and check the credentials
			'email' => $_POST['email'],
			'password' => $_POST['password'],
			'honeypot' => $_POST['SID_TRACKER']
		];

		// process the login form
		if (Auth::login($user)) {
			// have to use the naked php way since codeigniter return index.php + the route 
			// and breaks the front end implimentation of the router. 
			
			return redirect()->to('/dashboard');
		}

		return Auth::deny();
	}

	/**
	 *  
	 *  @function: register
	 * 
	 *  @purpose: inorder to register the user inside of the system 
	 */

	public function register()
	{
		$user = [
			// place the values of the user in an array
			// our login function will automatically check the array, sanitize the data, and check the credentials
			'email' => $_POST['email'],
			'password' => $_POST['password'],
			'confirm_password' => $_POST['passwordConfirm'],

		];

		if (Auth::register($user)) {
			// redirect the user to the login page
			return redirect()->to('/home/login');
		} 

		// deny the request and run the cleanup
		return Auth::deny();
	}

	/**
	 * 
	 *   @function: logout
	 *  
	 *   @purpose: in order to logout the user from the system
	 * 
	 */

	public function logout()
	{
		// logout the user and clear the sessions and cookies.
		return Auth::logout();
	}
}