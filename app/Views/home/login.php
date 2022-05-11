<div class='container'>
    <div class='row loginPannel p-4'>
            <h4 class='text-danger'> <?php  ?>  </h4> 
     
        <div class='col-md-6'>
                    <img class='img-fluid' src='/img/SVG/Website Login.svg' />
        </div>
        <div class='col-md-6 <?php  ?>'>            
        <form method='post' action='/Authentication/login/'>
        <h2 class='text-center'>  Please Login <i class='fas fa-user-shield	'></i></h2>
            <div class="form-group m-2">
                <label for="email">Email address</label>
                <span class='error-message text-danger'></span>
                <input type="email" name='email' class="form-control" id="email" placeholder="Enter email"/ >
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                    else.</small>
            </div>
            <div class="form-group m-2">
                <label for="password">Password</label>
                <span class='error-message text-danger'></span>
                <input type="password" name='password' class="form-control" id="password" placeholder="Password">
            </div>
            <div class="form-check m-2">
                <input type="checkbox"  name='check' class="form-check-input" id="check">
                <span class='error-message text-danger'></span>
                <label class="form-check-label" for="check">Please remember me</label>
                <input type='text' class='form-control' name='SID_TRACKER' value="<?php  echo hash('sha256', bin2hex(random_bytes(20))); ?>"  style='display: none;' />
            </div>
            <button type="submit" class="btn started m-2">Submit</button>
        </form>
        </div>
        
</div>
</div>