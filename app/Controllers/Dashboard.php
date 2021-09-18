<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Users;
use sessionManager;

class Dashboard extends BaseController
{

	public function __construct()
	{

		// this is a code snippet to add to any controller that we want to be authenticated be accessing 
		helper('sessionManager');

		session_start();

		$accessToken = $_SESSION['SESSION_AUTH_HANDSHAKE'];
		$sessionToken = $_SESSION['SESSION_TOKEN'];
		$sessionID = $_SESSION['SESSION_ID'];
		$userModel = new Users();

		// do some prechecks 

		// check if our sessions id matches the cookie

		if (!isset($sessionID) && !isset($_COOKIE['USER_SESSION_ID'])) {
			// REDIRECT THE USER SESSION HAS EXPIRED 
			header('refresh: 2; /home/login/');
			die('Session has expired, logging you out');
			session_destroy();
		}

		if (!empty($accessToken && !empty($sessionToken) && !empty($sessionID))) {
			$userData = $userModel->lookupBySessionID($accessToken);
			$session = new sessionManager($_SESSION['SESSION_AUTH_HANDSHAKE'], $_SESSION['SESSION_TOKEN']);

			// check if our data is empty 
			if (empty($userData)) {
				header('refresh: 2; /home/login/');
			die('Session has expired, logging you out');
			session_destroy();

			} 
			// call our class to do its thang!
			if ($session->checkAuthenticationSession($userData['userSessionID'], $userData['userAccessToken'])) {
				// this will record our session
				$_SESSION['SESSION_MANAGER_AUTH_TOKEN'] = $session->sessionManagerToken();
				
				// check if our session is expired 

				if ($session->verifySessionActive($_SESSION['SESSION_TOKEN_EXPIRY'])) {
					$_SESSION['EXPIRED'] = FALSE;
				} else {
					$_SESSION['EXPIRED'] = true;
				}
				// redirect to the login page 
			} else {
				// session failed 
				// inputs dont match possible bug in our code;
				
				header('refresh: 3; /home/login/');
				die('Session has expired, logging you out');
				session_destroy();
			}
		} else {
			/// NOT ACTIVE SESSION REDIRECT THE USER 
			header('refresh: 3; /home/login/');
			die('Session has expired, logging you out');
			session_destroy();
		}
	}


	public function index()
	{
		echo view('/dashboard/template/header');
		echo view('/dashboard/home.php');
		echo view('/dashboard/template/footer');
	}


	public function contracts($contractType = null)
	{

		echo view('/dashboard/template/header');

		switch($contractType)
		{
			case "lastwill":
				$data = [
					'headerTitle' => 'LAST WILL AND TESTAMENT'
				];
				echo view('/dashboard/contract/'.$contractType, $data);
			break;

			case 'poa':
					$data = [
						'headerTitle' => 'Power of attorney'
					];
					echo view('/dashboard/contract/'.$contractType, $data);
			break;
			default:
				echo view('/dashboard/template/documentSelection');
			break;

		}
		
		echo view('/dashboard/template/footer');
		die();
	}
}
