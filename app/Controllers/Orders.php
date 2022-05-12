<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\Payments\OrderSystem;

class Orders extends BaseController
{


    public function __construct()
    {
      

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

            return $orders->order();
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
            $orders = new OrderSystem($document);
            return $orders->order();
        }



}
