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
		return view('/home/template/header') . view('/home/index') . view('/home/template/footer');
	}

	public function about()
	{
		return view('/home/template/header') . view('/home/about') . view('/home/template/footer');
	}

	public function login()
	{
		return view('/home/template/header') . view('/home/login') . view('/home/template/footer');
	}


	public function register()
	{
		return view('/home/template/header') . view('/home/register') . view('/home/template/footer');
	}
}
