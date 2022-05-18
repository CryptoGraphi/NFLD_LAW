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

	/**
	 * 
	 *  @function: login	
	 * 
	 * 	@purpose:  inorder to login the user 
	 * 
	 */

	public function login()
	{

		if (!$this->request->isSecure()) {
			die('You must use HTTPS');
		}

		if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
			die('Invalid request');
		}

		
		$user = [
			// place the values of the user in an array
			// our login function will automatically check the array, sanitize the data, and check the credentials
			'email' => $this->request->getPost('email'),
			'password' => $this->request->getPost('password'),
			'honeypot' =>  $this->request->getPost('SID_TRACKER'),
		];
		
		$loginStatus = Auth::login($user);

		// process the login form
		if ($loginStatus['status'] === true) {
			return redirect()->to('/dashboard');
		}

		// if the login failed, then we will redirect the user to the login page
		return redirect()->to('/login')->with('error', $loginStatus['message']);
	}

	/**
	 *  
	 *  @function: register
	 * 
	 *  @purpose: in order to register the user inside of the system 
	 */

	public function register()
	{

		if (!$this->request->isSecure()) {
			die('You must use HTTPS');
		}

		if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
			die('Invalid request');
		}

		$user = [
			// place the values of the user in an array
			// our login function will automatically check the array, sanitize the data, and check the credentials
			'email' => $this->request->getPost('email'),
			'password' => $this->request->getPost('password'),
			'confirm_password' => $this->request->getPost('passwordConfirm'),

		];

		$loginStatus = Auth::register($user);

		if (($loginStatus['status'] === true)) {
			// redirect the user to the login page
			return redirect()->to('/home/login');
		}
		// deny the request and run the cleanu]
		// return error message to the view 
		return redirect()->to('/home/register')->with('error', $loginStatus['message']);
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
		if (Auth::logout()) {
			return redirect()->to('/home/login');
			exit;
		}
	}
}