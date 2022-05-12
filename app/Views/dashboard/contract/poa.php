<?php 


function generateProvinceList()
{
    $provinceName = ['Ontario', 'Quebec', 'Nova Soctia', 'New Brunswick', 'Manitoba', 'British Columbia', 
    'Prince Edward Island', 'Saskatchewan', 'Alberta', 'NewFoundland and Labrador'];
    $provinceValue = ['ON', 'QC', 'NS', 'NB', 'MB', 'BC', 'PE', 'SK', 'AB', 'NL'];

    for ($i = 0; $i < sizeof($provinceValue); $i++) {
        echo "<option value='". $provinceValue[$i]."'> ".$provinceName[$i]."</option>";
    }


}
?>

<div class='container bg-white p-5 shadow-lg' style='margin-top: 10%;'>

    <div class='row'>
        <h1> <?php echo $headerTitle; ?> </h1>
        <hr />
        <p class='mt-4'> Please go though our interactive wizard to
            generate your <b> "Personalized" </b> legal contract </p>
    </div>

    <div class='row mt-4'>
        <div class='col-md-12 mb-4 mt-4'>
            <h1 style='font-size: 26px;'> Getting Started </h1>
            <hr/>
            <p class='mt-2'>Just follow the step-by-step instructions to fill out the necessary information for your forms.</p>
        </div>

        <div class='col-sm dashboard-tile'>
        <img src='/img/SVG/lawyer.svg' class='img-fluid' />
            <p class='text-bold dashboard-hero'> Choose your document </p>
        </div>

        <div class='col-sm dashboard-tile'>
            <img src='/img/SVG/question.svg' class='img-fluid' />
            <p class='text-bold dashboard-hero dashboard-hero-m'> Answer a few simple questions</p>
        </div>
        <div class='col-sm dashboard-tile'>
            <img src='/img/SVG/time.svg' class='img-fluid'/>
            <p class='text-bold dashboard-hero'> It take(s) just 5 minute(s) </p>
        </div>
    </div>

    <div class='row mt-4'>
        <div class="progress">
            <div class="progress-bar" id='progressBar' role="progressbar" aria-valuenow="0" aria-valuemin="0"
                aria-valuemax="100"' '></div>
        </div>
    </div>

    <div class='row mt-4'>
        <ul class="nav nav-tabs navigation">
            <li id='nav-tab-started' class="nav-item"><a class="nav-link active">Get Started</a></li>
            <li id='nav-tab-agent' class="nav-item"><a class="nav-link" >Attorney </a></li>
            <li id='nav-tab-powers' class='nav-item'> <a class='nav-link'> Powers </a></li>
            <li id='nav-tab-restrictions' class="nav-item"><a class="nav-link">Restrictions</a></li>
            <li id='nav-tab-misc' class='nav-item'><a class='nav-link'> Misc. </a></li>
            <li class='nav-item' id='nav-tab-signing'> <a class='nav-link'> Signing </a></li>
        </ul>
    </div>

    <div class='row mt-4' style='margin: 0px; padding: 0px;'>
        <div class="card mt-4" style='padding: 0px;'>
            <div class="card-header">
                <h2 id='title_' style='text-align: center;'> Getting started </h2>
                <small> Please fill out information to generate your document </small>
            </div>
            <div class="card-body">

                <form method='post'  id='contract-form' action='/render/contract/poa/'>
                    <fieldset class='step active'>
                        <h2 class='text-center'>What type of Power of Attorney do you wish to create?</h2>
                        <p class='error-message text-danger text-center'></p>
                        <div class='row'>
                            <div class='col-sm iconTile'>
                                <i class="fa fa-handshake-o icon"> </i>
                                <div class='col-sm'>
                                    <label for='form-relationshipStatus'> Ordinary </span>
                                        <input type='radio' value='ordinary' class='form-check-input'
                                            name='form-documentType' />
                                </div>
                            </div>
                            <div class='col-sm iconTile'>
                                <i class="fa fa-heartbeat icon"></i>
                                <div class='col-sm'>
                                    <lsbel> Enduring </label>
                                        <input type='radio' value='enduring' class='form-check-input'
                                            name='form-documentType' />
                                </div>
                            </div>
                        </div>


                        <p class='mt-3'>An <strong>Ordinary
                            </strong> Power of Attorney is only valid as long as the donor is capable of acting for him
                            or herself. If the donor becomes mentally incompetent (loses capacity), the ordinary Power
                            of Attorney ends.<br><br> An <strong>Enduring</strong> Power of Attorney remains valid even
                            if the donor later becomes mentally incompetent. The donor must be competent at the time an
                            enduring Power of Attorney is made.<br><br> In either case, the Power of Attorney becomes
                            invalid when the donor dies. A Power of Attorney cannot be used to bequeath property upon
                            the death of the donor.
                        </p>
                    </fieldset>


                    <fieldset class='step hidden'>
                        <h1 class='text-center' style='font-size: 28px'> Governing Law </h1>


                        <div class='form-group'>
                            <label for='form-govering-law'> Where do you live </label>
                            <small class='error-message text-center text-danger'></small>
                            <select class='form-select'>
                                <option value=''> Please select an option </option>
                                <?php echo generateProvinceList(); ?>
                            </select>
                        </div>
                    </fieldset>


                    <fieldset class='step hidden'>
                        <h3 class='text-center'> Grantor details </h3>

                        <p class='text-center'> Who is granting this Power of Attorney? </p>

                        <div class='form-group'>
                            <label for='form-grantor-name'> Full Name:</label>
                            <span class='error-message text-danger text-center'></span>
                            <input type='text' class='form-control' name='form-grantor-name' />
                        </div>

                        <div class='form-group'>
                            <label for='form-grantor-address'>Address:</label>
                            <span class='error-message text-danger text-center'></span>
                            <input type='text' class='form-control' name='form-grantor-address' />
                        </div>

                    </fieldset>

                    <fieldset class='step hidden'>
                        <h2 class='text-center'> Attorney Details </h2>
                        <p class='text-center'> Who do you wish to act on your behalf? </p>

                        <h4 class='text-center'> Attorney Information </h4>

                        <div class='form-group'>
                            <label for='form-attorney-name'>Attorney's Name</label>
                            <span class='error-message text-danger'></span>
                            <input type='text' class='form-control' name='form-attorney-details' />
                        </div>

                        <div class='form-group'>
                            <label for='form-attorney-address'> Attorney's Address </label>
                            <span class='error-message text-danger'></span>
                            <input type='text' class='form-control' name='form-attorney-address' />
                        </div>

                    </fieldset>


                    <fieldset class='step hidden'>

                        <h2 class='text-center'> Alternative Attorney Details </h2>
                        <p class='text-center'> Who do you wish to act on your behalf? </p>

                        <p> An alternate can act for you when your primary Attorney is unable or unwilling. </p>


                        <div class='form-group'>
                            <label for='form-alt-attorney-name'>Attorney's Name</label>
                            <span class='error-message text-danger'></span>
                            <input type='text' class='form-control' name='form-alt-attorney-details' />
                        </div>

                        <div class='form-group'>
                            <label for='form-attorney-address'> Attorney's Address </label>
                            <span class='error-message text-danger'></span>
                            <input type='text' class='form-control' name='form-alt-attorney-address' />
                        </div>
                    </fieldset>


                    <fieldset class='step hidden'>
                        <h2 class='text-center'>Attorney Powers</h2>
                        <p> Do you wish to grant your Attorney General Authority? </p>
                        <p style='color: slategrey; font-style: italic;'> This will grant your Attorney authority to act
                            for you in all areas, and to do any act or thing that you could do if personally present.
                        </p>

                        <div class='row'>
                            <span class='text-danger error-message'></span>
                        </div>

                        <div class='form-group'>

                            <span> Yes </span>
                            <input type='radio' name='form-attorney-powers-authority' class='form-check-input'
                                value='true' />
                            <span> No </span>
                            <input type='radio' name='form-attorney-powers-authority' class='form-check-input'
                                value='false' />
                        </div>

                    </fieldset>


                    <fieldset class='step hidden'>
                        <h2 class='text-center'> Attorney Powers </h2>
                        <p class='text-center'> Select any powers you would like to grant to your attorney </p>

                        <ul class="list-group list-group-underline">
                            <li class="list-group-item">
                                <div class='form-group'>
                                    <i class="fa fa-building" style='font-size: 28px; margin-right: 25px;'
                                        aria-hidden="true"></i>
                                    <label for='form-attorney-powrers-realestate'> Real Estate </label>
                                    <input type='checkbox' class='input-type-check' />
                                    <p class='small-caption text-center'> To sell, mortgage, exchange, lease or
                                        otherwise
                                        deal with real estate/land. </p>
                                </div>

                            </li>

                            <li class="list-group-item">

                                <div class='form-group'>
                                    <i class='fa fa-home' style='font-size: 28px; margin-right: 25px;'
                                        aria-hidden='true'></i>
                                    <label for='form-attorney-powers-home'> Home Expenses</label>
                                    <input type='checkbox' class='input-type-check' />
                                    <p class='small-caption text-center'>Any expenditures needed so the Donor can stay
                                        at
                                        home as long as possible.</p>
                                </div>

                            </li>
                            <li class="list-group-item">
                                <div class='form-group'>
                                    <i class='fa fa-users' style='font-size: 28px; margin-right: 25px;'
                                        aria-hidden='true'></i>
                                    <label for='form-attorney-powers-family'> Family Expenses </label>
                                    <input type='checkbox' class='input-type-check' />
                                    <p class='small-caption text-center'>Any expenditures to cover education, medical
                                        care,
                                        etc. of yourself and family.</p>
                                </div>

                            </li>
                            <li class="list-group-item">
                                <div class='form-group'>
                                    <i class="fa fa-university" style='font-size: 28px; margin-right: 25px;'
                                        aria-hidden="true"></i>
                                    <label for='form-attorney-taxes'> Tax Matters </label>
                                    <input type='checkbox' class='input-type-check' />
                                    <p class='small-caption text-center'>To take any action required to fulfill tax
                                        obligations. </p>
                                </div>


                            </li>
                            <li class="list-group-item">
                                <div class='form-group'>
                                    <i class="fa fa-gift" style='font-size: 28px; margin-right: 25px'
                                        aria-hidden="true"></i>
                                    <label for='form-attorney-powers-gifts-family'>Gifts for Family</label>
                                    <input type='checkbox' class='input-type-check' />
                                    <p class='small-caption text-center'>The power to provide gifts to family on special
                                        occasions.</p>
                                </div>


                            </li>
                            <li class='list-group-item'>
                                <div class='form-group'>
                                    <i class="fa fa-handshake-o" style='font-size: 28px; margin-right: 25px;'
                                        aria-hidden="true"></i>
                                    <label for='form-attorney-powers-gifts-charity'>Gifts for Charity</label>
                                    <input type='checkbox' class='input-type-check' />
                                    <p class='small-caption text-center'>The power to continue providing gifts to
                                        charities
                                        as you have in the past. </p>
                                </div>


                            </li>
                            <li class='list-group-item'>
                                <div class='form-group'>
                                    <i class='fa fa-area-chart' style='font-size: 28px; margin-right: 25px'
                                        aria-hidden="true"></i>
                                    <label for='form-attorney-powers-business-investments'>Business Investments </label>
                                    <input type='checkbox' class='input-type-check' />
                                    <p class='small-caption text-center'>The power to vote as proxy and manage all
                                        shares.
                                    </p>
                                </div>


                            </li>
                            <li class='list-group-item'>
                                <div class='form-group'>
                                    <i class="fa fa-line-chart" style='font-size: 28px; margin-right: 25px;'
                                        aria-hidden="true"></i>
                                    <label for='form-attorney-powers-stocks'>Stocks and Bonds</label>
                                    <input type='checkbox' class='input-type-check' />
                                    <p class='small-caption text-center'>The power to retain and re-invest assets and
                                        investments </p>
                                </div>
                            </li>
                            <li class='list-group-item'>
                                <div class='form-group'>
                                    <i class="fa fa-black-tie" style='font-size: 28px; margin-right: 25px;'
                                        aria-hidden="true"></i>
                                    <label for='form-attorney-powers-employ'>Employ Required Professionals</label>
                                    <input type='checkbox' class='input-type-check' />
                                    <p class='small-caption text-center'>The power to employ any professionals for the
                                        care of you or your family. </p>
                                </div>

                            </li>
                        </ul>

                    </fieldset>


                    <fieldset class='step hidden'>
                        <div class='row'>
                            <h1 class='text-center'>Limited Powers</h1>
                            <p class='text-center'> Select Additional Limited Powers </p>
                            <span class='small-caption text-center'> Select any options that apply </span>
                        </div>

                        <div class='row'>
                            <ul class="list-group list-group-underline">
                                <li class="list-group-item">
                                    <div class='form-group'>
                                        <label for='form-limitedPowers'> Sale of Specific Property </label>
                                        <input type='checkbox' class='form-type-check' />
                                        <p class='small-caption text-center'>To complete all matters and documents for
                                            the sale of specific property.</p>
                                    </div>
                                </li>

                                <li class='list-group-item'>
                                    <div class='form-group'>
                                        <label>Purchase of Specific Property</label>
                                        <input type='checkbox' class='form-type-check' />
                                        <p class='small-caption text-center'>To complete all matters and documents for
                                            the purchase of specific property. </p>
                                    </div>
                                </li>
                                <li class='list-group-item'>
                                    <div class='form-group'>
                                        <label>Collect Rent</label>
                                        <input type='checkbox' class='form-type-check' />
                                        <p class='small-caption text-center'>To manage and collect rent for specific
                                            properties that you own.</p>
                                    </div>

                                </li>

                                <li class='list-group-item'>
                                    <div class='form-group'>
                                        <label>Bank Accounts</label>
                                        <input type='checkbox' class='form-type-check' />
                                        <p class='small-caption text-center'> To have control over specific bank
                                            accounts </p>
                                    </div>
                                </li>
                            </ul>

                        </div>
                    </fieldset>

                    <fieldset class='step hidden'>

                        <div clas='row'>
                            <h1 class='text-center'> Restrictions </h1>
                            <p class='text-center'> Do you wish to put restrictions on your Attorney? </p>
                            <span class='text-danger error-message'></span>
                        </div>

                        <div class='row'>
                            <div clas='form-group' style='margin: auto; width: auto'>
                                <label> Yes </label>
                                <input type='radio' class='form-type-check' id='form-restrictions-true' value='true'
                                    name='form-restrictions' />
                                <label> No </label>
                                <input type='radio' class='form-type-check' id='form-restrictions-false' value='false'
                                    name='form-restrictions' />
                            </div>
                        </div>


                        <div class='row text-center' id='form-restrictions-pannel' style='margin-top: 25px;' hidden>
                            <h4 class='text-center' style='font-size: 18px; font-weight: 400;'> Select the restrictions
                                you wish to put on your Attorney: </h4>

                            <ul class="list-group list-group-underline">
                                <li class='list-group-item'>
                                    <div class='form-group'>
                                        <input type='checkbox' class='form-check-input' />
                                        <label> I wish to live independently as long as possible and have my money spent
                                            for that purpose. </label>
                                    </div>
                                </li>
                                <li class='list-group-item'>
                                    <div class='form-group'>
                                        <input type='checkbox' class='form-check-input' />
                                        <label> I restrict the types of investments my Attorney can make with my money
                                            to only government issued savings bonds. </label>
                                    </div>
                                </li>

                            </ul>
                        </div>

                    </fieldset>

                    <fieldset class='step hidden'>
                        <div class='row'>
                            <h1 class='text-center'> Attorney Pay </h1>
                            <p class='text-center'> How will my Attorney be paid financially? </p>
                            <small class='text-center text-danger error-message'></small>
                        </div>

                        <div class='col'>
                            <div class='col-sm iconTile'>

                                <div class='col-sm'>
                                    <i class="bi bi-wallet2" style='font-size: 28px; margin-right: 25px;'
                                        aria-hidden="true"></i> <input type='radio' value='single'
                                        class='form-check-input' name='form-attorney-payment' />
                                    <span for='form-relationshipStatus'> Out of pocket expenses </span>

                                </div>
                            </div>

                            <div class='col-sm iconTile'>
                                <div class='col-sm'>

                                    <i class="bi bi-percent" style='font-size: 28px; margin-right: 25px'></i>
                                    <input type='radio' value='lawrate' class='form-check-input'
                                        name='form-attorney-payment' />
                                    <span class='text-center'> Rate set by law </span>

                                </div>

                            </div>
                        </div>
                    </fieldset>

                    <fieldset class='step hidden'>
                        <div class='row'>
                            <h1 class='text-center'> Financial Statements </h1>
                            <p class='text-center'> Do you want your Attorney to prepare financial statements? </h1>
                            <p class='text-danger text-center error-message'></p>
                        </div>

                        <div class='row'>
                            <div class='form-group' style='width: auto; margin: auto;'>
                                <label> Yes </label>
                                <input type='radio' id='form-financial-reports-true'  name='accountant-form' value='true' class='form-check-input' />
                                <label> No </label>
                                <input type='radio' id='form-financial-reports-false' name='accountant-form' value='false' class='form-check-input' />
                            </div>

                            <div id='form-accountant-wrapper' hidden>

                                <div class='row'>
                                    
                                    <div class='form-group mt-4 '>
                                        <label> How often should reports be sent </label>
                                        <p class='text-center text-danger error-message'></p>
                                        <select class='form-select'>
                                            <option value=''> Please select an option </option>
                                            <option value='monthly'> Monthly </option>
                                            <option value='semi-yearly'> Semi Yearly </option>
                                            <option value='yearly'> Yearly </option>
                                        </select>
                                    </div>

                                </div>

                                <div class='row mt-2'>
                                    <h2 class='text-center' style='font-size: 20px;'> Who should reports be sent to</h2>
                                    <p class='text-center text-danger error-message'></p>
                                    <div class='form-group'>
                                        <label> Full Name </label>
                                        <input type='text' class='form-control' />
                                    </div>
                                    <div class='form-group'>
                                        <label> Address </label>
                                        <input type='text' class='form-control' />
                                    </div>
                                </div>

                            </div>

                    </fieldset>

                    <fieldset class='step hidden'>
                        <div class='row'>
                            <h1 class='text-center'> Termination of the Power of Attorney </h1>
                            <p class='text-center'> Do you wish to specify when this Power of Attorney will end? </p>
                        </div>

                        <div class='row'>
                            <span class='text-center text-danger error-message'></span>
                            <div class='form-group' style='margin: auto; width: auto;'>
                                <span> Yes </span>
                                <input type='radio'  id='poa-termination-true' name='form-termination-date' value='' />
                                <span> No </span>
                                <input type='radio' id='poa-termination-false' name='form-termination-date' value='' />
                            </div>
                        </div>

                        <div class='row mt-4' id='poa-date-pannel' hidden>
                            <label class='text-center'> Date of Termination</label>
                            <small class='text-center text-danger error-message'></small>
                            <input type='date' class='form-control mt-2' name='date' />
                        </div>
                    </fieldset>

                    <fieldset class='step hidden'>
                        <div class='row'>
                            <h2 class='text-center'> Signing Details </h2>
                            <small class='small-caption'> Where will you sign the document </small>
                        </div>

                        <div clas='row'>
                            <div class='form-group'>
                                <label> Province </label>
                                <span class='text-danger text-center error-message'></span>
                                <select class='form-select'>
                                    <option value=''></option>
                                    <?php echo generateProvinceList(); ?>
                                </select>
                            </div>

                            <div class='form-group'>
                                <label> City </label>
                                <span class='text-danger text-center error-message'></span>
                                <input type='text' class='form-control' />
                            </div>

                            <div class='form-group mt-4' style='width: auto; margin: auto;'>
                                <button class='btn started'>Generate Document</button>
                            </div>


                            <input type='hidden' name='_data_' value='' id='_data_' />
                        </div>
                    </fieldset>

            </div>
            </form>


            <div class='card-footer'>
                <div class='form-group' style='margin-left: 35%;'>
                    <button class='btn started btn-lg' style='padding-right: 5%; padding-left: 5%;'
                        id='btn-back'>Previous</button>
                    <button class='btn started btn-lg' style='padding-right: 5%; padding-left: 5%;' id='btn-next'> Next
                    </button>
                </div>
                <small style='color: slategray; font-style: italic; text-align: center'>&copy NFLD LEGAL </small>


            </div>

        </div>
    </div>


</div>