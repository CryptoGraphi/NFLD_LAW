<?php 

namespace App\Services\Payments;


/**
 * 
 *  @class: orderSystem 
 * 
 *  @purpose: to handle the orders of the digital documents with in the system. 
 * 
 */

class  OrderSystem {


    
    public function __construct($document)
    {
        $this->document = $document;
    }


    /**
     * 
     *  @function: error 
     * 
     * 
     *  @purpose: inorder to trigger an error within the system  
     * 
     */

    public function error($error)
    {
        http_response_code($error);
        die (view('/dashboard/template/header') . view('/render/documentFailure') . view('/dashboard/template/footer'));
    }

    /**
     * 
     *  @method: order 
     * 
     *  @purpose: inorder to proccess the order of the system.
     * 
     */ 

    public function order()
    {

        if ($this->document === 'lastwill') {

            if ($_SESSION['DOCUMENT_RAW_DATA']['contractType'] === $this->document)
			{
				$_SESSION['DOCUMENT_RAW_DATA']['contractPaymentStatus'] = true;
			}

            return view('/dashboard/template/header') . view('/gateway/confirmPage') . view('/dashboard/template/footer');
        }

        // return the error since something has went wrong. 
        return $this->error(403);
    }
    

}



?>