<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Users;
use authenticationWorker;
use sessionManager;
use registration;

class Authentication extends BaseController
{


	public function __construct()
	{
		// verify that sessions are active before
		session_start();
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
							"userSessionID" => $SESSION_TOKEN
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
									echo "session_was started successfuly";
									// redirect to the login page 
									header('refresh; 0; /dashboard/');
								} else {
									// session failed 
									// inputs dont match possible bug in our code;
									$_SESSION['AUTHENTICATION_ERROR_MESSAGE'] = "Invalid username or password combo";
									header('refresh: 0; /');
								}
							} else {
								// session has failled to create so probaly a db related error 
								// inputs dont match possible bug in our code;
								$_SESSION['AUTHENTICATION_ERROR_MESSAGE'] = "Invalid username or password combo";
								header('refresh: 0; /');
							}
						} else {
							// our handshake failed for some reason
							// DB -> ERROR 
							// inputs dont match possible bug in our code;
							$_SESSION['AUTHENTICATION_ERROR_MESSAGE'] = "Invalid username or password combo";
							header('refresh: 0; /home/login/');
						}
					} else {
						// incorrect username or passowrd 

						// log the failed password attempt
						// inputs dont match possible bug in our code;
						$_SESSION['AUTHENTICATION_ERROR_MESSAGE'] = "Invalid username or password combo";
						header('refresh: 0; /home/login/');
					}
				} else {
					// inputs dont match possible bug in our code;
					$_SESSION['AUTHENTICATION_ERROR_MESSAGE'] = "Invalid username or password combo";
					header('refresh: 0; /home/login/');
				}
			} else {
				// invalid username -> username doesnt exist 
				$_SESSION['AUTHENTICATION_ERROR_MESSAGE'] = "Invalid username or password combo";
				header('refresh: 0; /home/login/');
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
		$userModel = new Users();
		$registration = new registration($_POST);                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               


	}
	public function logout()
	{
	}
}
