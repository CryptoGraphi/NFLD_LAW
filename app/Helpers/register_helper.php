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

    public function passwordsMatch($password, $confrimPasswords) {

    }


 }

?>