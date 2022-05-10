<?php

/**
 * 
 *  class: hashing 
 * 
 *  purpose: to provide password hashing and encryption services to the database 
 * 
 * 
 *  our: defualt algorith will be 
 * 
 */



 class hash  {

    static function generateHash($string, $salt )
    {
        return hash('sha256', $string.$salt);
    }

    static function generateSalt($length = 25)
    {
        return bin2hex(random_bytes($length));
    }

    static function generateSessionID()
    {
        return bin2hex(random_bytes($length = 30));
    }

    
    static function generateKey($length, $salt, $accessToken)
    {
        return hash('sha256', $accessToken. bin2hex(random_bytes($length)).$salt);
    }
 }

?>