<?php


/**
 * 
 *  class: authenticationWorker
 * 
 *  
 *  purpose: to provide helper methods inorder to verify and conduct authorization 
 * 
 */



 class authenticationWorker {


    public function __construct($post_array) {

        $this->postValues = filter_var_array($post_array, FILTER_SANITIZE_STRING);
    }


    // this is to retrive our post values that we need filtered and sanitized
    public function getPostValues() {
        return $this->postValues;
    }

    public function checkRequestMethod()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            return true;
        }
        return false;
    }

    // verify the username of the user
    public function verifyUsername($username, $dbUsername) 
    {

        if ($username === $dbUsername) {
            return true;
        }
            return false;
    }

    public function verifyPassword($password, $dbHash, $salt) {
        $hashed_password = hash('whirlpool', $password.$salt);

        if ($hashed_password === $dbHash) {
            return true;
        }
            return false;
    }
    // generate a random session token
    // this is how we will be able to look up users in the database
    public function generateSessionToken()
    {
        return hash('sha256', bin2hex(random_bytes(24)));
    }

    public function generateSessionID(){
        return bin2hex(random_bytes(25));
    }

    // hash the session id this will be our token
    public function generateAuthToken($session_Id)
    {
        return hash('sha256', $session_Id);   
    }

    public function verifyTokensIssued($SESSIONTOKEN, $DBSESSIONID, $SESIONACCESSTOKEN, $DBACCESSTOKEN){

        if ($SESSIONTOKEN === $DBSESSIONID && $SESIONACCESSTOKEN === $DBACCESSTOKEN) {
            return true;
        }
            return false;
    }

 }

?>