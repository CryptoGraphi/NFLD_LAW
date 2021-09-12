<?php 


function generateProvinceList()
{
    $provinceName = ['Ontario', 'Quebec', 'Nove Soctia', 'New Brunswick', 'Manitoba', 'British Columbia', 
    'Prince Edward Island', 'Saskatchewan', 'Alberta', 'NewFoundland and Labrador'];
    $provinceValue = ['ON', 'QC', 'NS', 'NB', 'MB', 'BC', 'PE', 'SK', 'AB', 'NL'];

    for ($i = 0; $i < sizeof($provinceValue); $i++) {
        echo "<option value='". $provinceValue[$i]."'> ".$provinceName[$i]."</option>";
    }


}

var_dump($_POST);

?>

<div class='container' style='margin-top: 10%;'>

    <div class='row'>
        <h1 class='text-center'> <?php echo $headerTitle; ?> </h1>
        <small style='color: slategray; font-style: italic;' class='mt-4'> Please go though our interactive wizard to
            generate your <b> "Personalized" </b> legal contract </small>
    </div>

    <div class='row mt-4'>
        <div class='col-sm iconTile'>
            <img src='/img/SVG/document_choose.svg' class='img-fluid' />
            <span> Choose your document </span>
        </div>

        <div class='col-sm iconTile'>
            <img src='/img/SVG/fill_form.svg' class='img-fluid' />
            <span> Answer a few simple questions</span>
        </div>
        <div class='col-sm iconTile'>
            <img src='/img/SVG/clock.svg' class='img-fluid' />
            <span> It take(s) just 5 minute(s) </span>
        </div>

    </div>

    <div class='row mt-4'>
    <div class="progress" >
  <div class="progress-bar" id='progressBar' role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"' '></div>
</div>
    </div>

    <div class='row mt-4'>
        <ul class="nav nav-tabs">
            <li id='nav-tab-started' class="nav-item"><a class="nav-link active" href="#">Get Started</a></li>
            <li id='nav-tab-executor' class="nav-item"><a class="nav-link" href="#">Executor </a></li>
            <li id='nav-tab-backupExecutor' class='nav-item'> <a class='nav-link' href='#'> Backup Executor </a></li>
            <li  id='nav-tab-children' class="nav-item"><a class="nav-link" href="#">Children</a></li>
            <li id='nav-tab-gifts' class='nav-item'><a class='nav-link' href='#'> Gifts </a></li>
            <li class='nav-item' id='nav-tab-remainder'> <a class='nav-link' href='#'> Remainder </a></li>
            <li class='nav-item' id='nav-tab-final'> <a class='nav-link' href='#'> Final Details </a></li>
            <li class='nav-item' id='nav-tab-signing'> <a class='nav-link' href='#'> Signing </a></li>
        </ul>
    </div>

    <div class='row mt-4' style='margin: 0px; padding: 0px;'>

        <div class="card mt-4" style='padding: 0px;'>
            <div class="card-header">
                <h2 id='title_' style='text-align: center;'> Getting started </h2>
                <small> Please fill out information to generate your document </small>
            </div>
            <div class="card-body">
                <form method='post' action='/render/contract/lastwill/' id='document-content'>
                    <fieldset class='step hidden'>
                        <h3 class='text-bold text-center'> What is your marital status? </h3>
                        <small class='text-danger error-message' style='font-weight: bolder;'></small>
                        <div class='row'>
                            <div class='col-sm iconTile'>
                                <i class="bi bi-tv icon"> </i>
                                <div class='col-sm'>
                                    <label for='form-relationshipStatus'> Single </span>
                                    <input type='radio' value='single'  class='form-check-input'
                                        name='form-relationshipStatus' />
                                </div>
                            </div>
                            <div class='col-sm iconTile'>
                                <i class="bi bi-hand-index-fill icon"></i>
                                <div class='col-sm'>
                                    <lsbel> Married </label>
                                    <input type='radio' value='married' class='form-check-input'
                                        name='form-relationshipStatus' />
                                </div>
                            </div>

                            <div class='col-sm iconTile'>
                                <i class="bi bi-hourglass-split icon"></i>
                                <div class='col-sm'>
                                    <label> Common Law </label>
                                    <input type='radio' value='commonLaw' class='form-check-input'
                                        name='form-relationshipStatus' />
                                </div>

                            </div>
                        </div>


                    </fieldset>

                    <fieldset class='step hidden'>
                        <div class='row'>
                            <h3> Your spouse? </h3>
                        </div>

                        <div class='row'>
                            <div class='form-group'>
                                <label for='form-spouseName'> What is your spouses name </p>
                                    <span class='text-danger error-message'> 
                                    </span>
                                    <input type='text' class='form-control' placeholder='spouses name' />
                            </div>
                        </div>


                    </fieldset>


                    <fieldset class='step hidden'>
                        <div class='row'>
                            <h3 class='text-center' style='font-weight: 800;'> Your Details </h3>
                        </div>

                        <div class='row'>
                            <div class='form-group'>
                                <p class='text-bold' style='font-size: 18px'> Who is this Last Will being created for?
                                </p>

                                <label for='form-testor-fullname'> Full Name </label>
                                <span class='text-danger error-message'><b>  </b></span>
                                <input type='text' class='form-control' />
                            </div>

                            <div class='form-group'>
                                <label for='form-testor-city'> City </label>
                                <span class='text-danger error-message'><b> </b></span>
                                <input type='text' class='form-control' name='form-testor-city' />
                            </div>


                            <div class='form-group'>
                                <label for='form-test-province'>
                                    <label for='form-testor-province'> Province </label>
                                    <span class='text-danger error-message'><b> </b></span>
                                    <select class='form-select' name='testor-province'>
                                        <option value='' selected> Please select a Province </option>
                                        <?php  generateProvinceList(); ?>

                                    </select>
                                </label>
                            </div>
                        </div>


                    </fieldset>

                    <fieldset class='step hidden'>
                        <div class='row'>
                            <h3 class='text-center'>Choose an Executor </h3>
                        </div>

                        <div class='row'>
                            <p class='text-bold'> Executor Details </p>
                            <div class='form-group'>
                                <label for='form-executor-fullname'> Fullname </label>
                                <span class='text-danger error-message'><b>  </b></span>
                                <input type='text' class='form-control' />
                            </div>

                            <div class='form-group'>
                                <label for='form-executor-city'>City </label>
                                <span class='text-danger error-message'><b>  </b></span>

                                <input type='text' class='form-control' />
                            </div>


                            <div class='form-group'>
                                <label for='form-executor-province'>Province</label>
                                <span class='text-danger error-message'><b>  </b></span>

                                <select class='form-select'>
                                    <option value=''> Please select a province </option>
                                    <?php  echo generateProvinceList(); ?>
                                </select>
                            </div>
                        </div>
                    </fieldset>


                    <fieldset class='step hidden'>
                        <div class='row'>
                            <h3 class='text-center'>Choose a Backup Executor </h3>
                        </div>

                        <div class='row'>
                            <p class='text-bold'> Backup Executor Details </p>
                            <div class='form-group'>
                                <label for='form-backup-executor-fullname'> Fullname </label>
                                <span class='text-danger error-message'><b>  </b></span>
                                <input type='text' class='form-control' />
                            </div>

                            <div class='form-group'>
                                <label for='form-backup-executor-city'>City </label>
                                <span class='text-danger error-message'><b>  </b></span>
                                <input type='text' class='form-control' />
                            </div>


                            <div class='form-group'>
                                <label for='form-backup-executor-province'>Province</label>
                                <span class='text-danger error-message'><b>  </b></span>
                                <select class='form-select'>
                                    <option> Please select a province </option>
                                    <?php  echo generateProvinceList(); ?>
                                </select>
                            </div>
                        </div>

                    </fieldset>


                    <fieldset class='step hidden'>

                        <div class='row'>

                            <h2 class='text-center'> Children </h2>

                        </div>

                        <div class='row''>
                            <label for=' form-children-livingChildren' class='text-center'>Do you have any living
                            children?</label>
                            <span class='text-danger error-message'><b>  </b></span>
                            <div class='form-group' style='width: auto; margin: auto;'>

                                <span> Yes </span>
                                <input type='radio' name='form-children-livingChildren' id='form-children-true' class='form-check-input' value='true'/>
                                <span> No </span>
                                <input type='radio' name='form-children-livingChildren' id='form-children-false' class='form-check-input' value='false' />
                            </div>
                        </div>


                        <div class='form-group' id='form-children-amount-pannel' style='display: none;'>
                            <label> Amount of children you have ? </label>
                                <select class='form-select' id='form-children-selector' style='display: none;'>
                                    <option value=''> Please select an option </option>
                                    <?php 
                                    
                                    for ($i = 1; $i < 10; $i++)
                                    {
                                        echo "<option value='".$i ."'> ". $i . "</option>";
                                    }

?>
                                </select>
                        </div>

                                <li class='list-group-item' id='form-child-template' hidden>
                                    <div class='form-group'>
                                        <label for='form-child-name'>Child's Full Name</label>
                                        <input type='text' class='form-control' placeholder='eg: "Adam Smith"' />
                                        <span class='text-danger error-message'><b>  </b></span>

                                    </div>

                                    <div class='form-group mt-3'>
                                        <label for='form-child-name'> Is this child a minor or dependent? </label>
                                        <span class='text-danger error-message'><b>  </b></span>
                                        <span> Yes </span>
                                        <input type='radio' name='form-child-dependent' value='yes'
                                            class='form-check-input' />
                                        <span> No </span>
                                        <input type='radio' name='form-child-dependent' value='no'
                                            class='form-check-input' />
                                    </div>
                                </li>

                                <ul class='list-group' id='form-child-container'></ul>

                    </fieldset>

                    <fieldset class='step hidden'>
                        <div class='row'>
                            <h2 class='text-center'> Appoint a Guardian </h2>
                        </div>

                        <div class='row'>
                            <p style='font-size: 18px' class='text-center'>Do you want to appoint a guardian for your
                                minor or dependent child if your spouse does not survive you? </p>

                            <span class='text-center text-danger error-message'>  </span>
                            <div class='form-group' style='width: auto; margin: auto;'>
                                <span> Yes </span>
                                <input type='radio' class='form-check-input' id='input-apointguardian-true' name='form-appointGuardian-input' value='yes' />
                                <span> No </span>
                                <input type='radio' class='form-check-input' id='input-apointguardian-false' name='form-appointGuardian-input' value='no' />
                            </div>


                            <div class='row mt-4' id='form-apointGuardian' hidden>
                                <h2 class='text-center'>Guardian Details</h2>
                                <div class='form-group'>
                                    <label for='form-backup-guardian-fullname'> Fullname </label>
                                    <span class='text-center text-danger error-message'></span>
                                    <input type='text' class='form-control' />
                                </div>

                                <div class='form-group'>
                                    <label for='form-backup-guardian-city'>City </label>
                                    <span class='text-center text-danger error-message'> </span>
                                    <input type='text' class='form-control' />
                                </div>


                                <div class='form-group'>
                                    <label for='form-backup-guardian-province'>Province</label>
                                    <span class='text-center text-danger error-message'> </span>
                                    <select class='form-select'>
                                        <option value=''> Please select a province </option>
                                        <?php  echo generateProvinceList(); ?>
                                    </select>
                                </div>

                            </div>

                        </div>
                    </fieldset>


                    <fieldset class='step hidden'>

                        <div class='row'>
                            <h2 class='text-center'>Delay Inheritance</h2>
                        </div>

                        <div class='row mt-3'>
                            <p class='text-center'> Do you want your minor beneficiaries to wait until a certain age
                                before they receive their inheritance? </p>
                            <div class='form-group' style='width: auto; margin: auto;'>
                                <span> Yes </span>
                                <input type='radio' id='form-delayInheritance-true' name='input-delayInheritance' class='form-check-input' />
                                <span> No </span>
                                <input type='radio' id='form-delayInheritance-false' name='input-delayInheritance' class='form-check-input' />
                            </div>
                        </div>

                        <div class='row mt-3' id='delayInheritance-form' hidden>

                            <label for='form-inheritanceAge'>
                                Receive inheritance at age:
                            </label>

                            <select class='form-select mt-2' >
                                <?php 
                            for ($i = 18; $i <= 65; $i++) {
                                echo "<option value='". $i . "'>". $i ." </option>";
                            }
                        ?>
                            </select>


                        </div>

                    </fieldset>

                    <fieldset class='step hidden'>
                        <div class='row'>
                            <h2 class='text-center'>Gifts</h2>
                        </div>

                        <div class='row'>
                            <h4 class='text-center'>
                                Do you want to leave any specific gifts in your will?
                            </h4>
                            <span class='text-danger text-center error-message'>  </span>
                            <div class='form-group' style='width: auto; margin: auto;'>
                                <span> Yes </span>
                                <input type='radio' class='form-input-check' id='form-gifts-input-true' name='form-gifts' value='true' />
                                <span> No </span>
                                <input type='radio' class='form-input-check' id='form-gifts-input-false' name='form-gifts' value='false' />
                            </div>
                        </div>


                        <div class='row' id='form-gifts-amount' hidden>
                            <h4> Amount of gifts? </h4>
                            <small class='small-caption'> How many gifts to you want to add to your "Last Will" </small>
                            <select class='form-select' id='form-gift-amount-select'>
                                <option> Please select an option </option>
                                <?php
                                    
                                        for ($i = 1; $i < 10; $i++) {
                                            echo "<option value='".$i."'>".$i ." </option>";
                                        }
                                    ?>
                            </select>
                        </div>

                           <!-- template section gift type  !-->
                           <div class='row mt-4 gift-type-container' style='height: auto;' hidden>
                            <h4 class='text-center'> Gift </h4>
                            <small class='text-center' style='color: slategray; font-style: italic;'> Who will recive
                                the gift? </small>
                            <span class='text-center text-danger'> Please select an option inorder to continue </span>

                            <div class='col-sm iconTile'>
                                <i class="fa fa-building icon" aria-active="true"></i>
                                <div class='form-group mt-2' style='width: auto; margin: auto;'>
                                    <span style='font-weight: bolder;'> Business or charity </span>
                                    <input type='radio' value='business' name='form-gift-type'
                                        class='form-check-input'     />
                                </div>
                            </div>


                            <div class='col-sm iconTile'>
                                <i class="fa fa-id-card-o icon" aria-active="true"></i>
                                <div class='form-group' style='width: auto; margin: auto;'>
                                    <span style='font-weight: bolder;'> Individual </span>
                                    <input type='radio' value='individual' name='form-gift-type'
                                        class='form-check-input' />

                                </div>
                            </div>

                            <!--  child node container !-->
                            <div class='gift-form-container'>

                            </div>
                        </div>

                        <div class='row'>
                            <div id='form-gifts-container'>
                                            
                            </div>
                        </div>

                     



                        <!-- gift container templates     !-->
                        <div class='gift-container-templates' hidden>


                            <!--   container individual type !-->
                            <div class='row form-individual' >
                                <h2 class='text-center'> Gift Details </h2>
                                <small class='small-caption'> Individual </small>
                                <div class='form-group'>
                                    <label> Gift Description</label>
                                    <span class='text-danger text-center error-message'>  </span>
                                    <input type='text' class='form-control' />
                                </div>

                                <div class='form-group'>
                                    <label> Full name </label>
                                    <span class='text-danger text-center error-message'>  </span>
                                    <input type='text' class='form-control' />
                                </div>

                                <div class='form-group'>
                                    <label> City / Town </label>
                                    <span class='text-danger text-center error-message'>  </span>
                                    <input type='text' class='form-control' />
                                </div>

                                <div class='form-group'>
                                    <label> Province </label>
                                    <span class='text-danger text-center error-message'>  </span>
                                    <select class='form-control'>
                                        <option value=''> Please select an option </option>
                                        <?php echo generateProvinceList();   ?>
                                    </select>
                                </div>
                            </div>

                            <!-- CONTAINER CHARITY TYPE    !-->
                            <div class='row form-charity' >
                                <h2 class='text-center'> Gift Details </h2>
                                <small class='small-caption'> Charity </small>
                                 <div class='form-group'>
                                    <label> Gift Description</label>
                                    <span class='text-danger text-center error-message'>  </span>
                                    <small class='small-caption'>e.g. $500 donation </small>
                                    <input type='text' class='form-control' />
                                </div>

                                <div class='form-group'>
                                    <label> Gift Charity Name </label>
                                    <span class='text-danger text-center error-message'>  </span>
                                    <small class='small-caption'> eg: CANADIAN BLOOD BANK </small>
                                    <input type='text' class='form-control' />
                                </div>

                                <div class='form-group'>
                                    <label> Charity organization number </label>
                                    <span class='text-danger text-center error-message'>  </span>
                                    <input type='text' class='form-control'
                                        placeholder='Employer Identifcation number' />
                                </div>

                                <div class='form-group'>
                                    <label> City / Town </label>
                                    <span class='text-danger text-center error-message'>  </span>
                                    <input type='text' class='form-control' />
                                </div>

                                <div class='form-group'>
                                    <label> Province </label>
                                    <span class='text-danger text-center error-message'>  </span>
                                    <select class='form-control'>
                                        <option value=''> Please select an option </option>
                                        <?php echo generateProvinceList();   ?>
                                    </select>
                                   
                                </div>
                            </div>
                        </div>
                        <!--  end of template section    !-->
                    </fieldset>


                    <fieldset class='step hidden'>

                        <div class='row'>
                            <h2 class='text-center'> Remainder of Estate </h2>
                            <span class='text-center text-danger'>Max share amount 100%</span>
                        </div>


                        <div class='row'>
                            <p class='text-center'> Who will inherit the remainder of your estate after any gifts and
                                debts are taken care of? </p>

                            <div id='form-remainder-container'>
                            </div>


                            <div class='form-remainder-template' hidden>
                                <div class='form-template-type mt-2'>

                                    <h2 class='text-center'> Recipient Details </h2>
                                    <small class='small-caption'> Who will inherit your "estate" </small>
                                    <small class='text-danger text-center error-message'></small>

                                    <div class='row'>
                                        <div class='col-sm iconTile'>
                                            <i class="fa fa-building icon" aria-active="true"></i>
                                            <div class='form-group mt-2' style='width: auto; margin: auto;'>
                                                <span style='font-weight: bolder;'> Business or charity </span>
                                                <input type='radio' value='business' name='form-gift-type'
                                                    class='form-check-input' />
                                            </div>
                                        </div>


                                        <div class='col-sm iconTile'>
                                            <i class="fa fa-id-card-o icon" aria-active="true"></i>
                                            <div class='form-group' style='width: auto; margin: auto;'>
                                                <span style='font-weight: bolder;'> Individual </span>
                                                <input type='radio' value='individual' name='form-gift-type'
                                                    class='form-check-input' />
                                            </div>
                                        </div>
                                    </div>
                                        <div class='form-remainder-content'></div>
                                </div>


                                <div class='form-template-individual m-2' >
                                    <div class='form-group'>
                                        <label> Full Name </label>
                                        <small class='text-danger text-center error-message'></small>
                                        <input type='text' class='form-control' />
                                    </div>

                                    <div class='form-group'>
                                        <label> City </label>
                                        <small class='text-danger text-center error-message'></small>
                                        <input type='text' class='form-control' />
                                    </div>

                                    <div class='form-group'>
                                        <label> Province </label>
                                        <small class='text-danger text-center error-message'></small>
                                        <select class='form-control'>
                                            <option value=''> Please select an option </option>
                                            <?php echo generateProvinceList();   ?>
                                        </select>
                                    </div>


                                    <div class='form-group'>
                                        <label> Share % </label>
                                        <small class='text-danger text-center error-message'></small>
                                        <input type='number' min='0' maxlength=3 max='100' class='form-control' />

                                        
                                    </div>

                                    <div class='form-group mt-3 remove-radius'
                                        style='position: relative; top: auto; border-radius: 0;'>
                                        <span class='btn btn-remove mt-4 btn-delete-gift-pannel remove-radius'>Delete
                                            this
                                            recipient
                                        </span>
                                    </div>

                                </div>


                                <div class='form-template-charity m-2'>

                                    <div class='form-group'>
                                        <label> Charity Name</label>
                                        <small class='text-danger text-center error-message'></small>
                                        <input type='text' class='form-control' />
                                    </div>

                                    <div class='form-group'>
                                        <label> Charity Number </label>
                                        <small class='text-danger text-center error-message'></small>
                                        <input type='text' class='form-control' />
                                    </div>

                                    <div class='form-group'>
                                        <label> City / Town </label>
                                        <small class='text-danger text-center error-message'></small>
                                        <input type='text' class='form-control' />
                                    </div>

                                    <div class='form-group'>
                                        <label> Province </label>
                                        <small class='text-danger text-center error-message'></small>
                                        <select class='form-control'>
                                        <small class='text-danger text-center error-message'></small>
                                            <option value=''> Please select an option </option>
                                            <?php echo generateProvinceList();   ?>
                                        </select>
                                    </div>


                                    <div class='form-group'>
                                        <label> Share % </label>
                                        <small class='text-danger text-center error-message'></small>
                                        <input type='number' min='0' maxlength='3' max='100' class='form-control' />
                                    </div>

                                    <div class='form-group mt-3 remove-radius'
                                        style='position: relative; top: auto; border-radius: 0;'>
                                        <span class='btn btn-remove mt-4 btn-delete-gift-pannel remove-radius'>Delete
                                            this
                                            recipient
                                        </span>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class='row mt-4'>
                            <div class='form-group' style='width: auto; margin: auto;'>
                                <input type='button' class='btn started bi bi-plus-circle' id='btn-add-remainder' value='Add Recipient' />
                            </div>
                        </div>
                    </fieldset>



                    <fieldset class='step hidden'>
                        <div class='row'>
                                <h1 class='text-center'> Total Failure Clause </h1>
                                    
                        </div>


                        <div class='row text-center form-distro'>
                            <p> If your beneficiary passes away before you, do you want your estate to be divided equally among your parents/siblings? </p>
                            <small class='text-danger error-message'></small>
                            <div class='form-group'>
                                <span> Yes </span>
                                <input type='radio' id='form-wipeout-distro-true' class='form-check-input' name='form-totalFailure' value='true' />
                                <span> No </span>
                                <input type='radio' id='form-wipeout-distro-false' class='form-check-input' name='form-totalFailure' value='false' />
                            </div>
                        </div>


                            <div class='row mt-4 form-wipeout' id='form-wipeout-recipient'  hidden>
                                <h3>Wipeout Beneficiary</h3>
                              
                            <div class='form-group'>
                                        <label> Full Name </label>
                                        <span class='text-danger error-message'></span>
                                        <input type='text' class='form-control' />
                                    </div>

                                    <div class='form-group'>
                                        <label> City </label>
                                        <span class='text-danger error-message'></span>
                                        <input type='text' class='form-control' />
                                    </div>

                                    <div class='form-group'>
                                        <label> Province </label>
                                        <span class='text-danger error-message'></span>
                                        <select class='form-control'>
                                            <option value=''> Please select an option </option>
                                            <?php echo generateProvinceList();   ?>
                                        </select>
                                    </div>
                            </div>

                    </fieldset>



                    <fieldset class='step hidden'>
                        <div class='row text-center'>
                            <h2> Additional Details </h2>
                            <p> Do you want to include any additional instructions? </p>
                        </div>

                        <div class='row text-center'>
                            <div class='form-group'>
                            <small class='small-caption text-danger error-message'></small>
                                <label> Yes </label>
                                <input type='radio' id='form-clause-radio-true' class='input-check-input' name='form-provisions' value='yes' />
                                <label> No </label>
                                <input type='radio' id='form-clause-radio-false' class='input-check-input' name='form-provisions' value='no' />
                            </div>
                        </div>

                            <div class='form-group text-center' id='form-clause' hidden>
                                <h4> Additional Clause </h4>
                                <small class='small-caption text-danger error-message'></small>
                                <textarea class='form-control'></textarea>
                                <small class='small-caption'>
                                e.g. I wish to forgive James Smith debt of $2,000 incurred on January 4, 2015, for the purchase of a vehicle.
                                </small>
                            </div>

                    </fieldset>


                    <fieldset class='step hidden'>
                        <div class='row text-center'>
                            <h3>Signing Details </h3>

                            <p> Where will you sign your Last Will? </p>
                        </div>
                        <div class='row text-center'>
                            <div class='form-group'>
                                <label> City </label>
                                <input type='text' class='form-control' />
                            </div>

                            <div class='form-group'>
                                <label> Province </label>
                                <select class='form-select'>
                                    <option> Please select an province </option>
                                    <?php echo generateProvinceList(); ?>
                                </select>
                            </div>

                            <div class='form-group'>
                                <input type='text' style='display: none' id='SID_TOKEN' value="<?php  echo bin2hex(random_bytes(20)) ?>" name='junit_DATA'/>
                                <input type='text' style='display: none' id='_PID_TOKEN' name='PID_TOKEN' value="<?php  echo bin2hex(random_bytes(20))?>" />
                                <input type='hidden' name='__data__' id='__DATA__' value='<?php echo random_bytes(20)?>'/>
                                
                            </div>

                            <div class='form-group mt-2'>
                                <button class='btn started' id='submit-document'> Generate My Contract </button>
                           
                            </div>
                        </div>
                    </fieldset>
                    
                    </form>

            </div>

            <div class='card-footer'>
                <div class='form-group' style='margin-left: 35%;'>
                    <button class='btn started btn-lg' style='padding-right: 5%; padding-left: 5%;'
                        id='btn-back'>Previous</button>
                    <button class='btn started btn-lg' style='padding-right: 5%; padding-left: 5%;' id='btn-next'> Next
                    </button>
                </div>
                <small style='color: slategray; font-style: italic; text-align: center'>&copy NFLD LAW
                    (freeWillLawyer)</small>


            </div>
        </div>
    </div>

</div>
</div>