<?php

namespace App\Models;

use CodeIgniter\Model;

class Users extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'users';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['email', 'password', 'salt', 'token', 'created_at', 'updated_at', 'deleted_at'];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [
		'email' => 'required|valid_email|is_unique[users.email]',
		'password' => 'required|min_length[8]',
		'salt' => 'required'
	];
	protected $validationMessages   = [];
	protected $skipValidation       = false;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks       = true;
	protected $beforeInsert         = [];
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = [];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];



	/**
	 *   @function: exists
	 *  
	 *  @purpose: inorder to check if the user exists in the database 
	 *
	 */

	public function exists($email)
	{
		return $this->where('email', $email)->first();
	}


	/**
	 *  @function: updateToken 
	 * 
	 *  @purpose: inorder to update the token of the user in the system 
	 * 
	 */

	public function updateToken($id, $value)
	{
		// also update the updated_at field
		return $this->update($id, ['token' => $value, 'updated_at' => date('Y-m-d H:i:s')]);
	}


	/**
	 * 
	 *  @method: UpdatePassword 
	 * 
	 * 
	 *  @purpose: in order to update the password of the user in the system
	 * 
	 */

	 public function updatePassword($token, $oldPassword, $newPassword)
	 {
		$user = $this->where('token', $token)->first();
		// check  if the salt password matches on the database
		$oldPassword = hash('sha512', $oldPassword . $user['salt']);

		if ($oldPassword === $user['password']) {
			// hash the new password
			$newPassword = hash('sha512', $newPassword . $user['salt']);
			// update the password
			return $this->update($user['id'], ['password' => $newPassword, 'updated_at' => date('Y-m-d H:i:s')]);
		}
		  return false;
	 }

	/**
	 * 
	 *  @function: create 
	 * 
	 *  @purpose: in order to create a new user in the system. 
	 *  
	 */
	
	 public function create($email, $password, $salt)
	 {
		// create a new user account in the system  with the given email and password 
		return $this->save([
			'email' => $email,
			'password' => $password,
			'salt' => $salt,
			'token' => hash('sha512', $email . time() . $salt),
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
			'deleted_at' => null
		]);
	 }


	 /**
	  *   @method: getUserByToken
	  *
	  *  @purpose: in order to get the user by the token
	  */

	  public function getUserByToken($token)
	  {
		  return $this->where('token', $token)->first();
	  }

}
