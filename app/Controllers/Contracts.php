<?php

namespace App\Controllers;

use App\Controllers\BaseController;


/**
 *  
 *  @class: contracts 
 * 
 *  @purpose: to dispatch the contracts to the correct controller
 * 
 */


class Contracts extends BaseController
{

    /**
     *  
     *  @method: getContacts
     * 
     * 
     *  @purpose: to display the contracts page
     * 
     */

    static function getContracts($contract)
    {   
       
        
        $header = view('/dashboard/template/header');
        $footer = view('/dashboard/template/footer');

        // render the routes of the contracts page. 
		switch ($contract) {
			case "lastwill":

				$data = ['headerTitle' => 'LAST WILL AND TESTAMENT'];
                return $header .  view('/dashboard/contract/' . $contract, $data) . $footer;

			break;
			case 'poa':

				$data = ['headerTitle' => 'Power of attorney'];
				return $header .view('/dashboard/contract/' . $contract, $data) . $footer;
			break;

			default:
				return $header .  view('/dashboard/template/documentSelection'). $footer;
			break;
		}

    }


	/**
	 * 
	 *  @method: lastwill
	 * 
	 *  @purpose: to render the last will and testament page
	 * 
	 */

	 private static function lastwill($contractType)
	 {

		$header = view('/dashboard/template/header');
		$footer = view('/dashboard/template/footer');
		$contract = filter_var_array(json_decode($_POST['__data__'], true), FILTER_DEFAULT);

		$_SESSION['DOCUMENT_JSON_DATA'] = $contract;

		// set the data for the contract. 
		$data = [
			"contractData" => $contract,
			"contractType" => $contractType,
			"contractTitle" => "Last Will, and Testament",
			"contractContent" => view('/render/template/contract_lastwill', $contract),
			"contractPayment" => 'true', // is a paid document
			"contractPaymentStatus" => null, // check if payment went though before verifying anything in our rending
		];

		$_SESSION['DOCUMENT_RAW_DATA'] = $data;
		return $header . view('/render/paymentPage', $data) . $footer;
	 }


	 /**
	  *  @method: poa
	  *
	  *  @purpose: to render the power of attorney page

	  */

	 private static function poa($contractType)
	 {

		$footer = view('/dashboard/template/footer');
		$header = view('/dashboard/template/header');
		$contract = filter_var_array(json_decode($_POST['__data__'], true), FILTER_DEFAULT);

		$_SESSION['DOCUMENT_JSON_DATA'] = $contract;


		// set the data for the contract
		$data = [
			"contractData" => $contract,
			"contractType" => $contractType,
			"contractTitle" => "Power of Attorney",
			"contractContent" => view('render/template/contract_poa', $contract),
			"contractPayment" => 'true',
			"contractPaymentStatus" => null,
		];

		$_SESSION['DOCUMENT_RAW_DATA'] = $data;

		return $header.  view('/render/paymentPage', $data) . $footer;
		
	 }


    /**
     * 
     *  @method: create 
     * 
     *  
     *   @purpose: to create the contracts
     * 
     */

     static function create($contractType = null)
     {
        $header = view('/dashboard/template/header');
		$footer = view('/dashboard/template/footer');

		// check if the request type is a valid request 
		if (empty($_POST['__data__'])) {
			$error = [
				"FormSubmissionError" => "Please complete form, a empty form will not be accepted"
			];

			die($header . view('/render/paymentPage', $error) . $footer);
		}
		
		// check what documents we need to return the the user
		// i built this is this way incase I ever need to add more contracts
		// its modify one line of code here and making a template to use. 
		// be I hate refacting code over and over again so i will stick with 
		// this final idea. 
		
		switch($contractType)
		{
			case 'lastwill':
				return self::lastwill($contractType);
			break;
				
			case 'poa':
				return self::poa($contractType);
			break;
		}
		// trigger a error if the contract type is not found.
		return $header . view('/render/paymentPage', ['FormSubmissionError' => 'Contract type not found']) . $footer;
     }
}
