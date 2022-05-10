<?php

namespace App\Models;

use CodeIgniter\Model;

class Orders extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'orders';
	protected $primaryKey           = 'orderID';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['orderCustomerID', 'orderProductType',
	'orderProductLicence', 'orderPurchaseDate', 'orderProductKey', 'orderReceiptURL','orderRefund', 'orderPurchaseId'];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [];
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




	public function generateData($userID, $productName, $paymentType,  $paymentObject)
	{
		 return $dbData = [
			'orderCustomerID' => $userID, 
			'orderProductType' => $productName,
			'orderProductLicence' => $paymentType, 
			'orderPurchaseDate' => date('Y-m-d'), 
			'orderProductKey' => sha1(random_bytes(25)), 
			'orderReceiptURL' => $paymentObject['receipt_url'],
			'orderRefund' => false, 
			'orderPurchaseId' => $paymentObject['customer']
		];
	}
	public function addOrder($data)
	{	
		return $this->insert($data);
	}
}
