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

    public static function login($user) {
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
    
            return [
                'status' => false,
                'message' => 'Could not validate the request'
            ];
        }

        // is the user already logged in 
        if (self::isLoggedIn()['status'] === true) {
                return [
                    'status' => true,
                    'message' => 'You are already logged in'
                ];
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
                    // update the token for the user
                    $userModel->updateToken($userModel->where('email', $email)->first()['id'], $token);
                    // set the sessions variables
                    $_SESSION['token'] = $token;
                    $_SESSION['time'] = time();

                    // unset any error messages
                    return [
                        'status' => true,
                        'message' => 'You are now logged in'
                    ];
                }
                // set the error wrong message
                return [
                    'status' => false,
                    'message' => 'Wrong password'
                ];
               
        }
        // set the wrong username message
        return [
            'status' => false,
            'message' => 'User does not exist'
        ];
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
        // delete all sessions 
        session_destroy();
        setcookie('token', '', time() - 3600);
        header('HTTP/1.0 403 Forbidden');
		header('location: /home/login');
        exit;
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
            $cookie = helper('cookie');

            // check all the flags for any errors
            // that may or may not be present

            // check if the email is already in the database..

            if (empty($email) || empty($password) || empty($confirm_password)) {
                return [
                    'status' => false,
                    'message' => 'Please fill in all the fields'
                ];
            }

            // check if the email is valid
            if ($password !== $confirm_password) {
                // set a error cookie '
       
                return [
                    'status' => false,
                    'message' => 'Passwords do not match'
                ];
            }


        
            // check to see if the password is valid 
            if (strlen($password) < 8) {
                // set a error cookie
                // only valid for 1 minute 
          
                return [
                    'status' => false,
                    'message' => 'Password must be at least 8 characters'
                ];
            }
            // check to see if the email is valid
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                // set a error cookie
             
                return [
                    'status' => false,
                    'message' => 'Email is not valid'
                ];
            }
            // check to see if the user already exists
            if ($userModel->exists($email)) {
                // set a error cookie
             
                return [
                    'status' => false,
                    'message' => 'User already exists'
                ];
            }
            // hash the password and create the user
            $password = hash('sha512', $password . $salt);
            $userModel->create($email, $password, $salt);
        

            // return true
            return [
                'status' => true,
                'message' => 'User created successfully'
            ];
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
                return [
                    'status' => false,
                    'message' => 'Token is not valid'
                ];
            }
            // validate the request is a real request or a invalid request
            $userModel = new Users();

            if ($userModel->where('token', $token)->first()) {
                // sessions should be only valid for 1 hour
                if (time() - $time > 3600) {
                    // the session is expired
                    // destroy the session
                    self::deny();
                    return [
                        'status' => false,
                        'message' => 'Session has expired'
                    ];
                }
                    return [
                        'status' => true,
                        'message' => 'User is logged in'
                    ];
            }
        }

        return [
            'status' => false,
            'message' => 'User is not logged in'
        ];
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
            $tokenMatch = $userModel->where('token', $token)->first();
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
            return true;
      }
 }

?>