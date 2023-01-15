<?php  


namespace App\Services\Payments;



/**
 *  
 *  @class: paymentDispatcher
 * 
 *  @purpose: to handle the payments with in the system while thus, 
 *            hiding the underling implementation of the payment
 *            incase we will need to change the payment system
 *            in the future.
 * 
 */

class PaymentDispatcher 
{

    public function __construct()
    {
        $this->StripeKey = \Stripe\Stripe::setApiKey('API_KEY_HERE');
        $this->token = $_POST['stripeToken'];
        $this->customerEmail = $_POST['email'];
        $this->amount = 25000;
        $this->currency = 'CAD';
        // name of the document to be paid for
    }

    /**
     * 
     *  @method: createCustomer 
     * 
     *  @purpose: in order to create a new customer instance 
     * 
     */

     public function createCustomer()
     {
        return $customer = \Stripe\Customer::create(array(
            'email' => $this->customerEmail,
            'source' => $this->token
        ));
     }

    /**
     * 
     *  @method: charge 
     * 
     * 
     *  @purpose: in order to process a charge upon the account 
     * 
     */
    
    public function charge($document)
    {
        // init the customer instance
        $customer = $this->createCustomer();

        // now lets try to chage the customer and see if we get a 
        // response and/or the payment goes though to the system

        $charge = \Stripe\Charge::create(array(
            'amount' => $this->amount,
            'currency' => $this->currency,
            'customer' => $customer->id,
            'description' => 'Charge for legal document'
        ));
        // return the charge response upstream....

        return $charge;
    }

}

?>
