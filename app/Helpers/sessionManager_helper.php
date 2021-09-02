<?php


/**
 * 
 *  class: sessionManagerHelper
 *
 * 
 * 
 *  purpose:    inorder to validate authenticated users and de-validate unauthenticated users
 *              and control any handshake session that may be in control of 
 * 
 */


 class sessionManager {


    public function __construct($accessToken, $sessionID)
    {
        $this->SessionID = $sessionID;
        $this->AccessToken = $accessToken;  
    }
    
    // check the sessions state 
    public function checkAuthenticationSession($DBSESSION, $DBACCESSTOKEN)
    {
        if ($DBSESSION === $this->SessionID && $DBACCESSTOKEN === $this->AccessToken) {
            return true;
        }
            return false;
    }
    // value for our token issue by the session manager 
    public function sessionManagerToken()
    {
        return random_bytes(25);
    }
    // this will set the time that our session will expire 
    // defualt session time is 1 hour
    public function getSessionExpiry()
    {
        $expiryTime = time() + 60*60;
        return $expiryTime;
    }
    // check if the token still should be valid if the tokens arent valid anymore then we will destroy the expired
    // session and force the user to re input their information 
    public function verifySessionActive($time )
    {
        if (time() > $time) {
            return $this->destorySession();
        }
            return true;
    }
    // destory all the sessions have occurred and redirect the user to the home page
    public function destorySession()
    {
        session_destroy();
        http_response_code(401);
        header('refresh: 0; /');
    }

 }

?>