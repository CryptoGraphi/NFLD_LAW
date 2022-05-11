<?php

/**
 * 
 *  class: account Modification
 * 
 * 
 */



 class accounts extends hash {



    public function verifyEmail($email, $newEmail) {

        $oldEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
        $confirmEmail = filter_var($newEmail, FILTER_VALIDATE_EMAIL);

            if ($oldEmail !==  $confirmEmail) {
                return $confirmEmail;
            } 
        return false;
    }

    public function verifyPasswords($oldPassword, $currentPasswordHash, $newPassword, $salt)
    {
        if (hash::generateHash($oldPassword, $salt) === $currentPasswordHash ) {
            if (hash::generateHash($newPassword, $salt) !== $currentPasswordHash) {
                return hash::generateHash($newPassword, $salt);
            }
        }
        return false;
    }


    // generate array query 
    public function generatePasswordQuery($result) {

        if (empty($result) || $result === null) {
            return false;
        }

        $DATA = [
            'userPassword' => $result
        ];
        return $DATA;
    }

    /// generate email query
    public function generateEmailQuery($result) {

        if (empty($result) || $result === null ) {
            return false;
        }
        $data = [
            'userEmail' => $result
        ];

        return $data;
    }

 }


?>