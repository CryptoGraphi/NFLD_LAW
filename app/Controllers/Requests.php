<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Requests extends BaseController
{
  

    /**
     * 
     *  @method: post
     * 
     *  @purpose: inorder to process the post request from the user
     * 
     */

     static function post()
     {
         if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
             http_response_code(405);
             die();
         }
         return true;
     }
     
}
