<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\Auth\Auth;
use App\Models\Users;
use App\Models\DocumentStorage;
use account;
use accounts;
use FontLib\Table\Type\head;
use sessionManager;

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


	public function index()
	{
		
		return view('/dashboard/template/header') . view('/dashboard/home.php') . view('/dashboard/template/footer');
	}


	public function contracts($contractType = null)
	{

		echo view('/dashboard/template/header');

		switch ($contractType) {
			case "lastwill":
				$data = [
					'headerTitle' => 'LAST WILL AND TESTAMENT'
				];
				echo view('/dashboard/contract/' . $contractType, $data);
				break;

			case 'poa':
				$data = [
					'headerTitle' => 'Power of attorney'
				];
				echo view('/dashboard/contract/' . $contractType, $data);
				break;

			case 'livingwill':
				$data = [
					'headerTitle' => 'Living Will',
					'headerDesc' => 'A Living Will states your preferred medical treatments in case you’re unable to.
					Live with the knowledge that your most important decisions are taken care of.'
				];

				echo view('/dashboard/contract/' . $contractType, $data);
				break;
			default:
				echo view('/dashboard/template/documentSelection');
				break;
		}

		echo view('/dashboard/template/footer');
		die();
	}

	public function accountRequest($request = null)
	{

		echo view('dashboard/template/header');

		helper('hashing');
		helper('account');

		session_start();

		$accessToken = $_SESSION['SESSION_AUTH_HANDSHAKE'];
		$sessionToken = $_SESSION['SESSION_TOKEN'];
		$sessionID = $_SESSION['SESSION_ID'];
		$userModel = new Users();
		$userData = $userModel->lookupBySessionID($accessToken);
		$userID = $userData['userID'];


		if ($request === 'passwordChange') {




			if ($_SERVER['REQUEST_METHOD'] === 'POST') {

				// new user data 
				$post = filter_var_array($_POST, FILTER_SANITIZE_STRING);
				$userInfo = new accounts($post);

				if (!empty($post['currentPassword']) && !empty($post['newPassword']) && !empty($post['newPasswordConfirm'])) {
					if ($query = $userInfo->verifyPasswords($post['currentPassword'], $userData['userPassword'],  $post['newPassword'], $userData['userSalt'])) {
						$newPassword = $userInfo->generatePasswordQuery($query);
						if ($post['newPassword'] === $post['newPasswordConfirm']) {

							if ($userModel->updateUserData($userID, $newPassword) === true) {
								// success 
								echo view('/dashboard/accounts/success');
							} else {
								// error model refused the data 
								echo view('/dashboard/accounts/failed');
							}
						} else {
							echo view('/dashboard/accounts/failed');
						}
					} else {
						// bad inputs 
						echo view('/dashboard/accounts/failed');
					}
				} else {
					// trigger error empty fields
					echo view('/dashboard/accounts/failed');
				}
			} else {
				// show error to the user  bad request method
				echo view('/dashboard/accounts/failed');
			}
		} else {
			// invalid response 
			http_response_code(403);
			echo view('/dashboard/accounts/failed/');
		}
	}

	public function account()
	{

		echo view('dashboard/template/header') . view('dashboard/account');
		return view('dashboard/template/footer');
	}

	// SEND EMAIL TO THE LAW FIRM OF CHOICE 

	public function request()
	{

		if (!empty($_POST)) {
			$post = filter_var_array($_POST, FILTER_SANITIZE_STRING);

			$email = \Config\Services::email();
			$email->setFrom($post['email'], $post['firstname'] . $post['lastname']);
			$email->setTo('myemail@example.com');  // CHANGE ME TO YOUR EMAIL
			$email->setCC('myemail@example.com');
			$email->setBCC('myemail@example.com');

			$email->setSubject('A request has been issued from' . $post['firstname'] . "   " . $post['lastname']);
			$email->setMessage($post['message']);

			echo view('dashboard/template/header');
			echo view('dashboard/request/request');

			$email->send();
		} else {
			// trigger errror  
			echo view('dashboard/template/header');
			echo view('/errors/html/error_403');
		}
	}
}
