<div class='container'>

    <div class='row'>
        
        <div class='col-md-12 mb-4 mt-4'>
            <h1> Getting Started </h1>
            <p class='mt-2'>Just follow the step-by-step instructions to fill out the necessary information for your forms.</p>
        </div>

        <div class='col-sm'>
           <img src='/img/SVG/lawyer.svg' class='img-fluid' />
            <p class='text-bold'> Choose your document </p>
        </div>    
        
        <div class='col-sm '>
            <img src='/img/SVG/question.svg' class='img-fluid' />
            <p class='text-bold'> Answer a few simple questions</p>
        </div>
        <div class='col-sm '>
            <img src='/img/SVG/time.svg' class='img-fluid'/>
            <p class='text-bold'> It take(s) just 5 minute(s) </p>
        </div>

    </div>

    <div class='row'>

        <div class='container mt-4'>
            <div class='row'>
                
                <div class='col-sm text-center'>
                    <h3 class='mt-4'>
                        <i class="bi bi-book" style='margin: 10px;'></i>
                        <span> Legal Documents, Forms, and Contracts</span>
                    </h3>
                    <small style='font-size: 18px;'> Please select a legal form or contract to get started</small>
                </div>
            </div>

            <div class='row'>
                <div class='col-md padd' style='margin: 10px;'>
                    <h2> <i class="fa fa-institution" style='margin: 5px;'></i> Wills & Estates </h2>
                    <hr />
                    <ul class='navbar-nav'>
                        <li class='nav-item'> <a class='nav-link' href='/dashboard/contracts/lastwill/'>Last Will and Testament </a></li>
                        <li class='nav-item'> <a class='nav-link' href='/dashboard/contracts/poa/'> Power of Attorney</a></li>
                    </ul>
                </div>
            </div>
        </div>


    </div>


    <div class='row mt-4 text-center'>
            <h1>Your current contracts </h1>     
            <p style='color: slategray; font-style: italic;'> View your current legal contract and forms </p>
            <div class='col-sm-6 mx-auto'>
                <img src='/img/SVG/documents.svg' height='300px' width="auto" class='mx-auto' />
            </div>
        
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">Document Type</th>
                <th scope="col">Date created</th>
                <th scope='col'> Date last Modified </th>
                <th scope='col'> Action </th>

                </tr>
            </thead>
            <tbody>
            <?php

                if (!empty($userDocuments))
                {

                    foreach($userDocuments as $nodes)
                    {
                        // generate the table 
                        // we need to display to user and also to get the key link inorder to modify / delete the documents 
                        // from database if needed
            
                        echo "<tr>";
                        echo "<th scope='row'>". $nodes['documentID'] . "</th>";
                        echo "<td>" . $nodes['documentType'] . "</td>";
                        echo "<td>" . $nodes['documentCreatedAt'] . "</td>";
                        echo "<td>" . $nodes['documentLastModified'] . "</td>";
                        echo "<td>
                        <a class='btn btn-primary' href='/render/fetchContract/". $nodes['documentProductKey'] ."'> download  </a>
                        <a class='btn btn-danger' href='/render/deleteContract/". $nodes['documentProductKey'] ."'> Delete </a></td>";
            
                        echo "<tr/>";
                    }


                }  else {

                    // display empty message to the user 

                    echo "<tr>";
                    echo "<td></td>";
                    echo "<td></td>";
                    echo "<td><b>No Documents Found.</b></td>";
                    echo "<td> </td>";
                    echo "<td></td>";
                    echo "<tr/>";

                }

            ?>
        

        </tbody>
        </table>
    </div>


    <div class='row' style='margin-top: 10%;'>
        <h1> Legal Services? </h1>
        <p style='color: slategrey; font-style: italic;'> Didn't find out what you were looking for? 
        Please contact our legal Team.
        About the nature of the request and we would, gladly book  you for a free consolutation.
        </p>
        <div class='col-sm-4 mt-4'>
            <img src='/img/SVG/services.svg' class='img-fluid mt-4' />
        </div>

        <div class='mt-4'>
            <button id='requestForm' class='btn started'> Contact Legal Team </button>
        </div>
    </div>
   
    

    <div class='col-lg'>

        <div class='modal' id='modal-request'>
            <div class="modal-content">
                <div class="modal-header p-4 text-center">
                    <h4>Legal Request form  <i class='fa fa-legal'></i></h4>
                    <span class="close">&times;</span>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <h5> Please fill out request form </h5>

                            <form class='form-requestForm' method='post' action='/dashboard/request/'>
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" name='email' class="form-control" placeholder="Enter email">
                                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with
                                        anyone else.</small>
                                </div>

                                <div class='form-group'>
                                    <label for='firstname'> first Name</label>
                                    <input type='text' name='firstname' class='form-control'  required/>
                                </div>

                                <div class='form-group'>
                                    <label for='lastname'> Last Name</label>
                                    <input type='text' name='lastname' class='form-control' required/>
                                </div>
                               
                                <div class='form-group'>
                                    <label for='phoneNumber'> Phone Number</label>
                                    <input type='phone' name='phoneNumber' class='form-control' placeholder='000-000-000' required/>
                                </div>


                                <div class='form-group'>
                                    <label for='breifDescription'> Brief Description</label>
                                    <textarea  class='form-control' name='message' placeholder='Put your message here'></textarea>
                                </div>
                                
                                <button type="submit" class="btn started" style='margin: 1% 40%;'>Submit</button>
                            </form>
                        </li>
                    </ul>



                </div>
                <div class="modal-footer">
                    <small>
                        <div class='copy'>&copy NFLD LAW (freeWillLawyer)
                    </small>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal content -->


</div>
</div>