<?php


/// payment proccessor for our application 

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Users;
use App\Models\Orders;
use App\Models\DocumentStorage;
use sessionManager;


class Gateway extends BaseController
{

	// this is authentication code 
	public function __construct()
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
	}

	public function index()
	{
		
	}

	// use sessions inorder to procces the document type when fetching the document 
	public function proccess($documentName = null, $paymenttype = null)
	{
		// we need to reasi

		if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
			echo view('/dashboard/template/header');
			http_response_code(401);
			die (view('/errors/html/error_403'));
		}


		if ($paymenttype === 'free') {

			switch($documentName)
			{
				case 'lastwill':
					if ($_SESSION['DOCUMENT_RAW_DATA']['contractType'] === $documentName)
					{
						$_SESSION['DOCUMENT_RAW_DATA']['contractPaymentStatus'] = true;
					}
					echo view('/dashboard/template/header');
					echo View('/gateway/confirmPage');
					echo view('/dashboard/template/footer');
				break;
				default:
					// redirect the user and display error 
					http_response_code(403);
					echo view('/dashboard/template/header');
					die(view('/render/documentFailure'));
					echo view('/dashboard/template/footer');
				break;
			}

		} else {
			try {
				$API = \Stripe\Stripe::setApiKey("sk_test_51IoHyoHRqaEOzZ9RC2ZuARjGF1YWUzb1gw4Ec6rQotQut9lPBoCiHqXFHN8yrJiae2uXSK7uKRbj6ponkSC6xrwW00jtQVjZU2");
				$token = $_POST['stripeToken'];
				// add our document switch here
				switch ($documentName)
				{
					case 'lastwill':
						if ($paymenttype === 'paid') {
							// Create a Customer
						$customer = \Stripe\Customer::create(array(
							"email" => $_POST['email'],
							"source" => $token,
						));
						// Save the customer id in your own database!
						// Charge the Customer instead of the card
						$charge = \Stripe\Charge::create(array(
							"amount" => 25000,
							"currency" => "cad",
							"customer" => $customer->id,
							"description" => 'document Purchase lastwill'
						));

							if ($charge->paid === true) {
								// add the database stuff

								if ($_SESSION['DOCUMENT_RAW_DATA']['contractType'] === $documentName)
								{
									$_SESSION['DOCUMENT_RAW_DATA']['contractPaymentStatus'] = true;
								}
								$userModel = new Users();
								$orderModel = new Orders();
								$documentModel = new DocumentStorage();

								$userData = $userModel->lookupBySessionID($_SESSION['SESSION_AUTH_HANDSHAKE']);

							 	$orderData = $orderModel->generateData($userData['userID'],
								$_SESSION['DOCUMENT_RAW_DATA']['contractType'], 
								$paymenttype, 
								$charge);

								// save order data into the database 
								$orderModel->addOrder($orderData);

								$jsonRaw = json_encode($_SESSION['DOCUMENT_RAW_DATA']['contractData']);

								$documentModelData = $documentModel->generateDocumentData(
								$userData['userID'],
								$orderData['orderProductKey'],
								$orderData['orderProductType'],
								$jsonRaw,
								$orderData['orderPurchaseId']);



								$documentModel->addDocument($documentModelData);
								
								echo view('/dashboard/template/header');
								echo View('/gateway/confirmPage');
								echo view('/dashboard/template/footer');
							} 
						} else if ($paymenttype === 'custom')
						{
								// Create a Customer
								$customer = \Stripe\Customer::create(array(
									"email" => $_POST['email'],
									"source" => $token,
								));
								// Save the customer id in your own database!
								// Charge the Customer instead of the card
								$charge = \Stripe\Charge::create(array(
									"amount" => $_POST['amount'] . '00',
									"currency" => "cad",
									"customer" => $customer->id,
									"description" => 'document Purchase lastwill'
								));
		
		
									if ($charge->paid === true) {
										// add the database stuff
		
										if ($_SESSION['DOCUMENT_RAW_DATA']['contractType'] === $documentName)
										{
											$_SESSION['DOCUMENT_RAW_DATA']['contractPaymentStatus'] = true;
										}
										$userModel = new Users();
										$orderModel = new Orders();
										$documentModel = new DocumentStorage();
		
										$userData = $userModel->lookupBySessionID($_SESSION['SESSION_AUTH_HANDSHAKE']);
		
										 $orderData = $orderModel->generateData($userData['userID'],
										$_SESSION['DOCUMENT_RAW_DATA']['contractType'], 
										$paymenttype, 
										$charge);
		
										// save order data into the database 
										$orderModel->addOrder($orderData);
		
										$jsonRaw = json_encode($_SESSION['DOCUMENT_RAW_DATA']['contractData']);
		
										$documentModelData = $documentModel->generateDocumentData(
										$userData['userID'],
										$orderData['orderProductKey'],
										$orderData['orderProductType'],
										$jsonRaw,
										$orderData['orderPurchaseId']);
		
		
		
										$documentModel->addDocument($documentModelData);
										
										echo view('/dashboard/template/header');
										echo View('/gateway/confirmPage');
										echo view('/dashboard/template/footer');
									} 

						} else if ($paymenttype === 'donate') {
								// Create a Customer
								$customer = \Stripe\Customer::create(array(
									"email" => $_POST['email'],
									"source" => $token,
								));
								// Save the customer id in your own database!
								// Charge the Customer instead of the card
								$charge = \Stripe\Charge::create(array(
									"amount" => 25000,
									"currency" => "cad",
									"customer" => $customer->id,
									"description" => 'document Purchase lastwill (donatation)'
								));
		
		
									if ($charge->paid === true) {
										// add the database stuff

	
										if ($_SESSION['DOCUMENT_RAW_DATA']['contractType'] === $documentName)
										{
											$_SESSION['DOCUMENT_RAW_DATA']['contractPaymentStatus'] = true;
										}
										$userModel = new Users();
										$orderModel = new Orders();
										$documentModel = new DocumentStorage();
		
										$userData = $userModel->lookupBySessionID($_SESSION['SESSION_AUTH_HANDSHAKE']);
		
										 $orderData = $orderModel->generateData($userData['userID'],
										$_SESSION['DOCUMENT_RAW_DATA']['contractType'], 
										$paymenttype, 
										$charge);
		
										// save order data into the database 
										$orderModel->addOrder($orderData);
		
										$jsonRaw = json_encode($_SESSION['DOCUMENT_RAW_DATA']['contractData']);
		
										$documentModelData = $documentModel->generateDocumentData(
										$userData['userID'],
										$orderData['orderProductKey'],
										$orderData['orderProductType'],
										$jsonRaw,
										$orderData['orderPurchaseId']);
		
		
		
										$documentModel->addDocument($documentModelData);
										
										echo view('/dashboard/template/header');
										echo View('/gateway/confirmPage');
										echo view('/dashboard/template/footer');
									} 
							}
					break;

					case 'poa':
							if ($paymenttype === 'paid') {
								// Create a Customer
							$customer = \Stripe\Customer::create(array(
								"email" => $_POST['email'],
								"source" => $token,
							));
							// Save the customer id in your own database!
							// Charge the Customer instead of the card
							$charge = \Stripe\Charge::create(array(
								"amount" => 25000,
								"currency" => "cad",
								"customer" => $customer->id,
								"description" => 'document Purchase lastwill'
							));
	
								if ($charge->paid === true) {
									// add the database stuff
	
									if ($_SESSION['DOCUMENT_RAW_DATA']['contractType'] === $documentName)
									{
										$_SESSION['DOCUMENT_RAW_DATA']['contractPaymentStatus'] = true;
									}
									$userModel = new Users();
									$orderModel = new Orders();
									$documentModel = new DocumentStorage();
	
									$userData = $userModel->lookupBySessionID($_SESSION['SESSION_AUTH_HANDSHAKE']);
	
									 $orderData = $orderModel->generateData($userData['userID'],
									$_SESSION['DOCUMENT_RAW_DATA']['contractType'], 
									$paymenttype, 
									$charge);
	
									// save order data into the database 
									$orderModel->addOrder($orderData);
	
									$jsonRaw = json_encode($_SESSION['DOCUMENT_RAW_DATA']['contractData']);
	
									$documentModelData = $documentModel->generateDocumentData(
									$userData['userID'],
									$orderData['orderProductKey'],
									$orderData['orderProductType'],
									$jsonRaw,
									$orderData['orderPurchaseId']);
	
	
	
									$documentModel->addDocument($documentModelData);
									
									echo view('/dashboard/template/header');
									echo View('/gateway/confirmPage');
									echo view('/dashboard/template/footer');
								} 
							} else if ($paymenttype === 'custom')
							{
									// Create a Customer
									$customer = \Stripe\Customer::create(array(
										"email" => $_POST['email'],
										"source" => $token,
									));
									// Save the customer id in your own database!
									// Charge the Customer instead of the card
									$charge = \Stripe\Charge::create(array(
										"amount" => $_POST['amount'] . '00',
										"currency" => "cad",
										"customer" => $customer->id,
										"description" => 'document Purchase lastwill'
									));
			
			
										if ($charge->paid === true) {
											// add the database stuff
			
											if ($_SESSION['DOCUMENT_RAW_DATA']['contractType'] === $documentName)
											{
												$_SESSION['DOCUMENT_RAW_DATA']['contractPaymentStatus'] = true;
											}
											$userModel = new Users();
											$orderModel = new Orders();
											$documentModel = new DocumentStorage();
			
											$userData = $userModel->lookupBySessionID($_SESSION['SESSION_AUTH_HANDSHAKE']);
			
											 $orderData = $orderModel->generateData($userData['userID'],
											$_SESSION['DOCUMENT_RAW_DATA']['contractType'], 
											$paymenttype, 
											$charge);
			
											// save order data into the database 
											$orderModel->addOrder($orderData);
			
											$jsonRaw = json_encode($_SESSION['DOCUMENT_RAW_DATA']['contractData']);
			
											$documentModelData = $documentModel->generateDocumentData(
											$userData['userID'],
											$orderData['orderProductKey'],
											$orderData['orderProductType'],
											$jsonRaw,
											$orderData['orderPurchaseId']);
			
			
			
											$documentModel->addDocument($documentModelData);
											
											echo view('/dashboard/template/header');
											echo View('/gateway/confirmPage');
											echo view('/dashboard/template/footer');
										} 
	
							} else if ($paymenttype === 'donate') {
									// Create a Customer
									$customer = \Stripe\Customer::create(array(
										"email" => $_POST['email'],
										"source" => $token,
									));
									// Save the customer id in your own database!
									// Charge the Customer instead of the card
									$charge = \Stripe\Charge::create(array(
										"amount" => 25000,
										"currency" => "cad",
										"customer" => $customer->id,
										"description" => 'document Purchase lastwill (donatation)'
									));
			
			
										if ($charge->paid === true) {
											// add the database stuff
	
		
											if ($_SESSION['DOCUMENT_RAW_DATA']['contractType'] === $documentName)
											{
												$_SESSION['DOCUMENT_RAW_DATA']['contractPaymentStatus'] = true;
											}
											$userModel = new Users();
											$orderModel = new Orders();
											$documentModel = new DocumentStorage();
			
											$userData = $userModel->lookupBySessionID($_SESSION['SESSION_AUTH_HANDSHAKE']);
			
											 $orderData = $orderModel->generateData($userData['userID'],
											$_SESSION['DOCUMENT_RAW_DATA']['contractType'], 
											$paymenttype, 
											$charge);
			
											// save order data into the database 
											$orderModel->addOrder($orderData);
			
											$jsonRaw = json_encode($_SESSION['DOCUMENT_RAW_DATA']['contractData']);
			
											$documentModelData = $documentModel->generateDocumentData(
											$userData['userID'],
											$orderData['orderProductKey'],
											$orderData['orderProductType'],
											$jsonRaw,
											$orderData['orderPurchaseId']);
			
			
			
											$documentModel->addDocument($documentModelData);
											
											echo view('/dashboard/template/header');
											echo View('/gateway/confirmPage');
											echo view('/dashboard/template/footer');
										} 
								}

					break;
				}
			} catch(\Stripe\Exception\CardException $e) {
				// Since it's a decline, \Stripe\Exception\CardException will be caught
				 $data = [
					 'errorMessage' => "Sorry but the card you entered isn't valid, or has insuffient funds",
					 'errorStripeMessage' => 'Message is:' . $e->getError()->message . '\n',
					 'errorRedirectLink' => '/render/contract/'.$documentName . '/'
				 ];

				 echo view('/dashboard/template/header');
				 echo view('/render/cardFailed', $data);
				 echo view('/dashboard/template/footer');

				 http_response_code(402);
				 header('refresh: 4; /render/contract/'.$documentName . '/');
				 die();

			  } catch (\Stripe\Exception\RateLimitException $e) {
				$data = [
					'errorMessage' => "Sorry we couldn't proccess your request please try again later",
					'errorStripeMessage' => 'Message is:' . $e->getError()->message . '\n'
				];

				echo view('/dashboard/template/header');
				echo view('/render/cardFailed', $data);
				echo view('/dashboard/template/footer');

				http_response_code(402);
				header('refresh: 4; /render/contract/'.$documentName . '/');
				die();
				// Too many requests made to the API too quickly
			  } catch (\Stripe\Exception\InvalidRequestException $e) {
				$data = [
					'errorMessage' => "Sorry we couldn't proccess your request please try again later",
					'errorStripeMessage' => 'Message is:' . $e->getError()->message . '\n'
				];

				echo view('/dashboard/template/header');
				echo view('/render/cardFailed', $data);
				echo view('/dashboard/template/footer');

				http_response_code(402);
				header('refresh: 4; /render/contract/'.$documentName . '/');
				die();
				// Invalid parameters were supplied to Stripe's API
				
			  } catch (\Stripe\Exception\AuthenticationException $e) {
				$data = [
					'errorMessage' => "Payment gateway: error, invalid!",
					'errorStripeMessage' => 'Message is:' . $e->getError()->message . '\n'
				];

				echo view('/dashboard/template/header');
				echo view('/render/cardFailed', $data);
				echo view('/dashboard/template/footer');

				http_response_code(402);
				header('refresh: 4; /render/contract/'.$documentName . '/');
				die();
				// Authentication with Stripe's API failed
				// (maybe you changed API keys recently)
			  } catch (\Stripe\Exception\ApiConnectionException $e) {
				$data = [
					'errorMessage' => "Payment gateway error,  Please try again later!",
					'errorStripeMessage' => 'Message is:' . $e->getError()->message . '\n'
				];

				echo view('/dashboard/template/header');
				echo view('/render/cardFailed', $data);
				echo view('/dashboard/template/footer');

				http_response_code(402);
				header('refresh: 4; /render/contract/'.$documentName . '/');
				die();
				// Network communication with Stripe failed
			  } catch (\Stripe\Exception\ApiErrorException $e) {
				$data = [
					'errorMessage' => "Network error: please try again later",
					'errorStripeMessage' => 'Message is:' . $e->getError()->message . '\n'
				];

				echo view('/dashboard/template/header');
				echo view('/render/cardFailed', $data);
				echo view('/dashboard/template/footer');

				http_response_code(402);
				header('refresh: 4; /render/contract/'.$documentName . '/');
				die();
				// Display a very generic error to the user, and maybe send
				// yourself an email
			  } 
		}
	}

}
