<?php

namespace App\Controllers;

use App\Services\Auth\Auth;

class Home extends BaseController
{
	function __construct()
	{
			if (session_status() == PHP_SESSION_NONE) {
				session_start();
			}

	}
	public function index()
	{
		return view('/home/template/header') . view('/home/index') . view('/home/template/footer');
	}
	/**
	 * 
	 *  @method: about
	 * 
	 *  @purpose: inorder to display the about page
	 * 
	 */

	public function about()
	{
		return view('/home/template/header') . view('/home/about') . view('/home/template/footer');
	}

	/**
	 * 
	 *  @method: login
	 * 
	 *  @purpose: inorder to display the login page and verify if the user is logged in
	 * 
	 */

	public function login()
	{
		// check if the user is already logged in
		// if the user is logged then redirect the user to the dashboard of the application
		
		if (Auth::isLoggedIn()['status'] === true) {
			return redirect()->to('/dashboard/');
		}

		// if not return the default route for the login page
		return view('/home/template/header') . view('/home/login') . view('/home/template/footer');
	}

	/**
	 * 
	 *  @method: register
	 * 
	 *  @purpose; inorder to display the register page
	 *  
	 */


	public function register()
	{
		return view('/home/template/header') . view('/home/register') . view('/home/template/footer');
	}
}
