<?php


/// payment proccessor for our application 

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Users;
use App\Services\Auth\Auth;
use App\Controllers\Orders;
use App\Models\DocumentStorage;
use App\Services\Payments\PaymentDispatcher;
use sessionManager;
//use Stripe\Order;

class Gateway extends BaseController
{
	public function __construct()
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}

		// only allow post requests to this controller.... 
		if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
			http_response_code(405);
			die();
		}

		// make sure the user is logged in before accessing the payment gateway. 
		if (!Auth::isLoggedIn()['status']) {
			die(Auth::deny());
		}

		// share objects 

		$this->order = new Orders();

		
	}

	/**
	 * 
	 * @method: proccess 
	 * 
	 * @purpose: inorder to process the payment for the digital assets purchases. 
	 * 
	 * 
	 * @param [type] $documentName
	 * @param [type] $paymentType
	 * @return void
	 * 
	 * 
	 */

	public function proccess($documentName = null, $paymentType = null)
	{
		// for only support the following a paid document purchase 
		// and free documents

		//TODO: WE NEED TO ADD THE POA DOCUMENTS TO THE PAYMENT SYSTEM
		// TODO: AND ALSO WE NEED TO ADD THE DATABASE FUNCTIONALITY TO THE PAYMENT SYSTEM
		// SO THAT DOCUMENTS CAN BE PURCHASED AND STORED IN THE DATABASE. 
		// ALSO WRITE SOME TESTS FOR THE NEW SYSTEM ONCE THAT IS COMPLETE THAT PROJECT 
		// SHOULD BE JUST ABOUT READY FOR PRODUCTION. 


		try {
		if (empty($_POST['stripeToken']) || empty($_POST['email'])) {
			// the stripe and email are not set in the post request
			// therefore we cannot process the payment
			die('Payment failed');
		}

		if ($paymentType === 'free')
		{
			// free documents here.... 
			return $this->order->freeOrder($documentName);

		} else {
			// paid document purchase
			$paymentInterface = new PaymentDispatcher();
			$paymentStatus = $paymentInterface->charge($documentName);

			// did the payment go through?
			if ($paymentStatus->paid === true) {
				// payment went through
				return $this->order->paidOrder($documentName);
			}  
		}
	}
	/// handle all posible errors that may or may not occur with our payment system. 
	catch(\Stripe\Exception\CardException $e) {
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



	/* 		try {o
			
		@TODO: REFACTOR THIS METHOD INORDER A MUUCCHHH.... CLEANER WAS THIS IS VERY DIFFICULT TO READ.....

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
							}
				} */
	