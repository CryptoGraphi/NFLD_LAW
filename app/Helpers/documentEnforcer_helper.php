<?php


/**
 * 
 * 
 *  file: document Authenticator 
 * 
 * 
 *  purpose: inorder to provide document verification and validation 
 *                    
 * 
 */




 class documentEnforcer {

    public function __construct($dataObject) {
        
        // hold this to hold our sql query
            $this->data = $dataObject;
    
    }

    // verify the object data of our object 
    public function verifyObjectData($results) {
        if (empty($results) || $results === NULL || $results === false) {
            return false;
        }

        return true;
    }

    // fetch the document that we will need for our object 
    // FIND A MATCH IN OUR ARRAY TO GET OUR DOCUMENT DATA 
    public function verifyDocumentKey($key, $PRODUCT_KEY) {
        if (empty($key) || empty($PRODUCT_KEY)) {
            return false;
        }
        // for a match and find our key document
        foreach($key as $node) {
            if ($node['documentProductKey'] === $PRODUCT_KEY) {
                return $node;
            }
        }
        return false;
    }   

   
 
 }

?>