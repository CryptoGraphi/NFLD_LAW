<?php 


/***
 * 
 *   @file: Auth.php
 *  
 * 
 *   @purpose: inorder  to handle the authentication of the user
 *  
 */

 namespace App\Services\Auth;
 use App\Models\Users;



 class Auth
 {
 
    /**
     *  @function: login
     * 
     *  @purpose: inorder to login the user
     * 
     */

    public static function login($user) : bool {
        // login the user.... 
        $email = $user['email'];
        $password = $user['password'];
        $honeypot = $user['honeypot'];

        // sanitize the data
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $password  =  htmlspecialchars($password);
        // check the  user credentials if they exists with in the database 
        $userModel = new Users();

        // is the honey pot filled in?
        if (empty($honeypot)) {
            // its a script making the requests and not a real user
            return false;
        }

        // is the user already logged in 
        if (self::isLoggedIn()) {
                return true;
        }
        
        // authenticate the user
        if ($userModel->exists($email)) {
            // hash the password and compare it with the one in the database
                $password = hash('sha512', $password . $userModel->exists($email)['salt']);
                // now lets check to make sure that the password is correct
                // and it matches the one in the database
                $currentUserPassword = $userModel->where('email', $email)->first()['password'];

                if ($password === $currentUserPassword) 
                {
                    // set the sessions varibles and also set the token for the user in the table
                    // generate our handshake 
                    $token = hash('sha512', $userModel->email . time() .  $userModel->salt);
                    // set the sessions variables
                    $_SESSION['token'] = $token;
                    $_SESSION['time'] = time();
                  
                    return true;
                }
        }

        return false;
    }

    /**
     * 
     *  @function: deny
     * 
     *  @purpose: inorder to deny the user access to the system
     * 
     */


    public static function deny()
    {
        // deny the user access to the system 
        return false;
    }

    /**
     * 
     *  @function: register
     * 
     * @purpose: inorder to register the user inside of the system
     * 
     */

     public static function register($user)
     {
            // validate the  user data
            $email = filter_var($user['email'], FILTER_SANITIZE_EMAIL);
            $salt = hash('sha512', random_bytes(64). time() . $email);
            $password = htmlspecialchars($user['password']);
            $confirm_password = htmlspecialchars($user['confirm_password']);
            $userModel = new Users();

            // check all the flags for any errors
            // that may or may not be present


            // error container to contain the 
            // error messages that will be displayed
            // if one of our triggers is activated. 

            $errors = [
                'invalid_password' => false,
                'invalid_email' => false,
                'email_exists' => false,
                'passwords_dont_match' => false,
                'honeypot' => false,
            ];

            
            if ($password !== $confirm_password) {
                return false;
            }
    
            // check to see if the password is valid 
            if (strlen($password) < 8) {
                return false;
            }

            // check to see if the email is valid
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                return false;
            }

            // check to see if the user already exists
            if ($userModel->exists($email)) {
                return false;
            }

            // hash the password and create the user
            $password = hash('sha512', $password . $salt);
            $userModel->create($email, $password, $salt);

            // return true
            return true;
     }


     /**
      *  @function: isLoggedIn
      *
      *  @purpose: inorder to check if the user is logged in
      */

      static function isLoggedIn() {
        // validate that the user is logged in and has a valid token
        //  check if the sessions are set
        //  token, and time
        if (isset($_SESSION['token']) && isset($_SESSION['time'])) {

            $token = empty($_SESSION['token']) ? false : $_SESSION['token'];
            $time = empty($_SESSION['time']) ? false : $_SESSION['time'];
            // check if the token is valid
            if (!$token || !$time) {
                // the token is not valid
                return false;
            }
            // validate the request is a real request or a invalid request
            $userModel = new Users();

            if ($userModel->where('token', $token)->first()) {
                // sessions should be only valid for 1 hour
                if ($time + 3600 > time()) {
                    // the token is valid
                    // destroy the sessions
                    $userID = $userModel->where('token', $token)->first()['id'];
                    session_destroy();
                    $userModel->where('token', $token)->updateToken($userID, hash('sha512', $userModel->email . time() .  $userModel->salt));
                    return false;

                }
                // the request was valid so return true to the user
                    return true;
            }
        }
        return false;
     }

     /**
      *  @function: logout
      *
      *  @purpose: inorder to logout the user
      *
      */
    
      public static function logout()
      {
          // logout the user.....
         $userModel = new Users();
         // check if the user, and tim
         if (isset($_SESSION['token']) && isset($_SESSION['time'])) {
            $token = empty($_SESSION['token']) ? false : $_SESSION['token'];
            $time = empty($_SESSION['time']) ? false : $_SESSION['time'];
            $tokenMatch = $userModel->where('token', $token)->exists();
            // was the token valid in the first place
            if ($tokenMatch) {
                // destroy the sessions and reset the token
                $userModel->where('token', $token)->updateToken($token, hash('sha512', $userModel->email . time() .  $userModel->salt));
                session_destroy();
                return true;
            }
        }
        // the user is not logged in
            session_destroy();
            return false;
      }
 }

?>