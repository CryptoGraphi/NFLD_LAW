<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\Payments\OrderSystem;
use App\Controllers\Storage as DocumentStorage;
use App\Services\Auth\Auth;
use App\Services\Payments\PaymentDispatcher;

class Orders extends BaseController
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

    }

    /**
     *  
     *  @method: freeOrder 
     * 
     *  
     *  @purpose: inorder to create a new order in the system with our new document
     * 
     */

        public function freeOrder($document = null)
        {
            $orders = new OrderSystem($document);

            return $orders->place();
        }


        /**
         *  @method: paidOrder
        *
        *  @purpose: in order to create a new order in the system with our new document
        *            with the paid orders 
        *
        */    

        public function paidOrder($document = null)
        {
            $order = new OrderSystem($document);
            
            try {
                if (empty($_POST['stripeToken']) || empty($_POST['email'])) {
                    die('Payment failed');
                }
                // paid document purchase
                $paymentInterface = new PaymentDispatcher();
                $paymentStatus = $paymentInterface->charge($document);

                // did the payment go through?
                if ($paymentStatus->paid === true) {
             
                    $documentStorage = new DocumentStorage();
    
                    if ($documentStorage->add($document))
                    {
                        return $order->place();
                    }
        
                    return $order->place();
                }

            } catch (\Stripe\Exception\CardException $e) {
                // Since it's a decline, \Stripe\Exception\CardException will be caught
                $data = [
                    'errorMessage' => "Sorry but the card you entered isn't valid, or has insuffient funds",
                    'errorStripeMessage' => 'Message is:' . $e->getError()->message . '\n',
                    'errorRedirectLink' => '/render/contract/' . $document . '/'
                ];
    
                http_response_code(402);
                return view('/dashboard/template/header') . view('/render/documentFailure', $data) . view('/dashboard/template/footer');
            } catch (\Stripe\Exception\RateLimitException $e) {
                $data = [
                    'errorMessage' => "Sorry we couldn't proccess your request please try again later",
                    'errorStripeMessage' => 'Message is:' . $e->getError()->message . '\n'
                ];
    
                http_response_code(402);
                return view('/dashboard/template/header') . view('/render/documentFailure', $data) . view('/dashboard/template/footer');
            } catch (\Stripe\Exception\InvalidRequestException $e) {
                $data = [
                    'errorMessage' => "Sorry we couldn't proccess your request please try again later",
                    'errorStripeMessage' => 'Message is:' . $e->getError()->message . '\n'
                ];
    
                http_response_code(402);
    
                return view('/dashboard/template/header') . view('/render/documentFailure', $data) . view('/dashboard/template/footer');
            } catch (\Stripe\Exception\AuthenticationException $e) {
                $data = [
                    'errorMessage' => "Payment gateway: error, invalid!",
                    'errorStripeMessage' => 'Message is:' . $e->getError()->message . '\n'
                ];
                http_response_code(402);
                return view('/dashboard/template/header') . view('/render/documentFailure', $data) . view('/dashboard/template/footer');
    
    
                // Authentication with Stripe's API failed
                // (maybe you changed API keys recently)
            } catch (\Stripe\Exception\ApiConnectionException $e) {
                $data = [
                    'errorMessage' => "Payment gateway error,  Please try again later!",
                    'errorStripeMessage' => 'Message is:' . $e->getError()->message . '\n'
                ];
    
                http_response_code(402);
                return view('/dashboard/template/header') . view('/render/documentFailure', $data) . view('/dashboard/template/footer');
    
                // Network communication with Stripe failed
            } catch (\Stripe\Exception\ApiErrorException $e) {
                $data = [
                    'errorMessage' => "Network error: please try again later",
                    'errorStripeMessage' => 'Message is:' . $e->getError()->message . '\n'
                ];
    
                http_response_code(402);
                return view('/dashboard/template/header') . view('/render/documentFailure', $data) . view('/dashboard/template/footer');
                // send an email something went wrong. 
            }
        }
}