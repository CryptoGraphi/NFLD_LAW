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
    </div>


    <div class='row mt-3'>

        <div class='form-group' style='margin: auto; width: auto;'>
            <button class='btn started'> Select Licence</button>
        </div>


    </div>

    <div class='row mt-3 text-center'>

        <h2> Pricing </h2>
        <small class='small-caption mt-2 mb-2'> Print and download your
            <?php echo $contractTitle; ?> as soon as you select an option below.</small>
        <div class='col-md-6'>
            <div class='card'>
                <div class='card-header'>
                    <h2> Full Price </h2>
                </div>

                <div class='card-body' style='padding: 10px;'>
                <h1 class="card-title pricing-card-title">$250 </h1>
                    <ul class="list-unstyled mt-3 mb-4">
                    <li> <b> Features: </b></li>
                        <li> Download legal contract in pdf format </li>
                        <li> Store and download anytime </li>
                        <li> Change / update anytime 24/7 </li>
                    </ul>

                </div>
            </div>
        </div>

        <div class='col-md-6'>
            <div class='card'>
                <div class='card-header'>
                    <h2> Donate Option </h2>
                </div>
                <div class='card-body' style='padding: 10px;'>
                <h1 class="card-title pricing-card-title">$250  <small class="text-muted"> / Donate option </small></h1>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li> <b> Features: </b></li>
                        <li> Download legal contract in pdf format </li>
                        <li> Store and download anytime </li>
                        <li> Change / update anytime 24/7 </li>
                    </ul>

                </div>
            </div>
        </div>

        <div class='col-md-6 mt-3'>
            <div class='card'>
                <div class='card-header'>
                    <h2> Pay what you want </h2>
                </div>

                <div class='card-body' style='padding: 10px;'>
                <h1 class="card-title pricing-card-title">$0  <small class="text-muted"> / You choose the price </small> </h1>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li> <b> Features: </b></li>
                        <li> Download legal contract in pdf format </li>
                        <li> Document is never stored </li>
                    </ul>

                </div>
            </div>
        </div>

        <div class='col-md-6 mt-3'>
            <div class='card'>
                <div class='card-header'>
                    <h2> Free </h2>
                </div>


                <div class='card-body' style='padding: 10px;'>
                    <h1 class="card-title pricing-card-title">$0 </h1>
                    <ul class="list-unstyled mt-3 mb-4">
                        <li> <b> Features: </b></li>
                        <li> Download legal contract in pdf format </li>
                        <li> Document is never stored </li>
                    </ul>
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