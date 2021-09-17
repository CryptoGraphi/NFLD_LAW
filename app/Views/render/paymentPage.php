<?php

/**
 * 
 *  page for adding the payment information of the page 
 * 
 * 
 */

?>

<div class='container'>
    <div class='row text-center mt-3'>
        <h4> To download and print your <?php echo $contractTitle ?>, you must select a licence. </h4>
        <h5>
            </h4>
            <div class='col-sm-4' style='width: 50%; height: 50%; margin: auto;'>
                <img src='/img/SVG/document_review.svg' class='img-fluid'>
            </div>
    </div>

    <div class='row mt-3'>

        <div class='form-group' style='margin: auto; width: auto;'>
            <button class='btn started' id='input-select-licence'> Select Licence</button>
        </div>
    </div>

    <div class='row mt-3'>

        <div class='modal' id='payment-modal'>

            <div class='modal-content'>

                <div class="modal-header p-4 text-center">
                    <h4> Payment  <i class='fa fa-credit-card'></i></h4>
                    <span class="close" id='close-modal'>&times;</span>
                </div>

                <div class='modal-body'>
                <form action="/gateway/proccess/" method="post" id="payment-form">
                    <div class="form-row">
                        <b> Please fill out payment information inorder to continue </b>
                    <div id="card-errors" class='text-danger'></div>

                        <label for="card-number">Credit or debit card</label>
                        <div id="card-number">
                            <!-- a Stripe Element will be inserted here. -->
                        </div>

                        <label for='card-cvc'> Card CVC </label>
                        <div id='card-cvc'>

                        </div>

                        <label for='card-expiry'> Card Expiry </label>
                        <div id='card-expiry'>

                        </div>
                        <!-- Used to display form errors -->
                    </div>
                    <div class='form-group m-2'>
                            <button class='StripePaymentButton'>Submit Payment</button>
                    </div>
                </form>


                <div class='col-sm'>
                <small style='color: slategray; font-style: italic; text-align: center'  cl>&copy NFLD LAW
                    (freeWillLawyer)</small>

                
                    <i class="fa fa-cc-amex m-2" style='font-size: 32px; color:  #007bc1;' ></i>
                    <i class="fa fa-cc-mastercard m-2" style='font-size: 32px; color: #0a3a82;'></i>
                    <i class="fa fa-cc-visa m-2" style='font-size: 32px; color: #0157a2;'></i>
                    
                </div>
            </div>
            </div>
        </div>
    </div>


    <div class='row mt-3 text-center' id='content-licence-container' hidden>

        <h3> Pricing </h3>
        <small class='small-caption mt-2 mb-2'> Print and download your
            <?php echo $contractTitle; ?> as soon as you select an option below.</small>
        <div class='col-md-6'>
            <div class='card'>
                <div class='card-header'>
                    <h3> Full Price </h3>
                </div>

                <div class='card-body' style='padding: 10px;'>
                    <h1 class="card-title pricing-card-title">$250 </h1>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li> <b> Features: </b></li>
                        <li> Download legal contract in pdf format </li>
                        <li> Store and download anytime </li>
                        <li> Change / update anytime 24/7 </li>
                    </ul>
                    <button class='btn started' id='btn-fullPrice'>Select Licence</button>
                </div>
            </div>
        </div>

        <div class='col-md-6'>
            <div class='card'>
                <div class='card-header'>
                    <h3> Donate Option </h3>
                </div>
                <div class='card-body' style='padding: 10px;'>
                    <h1 class="card-title pricing-card-title">$250 <small class="text-muted"> / Donate option </small>
                    </h1>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li> <b> Features: </b></li>
                        <li> Download legal contract in pdf format </li>
                        <li> Store and download anytime </li>
                        <li> Change / update anytime 24/7 </li>
                    </ul>
                    <button class='btn started' id='btn-donate'>Select Licence</button>
                </div>
            </div>
        </div>

        <div class='col-md-6 mt-3'>
            <div class='card'>
                <div class='card-header'>
                    <h3> Pay what you want </h3>
                </div>

                <div class='card-body' style='padding: 10px;'>
                    <h1 class="card-title pricing-card-title">$0 <small class="text-muted"> / You choose the price
                        </small> </h1>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li> <b> Features: </b></li>
                        <li> Download legal contract in pdf format </li>
                        <li> Document is never stored </li>
                    </ul>
                    <button class='btn started' id='btn-customPayment'>Select Licence</button>
                </div>
            </div>
        </div>

        <div class='col-md-6 mt-3'>
            <div class='card'>
                <div class='card-header'>
                    <h3> Free </h3>
                </div>


                <div class='card-body' style='padding: 10px;'>
                    <h1 class="card-title pricing-card-title">$0 </h1>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li> <b> Features: </b></li>
                        <li> Download legal contract in pdf format </li>
                        <li> Document is never stored </li>
                    </ul>
                    <button class='btn started' id='btn-free'>Select Licence</button>
                </div>
            </div>
        </div>


    </div>


    <div class='row mt-3'>
        <div class='card' style='padding: 0px;'>
            <div class='card-header'>
                <h3 class='text-center'>Please carefully review document before downloading</h3>
            </div>

            <div class='card-body'>
                <?php echo $contractContent;  ?>
            </div>
        </div>
    </div>
</div>