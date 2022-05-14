<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Controllers\Contracts;
use App\Services\Auth\Auth;
use App\Models\Documents;
use App\Models\Orders;
use App\Models\Users;


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


	/**
	 * 
	 *  @method: index
	 * 
	 * 
	 *  @purpose: to display the default dashboard route.....
	 * 
	 */


	public function index()
	{
		// check if the user has documents in the system. 
		$user = new Users();
		$userID = $user->getUserByToken($_SESSION['token'])['id'];

		// next lets check if the user has any documents in the system.
		$documents = new Documents();
		$orders = new Orders();
		$userOrders = $orders->getOrdersByUserId($userID);

		// now lets check if the user has any documents in the system.
		$frontEndQuery = [];

		foreach($userOrders as $order) {
			$orderDocuments = $documents->getDocByID($order['document_id']);
			// push the paths 
			// @structure 
			// id -> doc ID
			// path -> path to the document file
			// created_at -> date of creation
			// updated_at -> date of last update

			array_push($frontEndQuery, $orderDocuments);
		}


		$data = [
			'documents' => $frontEndQuery,
		];
		
		return view('/dashboard/template/header') . view('/dashboard/home.php', $data) . view('/dashboard/template/footer');
	}


	/**
	 * 
	 * 
	 * 
	 * 
	 */

	/**
	 * 
	 *  @method: contracts 
	 * 
	 *  @purpose: to display the contract dashboard route.....
	 */

	public function contracts($contractType = null)
	{

		return Contracts::getContracts($contractType);
	}

	/**
	 * 
	 *  @method: account
	 * 
	 *  @purpose: to display the account dashboard route.....
	 * 
	 * 
	 */

	public function account()
	{
		return  view('dashboard/template/header') . view('dashboard/account') . view('dashboard/template/footer');
	}
}
