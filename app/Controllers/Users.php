<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Services\Auth\Auth;
use App\Models\Users as UsersModel;

/**  
 * 
 *  @class: Users 
 *  
 *   
 *  @purpose: to manage users and their accounts
 * 
 */

class Users extends BaseController
{

    public function __construct()
    {
        // check if the sessions are set.
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // protect the controller from unauthorized access.
        if (!Auth::isLoggedIn()['status']) {
            die(Auth::deny());
        }
    }

    /**
     * 
     *  @method: changePassword 
     * 
     *  @purpose: inorder to change the username and password of the user inside of the system 
     * 
     */

    public function changePassword()
    {
        // preform the change password action.
        // on the account that is logged in. 
        // and return success or failure.
        
        $user = new UsersModel();
        $accessToken = $_SESSION['token'];

        $currentPassword = $_POST['currentPassword'];
        $newPassword = $_POST['newPassword'];
        $confirmPassword = $_POST['newPasswordConfirm'];

        // check to make sure both of the passwords are equal 
        if ($newPassword === $confirmPassword)
        {
            // next that lets make sure that password match that 
            // of the one in the db
            $passwordChangeStatus = $user->updatePassword($accessToken, $currentPassword, $confirmPassword);
            // now lets check the result of our value to detrime if the password was changed
            if ($passwordChangeStatus === true) {
                // password was changes successfully
                $data =  [
                    'status' => true,
                    'message' => 'Password changed successfully'
                ];
                return  view('dashboard/template/header') . view('dashboard/accounts/success', $data) . view('dashboard/template/footer');
            }
            // throw an error to user tell them to check their input 
            $data =   [
                'status' => false,
                'message' => 'Current password is incorrect'
            ];
            return  view('dashboard/template/header') . view('dashboard/accounts/failed',  $data) . view('dashboard/template/footer');

        }

        // passwords don't match so throw an error to the user....
        $data = [
            'status' => false,
            'message' => 'New password and confirm password do not match'
        ];
        return  view('dashboard/template/header') . view('dashboard/accounts/failed', $data) . view('dashboard/template/footer');      
       // $updatePasswordStatus = $user->updatePassword($accessToken);
    }
}