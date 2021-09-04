<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Users;
use authenticationWorker;
use hash;
use sessionManager;
use registration;

class Authentication extends BaseController
{


	public function __construct()
	{
		// verify that sessions are active before
		session_start();



		// check to see if 
	}

	public function index()
	{
	}
	public function login()
	{
		helper('authentication');

		$auth = new authenticationWorker($_POST);
		$userModel = new Users();
		$input = $auth->getPostValues();


		// AUTHENTICATION LOGIC BELOW\

		if ($auth->checkRequestMethod() === true) {


			$fetchUsernameData = $userModel->lookupUser($input['email']);

			// this is to prevent form re submissions 
			if (!empty($fetchUsernameData)) {

			

				if (!empty($_SESSION['SESSION_HONEYPOTVALUE'])) {
					if ($input['SID_TRACKER'] === $_SESSION['SESSION_HONEYPOTVALUE']) {
						unset($_SESSION['SESSION_HONEYPOTVALUE']);
						http_response_code(401);
						header('refresh: 0; /home/login');
						die();
					}
				} else {
					$_SESSION['SESSION_HONEYPOTVALUE'] = $input['SID_TRACKER'];
				}

				// verify that both of our inputs are equal 
				if ($auth->verifyUsername($input['email'], $fetchUsernameData['userEmail'])) {
					// since our username has been links to an active account issue a sessionID

					// make a session id for this current authentication attempt
					$SESSION_ID = $auth->generateSessionID();
					if ($auth->verifyPassword($input['password'], $fetchUsernameData['userPassword'], $fetchUsernameData['userSalt']) === true) {
						// password does match so issue the token here and

						// initlizated our session token

						// SESSION_TOKEN IS OUR HANDSHAKE FOR A PARTICULAR USER 
						$SESSION_TOKEN = $auth->generateSessionToken();
						// SESSION_AUTH_TOKEN IS A KEY TO BE ABLE TO ACCESS SECTIONS OF THE WEBSITE WITHOUT NO AUTHORIZATION WILL EVER BE GRANTED
						$SESSION_AUTH_HANDSHAKE = $auth->generateAuthToken($SESSION_ID);

						// starts our live session

						// update value in database inorder to login
						$updateSession = [
							"userAccessToken" => $SESSION_AUTH_HANDSHAKE,
							"userSessionID" => $SESSION_TOKEN,
							"userLastLogin" => date("Y-m-d")
						];

						// update our database to the new login session for the user 
						if ($userModel->issueHandshake($fetchUsernameData['userID'], $updateSession) === true) {
							// check honey pot here

							$userData = $userModel->lookupBySessionID($SESSION_AUTH_HANDSHAKE);

							if ($auth->verifyTokensIssued($SESSION_TOKEN, $userData['userSessionID'], $SESSION_AUTH_HANDSHAKE, $userData['userAccessToken'])) {
								// GENERATE THE FIRST STAGE OF AUTHENTICATION SESSIONS
								$_SESSION['SESSION_ID'] = $SESSION_ID;
								$_SESSION['SESSION_TOKEN'] = $SESSION_TOKEN;
								$_SESSION['SESSION_AUTH_HANDSHAKE'] = $SESSION_AUTH_HANDSHAKE;
								helper('sessionManager');
								$session = new sessionManager($_SESSION['SESSION_AUTH_HANDSHAKE'], $_SESSION['SESSION_TOKEN']);

								if ($session->checkAuthenticationSession($userData['userSessionID'], $userData['userAccessToken'])) {
									$_SESSION['SESSION_TOKEN_EXPIRY'] = $session->getSessionExpiry();
									// set session cookie

									// redirect to the login page 
									header('refresh: 0; /dashboard/');
								} else {
									// session failed 
									// inputs dont match possible bug in our code;
									$_SESSION['AUTHENTICATION_ERROR_MESSAGE'] = "Invalid username or password combo";
									header('refresh: 0; /home/login/');
									die();
								}
							} else {
								// session has failled to create so probaly a db related error 
								// inputs dont match possible bug in our code;
								$_SESSION['AUTHENTICATION_ERROR_MESSAGE'] = "Invalid username or password combo";
								header('refresh: 0; /home/login/');
								die();
							}
						} else {
							// our handshake failed for some reason
							// DB -> ERROR 
							// inputs dont match possible bug in our code;
							$_SESSION['AUTHENTICATION_ERROR_MESSAGE'] = "Invalid username or password combo";
							header('refresh: 0; /home/login/');
							die();
						}
					} else {
						// incorrect username or passowrd 

						// log the failed password attempt
						// inputs dont match possible bug in our code;
						$_SESSION['AUTHENTICATION_ERROR_MESSAGE'] = "Invalid username or password combo";
						header('refresh: 0; /home/login/');
						die();
					}
				} else {
					// inputs dont match possible bug in our code;
					$_SESSION['AUTHENTICATION_ERROR_MESSAGE'] = "Invalid username or password combo";
					header('refresh: 0; /home/login/');
					die();
				}
			} else {
				// invalid username -> username doesnt exist 
				$_SESSION['AUTHENTICATION_ERROR_MESSAGE'] = "Invalid username or password combo";
				header('refresh: 0; /home/login/');
				die();
			}
		} else {
			http_response_code(403);
			die('error');
		}
	}

	public function register()
	{

		// register the user with
		helper('register');
		helper('hashing');
		$userModel = new Users();
		$registration = new registration($_POST);  
		$hash = new hash();   
		$input = $registration->getPostValues();    

		if ($registration->checkRequestMethod() === true)
		{
			// check if username exists in dbUsernam
			if (empty($userModel->lookupUser($input['email'])))
			{
				// now compare the 2 hashes that we need 
				if ($registration->passwordsMatch($input['password'], $input['passwordConfirm']))
				{
					if ($registration->verifyPasswordLength($input['password'], $input['passwordConfirm'])){
						// generate our db stuff
					 	$salt = 	hash::generateSalt();
						$password = hash::generateHash($input['password'], $salt);
						$dbQuery = $registration->generateDBInsertQuery($input['email'], $password, $salt);

						if ($result = $userModel->registerUser($dbQuery)) {
							// goto login page an force user to login for the first time


						}
					} else {
						// password dont match required length;
						$_SESSION['REGISTRATION_ERROR_MESSAGE'] = "passwords to short";
						http_response_code(401);
						header('refresh: 0; /home/register/');
					}
					
				} else {
					/// password dont match trigger an error
					$_SESSION['REGISTRATION_ERROR_MESSAGE'] = "passwords dont match";
					http_response_code(401);
					header('refresh: 0; /home/register/');
				}
			} else {
				// user already exists so tell user the username is already in use
				$_SESSION['REGISTRATION_ERROR_MESSAGE'] = "user Exists please choose differnt email";
				http_response_code(401);
				header('refresh: 0; /home/register/');
			}

		} else 
		{
			// trigger request method 
			$_SESSION['REGISTRATION_ERROR_MESSAGE'] = "request method isnt valid";
			http_response_code(401);
			header('refresh: 0; /home/register/');
		}



	}
	// destory all the sessions inside of the database
	public function logout()
	{
		session_destroy();
		header('refresh: 0; /');
	}
}
