<?php 

/**
 * 
 *  class: registration
 * 
 *  purpose; inorder to register web users validate input
 * 

 */



 class registration {

    public function __construct($inputArray) {
        $this->inputArray = filter_var_array($inputArray, FILTER_SANITIZE_STRING);
    }


    public function checkRequestMethod()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            return true;
        }
        return false;
    }
    public function getPostValues() {
        return $this->inputArray;
    }

    public function passwordsMatch($password, $confrimPassword) {
            if ($password === $confrimPassword) {
                return true;
            }
                return false;
    }

    public function verifyPasswordLength($password, $passwordConfrim) {
        if (strlen($password) > 6 && strlen($passwordConfrim) > 6) {
            return true;
        }
            return false;
    }

    // helper function inorder to return our database object that we will create users with
    public function generateDBInsertQuery($email, $password, $salt)
    {
        $data = [
        'userEmail' => $email,
        'userPassword' => $password ,
        'userSalt'  => $salt
        ];
        
        return $data;

    }


 }

?>