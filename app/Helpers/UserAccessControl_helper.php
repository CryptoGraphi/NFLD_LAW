<?php



/**
 * 
 * 
 *  class: user access controller
 * 
 * 
 *  purpose: inorder to issue the sessions and token for our authentication since the authentication system has issued them
 *  
 */



 class UAC {
    public  function __construct($accessToken, $sessionID, $sessionToken)
    {
        $this->accessToken = $accessToken;
        $this->sessionID = $sessionID;
        $this->sessionToken = $sessionToken;

    }

    public function issueTokens()
    {
        
    }

    public function verifyUsername($username, $dbUsername)
    {

    }

    public function verfiyPassword($userPassword, $dbPassword, $salt)
    {

    }

    public function verifyDetails() 
    {

    }

    public function validateUACToken()
    {

    }

    private function issueUACToken()
    {

    }
 }
?>