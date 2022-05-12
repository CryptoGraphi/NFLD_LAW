/**
 * 
 *  contract.js (view file)
 * 
 */


import { initStripe } from "../../modules/stripe.js";

const fetchDocumentName = () => {
    let $url = window.location.pathname;
    let splitUrl = $url.split('/');
    return splitUrl[3];
}

const generateActionURL = ($type) => {
    return '/gateway/proccess/' + fetchDocumentName() + '/' + $type + '/';
}

console.log(generateActionURL('free'))

let btnLicence = document.getElementById('input-select-licence');
let licenceContainer = document.getElementById('content-licence-container');

btnLicence.addEventListener('click', () => {

    if (licenceContainer.hidden === true) {
        licenceContainer.hidden = false; 
        licenceContainer.classList.add('apply-fade');
        btnLicence.innerText = 'Hide Licence Pannel';
    } else if (licenceContainer.hidden === false ) {
        licenceContainer.hidden = true;
        btnLicence.innerText = 'Select Licence';
    }
});

// button events for the page

let btnFree = document.getElementById('btn-free');
let btnDonate = document.getElementById('btn-donate')
let btnCustom = document.getElementById('btn-customPayment');
let btnFullPrice = document.getElementById('btn-fullPrice');

// payment pannel dom elements

let paymentModel = document.getElementById('payment-modal');
let paymentModalContent = document.getElementById('payment-form');
let closeModal = document.getElementById('close-modal');


// add events based on the payment type 
// change the action event based on the click event  :P




closeModal.addEventListener('click', () => {
    paymentModel.style.display = 'none';
    // insert form content  
});

 btnFree.addEventListener('click', () => {
    paymentModel.style.display = 'block';
    // insert html
    

    paymentModalContent.action = generateActionURL('free');

    paymentModalContent.innerHTML = ` <div class="form-row">
    <b> Please fill out information inorder to continue </b>
<div id="card-errors" class='text-danger'></div>
<div class='form-group m-2'>
    <label> Email Address </label>
    <input type='email' class='form-control' name='email' />
</div>

<div class='form-group m-2'>
    <label> Full name </label>
    <input type='text' class='form-control' name='fullname' />
</div>
</div>
<div class='form-group m-2'>
        <button class='StripePaymentButton'>Generate Document</button>
</div>`;
 });

btnDonate.addEventListener('click', () => {
    paymentModel.style.display = 'block';
    // insert html
    paymentModalContent.action = generateActionURL('donate');

    paymentModalContent.innerHTML = `     <div class="form-row">
    <b> Please fill out payment information inorder to continue </b>
<div id="card-errors" class='text-danger'></div>

<div class='form-group m-2'>
    <label> Email Address </label>
    <input type='email' class='form-control' name='email' />
</div>

<div class='form-group m-2'>
    <label> Full name </label>
    <input type='text' class='form-control' name='fullname' />
</div>

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
</div>`;
    initStripe();
});

btnCustom.addEventListener('click', () => {
    paymentModel.style.display = 'block';
    // insert html
    paymentModalContent.action = generateActionURL('custom');

    paymentModalContent.innerHTML = `     <div class="form-row">
    <b> Please fill out payment information inorder to continue </b>
<div id="card-errors" class='text-danger'></div>
<div class='form-group m-2'>
    <label> Email Address </label>
    <input type='email' class='form-control' name='email' />
</div>

<div class='form-group m-2'>
    <label> Full name </label>
    <input type='text' class='form-control' name='fullname' />
</div>

<div class='form-group m-2'>
    <label> Amount $ </label>
    <input type='number' class='form-control' name='amount'  step='0.01' min='1.00' max='1000.00'/>
</div>

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
</div>`;
    initStripe();
});

btnFullPrice.addEventListener('click', (e) => {
    paymentModel.style.display = 'block';
    // insert html
    paymentModalContent.action = generateActionURL('paid');


    paymentModalContent.innerHTML = `     <div class="form-row">
    <b> Please fill out payment information inorder to continue </b>
<div id="card-errors" class='text-danger'></div>

<div class='form-group m-2'>
    <label> Email Address </label>
    <input type='email' class='form-control' name='email' />
</div>

<div class='form-group m-2'>
    <label> Full name </label>
    <input type='text' class='form-control' name='fullname' />
</div>

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
        <button class='StripePaymentButton' >Submit Payment</button>
</div>`;  
initStripe();

  
});