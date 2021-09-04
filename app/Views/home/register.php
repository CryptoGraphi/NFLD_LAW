<div class='container'>
    <div class='row  loginPannel p-4'>
            <h2 class='text-center'> Register </h2>
            <h4 class='text-danger'> <?php  echo $_SESSION['REGISTRATION_ERROR_MESSAGE']; ?> </h4>
        <form method='post' action='/Authentication/register/'>


            <span class='text-danger error-message'>    </span>
            <div class="form-group m-2">
                <label for="email">Email address</label>
                <span class='error-message text-danger'></span>
                <input type="email"  name='email' class="form-control" id="email" placeholder="Enter email"/ >
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                    else.</small>
            </div>
            <div class="form-group m-2">
                <label for="password">Password</label>
                <span class='error-message text-danger'></span>
                <input type="password" name='password' class="form-control" id="password" placeholder="Password">
            </div>

            <div class="form-group m-2">
                <label for="password"> Confirm Password</label>
                <span class='error-message text-danger'></span>
                <input type="password" name='passwordConfirm'class="form-control" id="password" placeholder="Password">
            </div>

            <div class="form-check m-2">
                <input type="checkbox" name='tos' class="form-check-input" id="check">
                <span class='error-message text-danger'></span>
                <label class="form-check-label" for="check">Check me out</label>
            </div>
            <button type="submit" class="btn started m-2">Submit</button>
        </form>
    </div>
</div>