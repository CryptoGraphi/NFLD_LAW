<?php


/// payment proccessor for our application 

namespace App\Controllers;

use App\Controllers\BaseController;

class Gateway extends BaseController
{

	public function index()
	{
		
	}

	// use sessions inorder to procces the document type when fetching the document 
	public function proccess($documentName = null, $paymenttype = null)
	{
		// we need to reasi
		if ($paymenttype === 'free') {

			switch($documentName)
			{
				case 'lastwill':
					echo view('/dashboard/template/header');
					echo View('/gateway/confirmPage');
					echo view('/dashboard/template/footer');
				break;
				default:
					// redirect the user and display error 
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
							"customer" => $customer->id
						));

							if ($charge->paid === true) {
								// add the database stuff
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
							"amount" => 25000,
							"currency" => "cad",
							"customer" => $customer->id
						));

							if ($charge->paid === true) {
								// add the database stuff
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
							"customer" => $customer->id
						));

							if ($charge->paid === true) {
								// add the database stuff
								echo view('/dashboard/template/header');
								echo View('/gateway/confirmPage');
								echo view('/dashboard/template/footer');
							} 
						}
					break;
				}
			} catch(\Stripe\Exception\CardException $e) {
				// Since it's a decline, \Stripe\Exception\CardException will be caught
				echo 'Status is:' . $e->getHttpStatus() . '\n';
				echo 'Type is:' . $e->getError()->type . '\n';
				echo 'Code is:' . $e->getError()->code . '\n';
				// param is '' in this case
				echo 'Param is:' . $e->getError()->param . '\n';
				echo 'Message is:' . $e->getError()->message . '\n';
			  } catch (\Stripe\Exception\RateLimitException $e) {
				// Too many requests made to the API too quickly
			  } catch (\Stripe\Exception\InvalidRequestException $e) {
				// Invalid parameters were supplied to Stripe's API
				echo "failed";
			  } catch (\Stripe\Exception\AuthenticationException $e) {
				// Authentication with Stripe's API failed
				// (maybe you changed API keys recently)
			  } catch (\Stripe\Exception\ApiConnectionException $e) {
				// Network communication with Stripe failed
			  } catch (\Stripe\Exception\ApiErrorException $e) {
				// Display a very generic error to the user, and maybe send
				// yourself an email
			  } 
		}
	}
	// fetch the document once the user has 
	private function fetchDocument($documentType)
	{
		

	}
}
