<div class='container'>

    <div class='row'>

        <h1 class='text-center '> Choose your document </h1>
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

    <div class='row'>

        <div class='container mt-4'>
            <div class='row'>
                <div class='col-sm'>

                    <h3 style='text-align: center; color: rgb(56, 56, 56); font-weight: 400;' class='mt-4'><i
                            class="bi bi-book" style='margin: 10px;'></i>Legal
                        Documents, Forms, and Contracts</h3>
                    <small style='font-style: italic; color: slategray;'> Please select a legal form or contrat to get
                        started</small>
                </div>

            </div>
            <div class='row'>
                <div class='col-md padd' style='margin: 10px;'>
                    <h2> <i class="fa fa-institution" style='margin: 5px;'></i> Wills & Estates </h2>
                    <hr />
                    <ul class='navbar-nav'>
                        <li class='nav-item'> <a class='nav-link' href='/dashboard/contracts/lastwill/'>Last Will and Testament </a></li>
                        <li class='nav-item'> <a class='nav-link' href='/dashboard/contracts/poa/'> Power of Attoreny</a></li>
                        <li class='nav-item'> <a class='nav-link' href='/dashboard/contracts/livingWill/'> Living Will</a> </li>
                    </ul>
                </div>
                <div class='col-md padd' style='margin: 10px;'>
                    <h2> <i class="bi bi-briefcase" style='margin: 10px;'></i>Business </h2>
                    <hr />
                    <ul class='navbar-nav'>
                        <li class='nav-item'> <a class='nav-link' href='/dashboard/contracts/partnership/'>Partnership Agreement  </a></li>
                        <li class='nav-item'> <a class='nav-link' href='/dashboard/contracts/llc/'> LLC Operating Agreement</a></li>
                        <li class='nav-item'> <a class='nav-link' href='/dashboard/contracts/confidentiality/'> Confidentiality Agreement</a> </li>
                    </ul>
                </div>
                <div class='col-md padd' style='margin: 10px;'>
                    <h2> <i class="bi bi-people-fill" style=' margin: 10px;'></i>Family </h2>
                    <hr />
                    <ul class='navbar-nav'>
                        <li class='nav-item'> <a class='nav-link' href='/dashboard/contracts/prenup/'>Prenuptial Agreement</a></li>
                        <li class='nav-item'> <a class='nav-link' href='/dashboard/contracts/seperation/'> Separation Agreement</a></li>
                        <li class='nav-item'> <a class='nav-link' href='/dashboard/contracts/cohabitation/'> Cohabitation Agreement</a> </li>
                    </ul>
                </div>

            </div>


        </div>


    </div>


    <div class='row' style='margin-top: 10%;'>
    <h1>Your current contracts </h1>
        <small style='color: slategray; font-style: italic;'> View your current legal contract and forms </small>

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
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
      <td>
          <button class='btn btn-danger bi bi-x-circle-fill'>  Delete </button>
          <button class='btn btn-warning bi bi-gear-fill'> Modify </button>
      </td>
    </tr>
  </tbody>
</table>
    </div>


    <div class='row' style='margin-top: 10%;'>
        <h1> Need other legal services? </h1>
        <small style='color: slategrey; font-style: italic;'> Need something else ?</small>
        <div class='col-sm mt-4'>
            <img src='/img/maarten-van-den-heuvel-_pc8aMbI9UQ-unsplash.jpg' class='img-fluid mt-4' />
        </div>

        <div class='mt-4'>
            <p> Need other legal services? Please contact our experienced legal team? via our request form </p>
            <button id='requestForm' class='btn started'> Contact Legal Team </button>
        </div>
    </div>



    <div class='col-lg'>

        <div class='modal'>
            <div class="modal-content">
                <div class="modal-header p-4 text-center">
                    <h4>Legal Request form  <i class='fa fa-legal'></i></h4>
                    <span class="close">&times;</span>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <h5> Please fill out request form </h5>

                            <form class='form-requestForm' method='post' action=''>
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" class="form-control" placeholder="Enter email">
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
                                    <textarea  class='form-control' placeholder='Put your message here'></textarea>
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