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

?>

<div class='container' style='margin-top: 10%;'> 

    <div class='row'>
        <h1 class='text-center'> <?php echo $headerTitle; ?> </h1>
        <small style='color: slategray; font-style: italic;' class='mt-4'> Please go though our interactive wizard to
            generate your <b> "Personalized" </b> legal contract </small>
    </div>

    <div class='row mt-4'>
        <div class='col-sm iconTile'>
            <i class="bi bi-tv icon"></i>
            <span> Answer a few simple questions</span>
        </div>
        <div class='col-sm iconTile'>
            <i class="bi bi-hand-index-fill icon"></i>
            <span> Choose your document </span>
        </div>
        <div class='col-sm iconTile'>
            <i class="bi bi-hourglass-split icon"></i>
            <span> It take(s) just 5 minute(s) </span>
        </div>

    </div>

    <div class='row mt-4'>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" href="#">Get Started</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Executor </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Children</a>
            </li>

            <li class='nav-item'>
                <a class='nav-link' href=''> Gifts </a>
            </li>
            <li class='nav-item'> <a class='nav-link' href=''> Remainder </a></li>
            <li class='nav-item'> <a class='nav-link'> Final Details </a></li>
            <li class='nav-item'> <a class='nav-link'> Signing </a></li>
        </ul>
    </div>


    <div class='row mt-4' style='margin: 0px; padding: 0px;'>

        <div class="card mt-4" style='padding: 0px;'>
            <div class="card-header">
                <h2 id='title_' style='text-align: center;'> Getting started </h2>
                <small> Please fill out information to generate your document </small>
            </div>
            <div class="card-body">
                <form method='post'>
                    <fieldset class='step hidden'>
                        <h3  class='text-bold text-center'> What is your marital status? </h3>
                        
                        <div class='row'>
                            <div class='col-sm iconTile'>
                                <i class="bi bi-tv icon" > </i>
                                <div class='col-sm'>
                                <input type='radio' value='single' class='form-check-input' name='form-relationshipStatus'/><span> Single </span>
                                </div>
                                </div>
                            <div class='col-sm iconTile'>
                                <i class="bi bi-hand-index-fill icon"></i>
                                <div class='col-sm'>
                                <span> Married </span>
                                <input type='radio' value='married' class='form-check-input' name='form-relationshipStatus'/>
                                </div>
                   
                            </div>
                            <div class='col-sm iconTile'>
                                <i class="bi bi-hourglass-split icon"></i>
                                <div class='col-sm'>
                                     <span> Common Law </span>
                                <input type='radio' value='commonLaw' class='form-check-input' name='form-relationshipStatus'/>
                                </div>
                               
                            </div>
                        </div>


                    </fieldset>

                    <fieldset class='step hidden'>
                        <div class='row'>
                            <h3>  Your spouse?  </h3>
                        </div>

                        <div class='row'>
                            <div class='form-group'>
                                <label for='form-spouseName'>  What is your spouses name </p>
                                <span class='text-danger error-message'> <b> Invalid </b> Please fill out form </span>
                                <input type='text' class='form-control'  placeholder='spouses name' />
                            </div>
                        </div>


                    </fieldset>


                    <fieldset class='step hidden'>
                        <div class='row'>
                            <h3 class='text-center' style='font-weight: 800;'> Your Details </h3>
                        </div>

                        <div class='row'>
                            <div class='form-group'>
                                <p class='text-bold' style='font-size: 18px'> Who is this Last Will being created for? </p>
                                
                                <label for='form-testor-fullname'> Full Name </label>
                                <span class='text-danger error-message'><b> Invalid input </b></span>
                                <input type='text' class='form-control' />
                            </div>

                            <div class='form-group'>
                                <label for='form-testor-city'> City  </label>
                                <span class='text-danger error-message'><b> Invalid input </b></span>
                                <input type='text' class='form-control' name='form-testor-city'/>
                            </div>


                            <div class='form-group'>
                                <label for='form-test-province'>
                                    <label for='form-testor-province'> Province </label>
                                    <span class='text-danger error-message'><b> Invalid input </b></span>
                                    <select class='form-select' name='testor-province'>
                                        <option selected> Please select a Province </option>
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
                                <p class='text-bold'> Executor Details  </p>
                                <div class='form-group'>
                                    <label for='form-executor-fullname'> Fullname </label>
                                    <input type='text' class='form-control' />
                                </div>

                                <div class='form-group'>
                                    <label for='form-executor-city'>City </label>
                                    <input type='text' class='form-control' />
                                </div>


                                <div class='form-group'>
                                    <label for='form-executor-province'>Province</label>
                                    <select class='form-select'>
                                        <option> Please select a province </option>
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
                                <p class='text-bold'>  Backup Executor Details  </p>
                                <div class='form-group'>
                                    <label for='form-backup-executor-fullname'> Fullname </label>
                                    <input type='text' class='form-control' />
                                </div>

                                <div class='form-group'>
                                    <label for='form-backup-executor-city'>City </label>
                                    <input type='text' class='form-control' />
                                </div>


                                <div class='form-group'>
                                    <label for='form-backup-executor-province'>Province</label>
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
                            <label for='form-children-livingChildren'  class='text-center'>Do you have any living children?</label>
                            <p class='mt-2 text-danger text-center'>  Please select an option inorder to continue  </p>
                            <div class='form-group' style='width: auto; margin: auto;'>
                                
                                <span> Yes </span>
                                <input type='radio' name='form-children-livingChildren' class='form-check-input' />
                                <span> No </span> 
                                <input type='radio' name='form-children-livingChildren' class='form-check-input' />
                            </div>
                        </div>

                        <div class='form-child-template'>
                            <ul class='list-group'>
                                <li class='list-group-item'>
                                <div class='form-group'>
                                <label for='form-child-name'>Child's Full Name</label>
                                <input type='text' class='form-control'  placeholder='eg: "Adam Smith"'/>
                            </div>

                            <div class='form-group mt-3'>
                                <label for='form-child-name'> Is this child a minor or dependent? </label> 
                                <span> Yes </span>
                                <input type='radio' name='form-child-dependent' value='yes'  class='form-check-input'/>
                                <span> No </span>
                                <input type='radio' name='form-child-dependent' value='no' class='form-check-input' />
                        </div>


                                </li>

                                <li class='list-group-item'>
                                <div class='form-group'>
                                <label for='form-child-name'>Child's Full Name</label>
                                <input type='text' class='form-control'  placeholder='eg: "Adam Smith"'/>
                            </div>

                            <div class='form-group mt-3'>
                                <label for='form-child-name'> Is this child a minor or dependent? </label> 
                                <span> Yes </span>
                                <input type='radio' name='form-child-dependent' value='yes'  class='form-check-input'/>
                                <span> No </span>
                                <input type='radio' name='form-child-dependent' value='no' class='form-check-input' />

                                <ul class='list-group' id='form-child-container'>
                                
                                </ul>
                        </div>

                                </li>
                            </ul>
                        </div>

                        <div class='row'>
                           
                    </fieldset>

                    <fieldset class='step hidden'>
                        <div class='row'>
                                <h2 class='text-center'> Appoint a Guardian </h2>
                        </div>

                        <div class='row'>
                            <p style='font-size: 18px' class='text-center'>Do you want to appoint a guardian for your minor or dependent child if your spouse does not survive you? </p>

                            <span class='text-center text-danger'> Please select an option inorder to continue </span>
                            <div class='form-group' style='width: auto; margin: auto;'>
                                <span> Yes </span>
                                <input type='radio' class='form-check-input' value='yes' />
                                <span> No </span>
                                <input type='radio' class='form-check-input' value='no' />
                            </div>


                            <div class='row mt-4'>
                                <h2 class='text-center'>Guardian Details</h2>
                                <span class='text-center text-danger'> Please complete form inorder to continue </span>
                                <div class='form-group'>
                                    <label for='form-backup-guardian-fullname'> Fullname </label>
                                    <input type='text' class='form-control' />
                                </div>

                                <div class='form-group'>
                                    <label for='form-backup-guardian-city'>City </label>
                                    <input type='text' class='form-control' />
                                </div>


                                <div class='form-group'>
                                    <label for='form-backup-guardian-province'>Province</label>
                                    <select class='form-select'>
                                        <option> Please select a province </option>
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
                        <p class='text-center'> Do you want your minor beneficiaries to wait until a certain age before they receive their inheritance? </p>
                        <div class='form-group' style='width: auto; margin: auto;'>
                            <span> Yes </span>
                            <input type='radio' class='form-check-input' />
                            <span> No </span>
                            <input type='radio' class='form-check-input' />
                        </div>
                    </div>

                    <div class='row mt-3'>

                    <label for='form-inheritanceAge'>
                    Receive inheritance at age: 
                    </label>

                    <select class='form-select mt-2'>
                        <?php 
                            for ($i = 18; $i <= 65; $i++) {
                                echo "<option value='". $i . "'>". $i ." </option>";
                            }
                        ?>
                    </select>


                    </div>

                    </fieldset>

                    <fieldset class='step active'>
                            <div class='row'>
                                <h2 class='text-center'>Gifts</h2>
                            </div>

                            <div class='row'>
                                <h4 class='text-center'>
                                Do you want to leave any specific gifts in your will?
                                </h4>
                                <span class='text-danger text-center'> Please select an option inorder to continue </span>
                                <div class='form-group' style='width: auto; margin: auto;'>
                                    <span> Yes </span>
                                    <input type='radio' class='form-input-check'  value='true' />
                                    <span> No </span>
                                    <input type='radio' class='form-input-check' value='false' />
                                </div>
                            </div>


                            <div class='row'>
                                <h4> Amount of gifts? </h4>
                                <select class='form-select'>
                                    <option> Please select an option </option>
                                    <?php
                                    
                                        for ($i = 1; $i < 10; $i++) {
                                            echo "<option value='".$i."'>".$i ." </option>";
                                        }
                                    ?>
                                </select>
                            </div>


                            <div class='row'>
                                
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