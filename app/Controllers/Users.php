<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\Auth\Auth;


/**  
 * 
 *  @class: Users 
 *  
 *   
 *  @purpose: to manage users and their accounts
 * 
 */

class Users extends BaseController
{

    public function __construct()
    {
        // check if the sessions are set.
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // protect the controller from unauthorized access.
        if (!Auth::isLoggedIn()['status']) {
            die(Auth::deny());
        }
    }


    public function changePassword()
    {
        // preform the change password action.
        // on the account that is logged in. 
        // and return success or failure.
    }
}
