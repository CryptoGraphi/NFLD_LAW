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
}
