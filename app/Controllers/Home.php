<?php

namespace App\Controllers;

class Home extends BaseController
{
	function __construct()
	{
			session_start();
	}
	public function index()
	{
		echo view('/home/template/header');
		echo view('/home/index');
		echo view('/home/template/footer');
		die();
	}

	public function about()
	{
		echo  view('/home/template/header');
		echo view('/home/about');
		echo view('home/template/footer');
	}

	public function login()
	{
		
		echo view('/home/template/header');
		echo view('/home/login');
		echo view('/home/template/footer');
	}


	public function register()
	{
		echo view('/home/template/header');
		echo view('/home/register');
		echo view('home/template/footer');
	}
}
