<div class='container'>

    <div class='row'>

    <div class='col-md-12 mb-4 mt-4'>
        <h1> Getting Started </h1>
        <small class='small-caption'>  Getting starting started is easy </small>

        <p class='small-caption'>
        Just follow the step-by-step instructions to fill out the necessary information for your
                            forms.
        </p>

        <p style='font-weight: bold;'>&copy; NFLD LAW freewillLawyer.com</p>

</div>

  
        
    
        <div class='col-sm iconTile'>
           <img src='/img/SVG/document_choose.svg' class='img-fluid' />
            <span> Choose your document </span>
        </div>    
        
        <div class='col-sm iconTile'>
            <img src='/img/SVG/fill_form.svg' class='img-fluid' />
            <span> Answer a few simple questions</span>
        </div>
        <div class='col-sm iconTile'>
            <img src='/img/SVG/clock.svg' class='img-fluid'/>
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
                    <small style='font-style: italic; color: slategray;'> Please select a legal form or contract to get
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
<div class='coll-sm-6'>
    <img src='/img/SVG/my_documents.svg' class='img-fluid' />
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
    <tr>
      <th scope="row">1</th>
      <td>Mark</td>
      <td>Otto</td>
      <td>@mdo</td>
      <td>
          <button class='btn btn-danger bi bi-x-circle-fill'>  Delete </button>
          <button class='btn btn-warning bi bi-gear-fill'> Modify </button>
          <button class='btn btn-success'> Download </button>
      </td>
    </tr>
  </tbody>
</table>
    </div>


    <div class='row' style='margin-top: 10%;'>
        <h1> legal services? </h1>
        <small style='color: slategrey; font-style: italic;'> Didn't find out what you were looking for? Please contact our legal Team.
        <br/> About the nature of the request and we would, gladly book  you for a free consolutation.
    </small>
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

    <script>

let dialogBtn = document.getElementById('requestForm');
let container = document.getElementById('modal-request');

dialogBtn.addEventListener('click', () => {
if (container.style.display === 'none') {
    container.style.display = 'block';
} else {
    container.style.display = 'none';
}
});

</script>

</div>
</div>