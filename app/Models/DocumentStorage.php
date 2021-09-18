<?php

namespace App\Models;

use CodeIgniter\Model;

class DocumentStorage extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'documentstorage';
	protected $primaryKey           = 'documentID';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = [
		'documentCustomerID',
		'documentProductKey', 'documentType', 'documentData', 'documentLastModified',
		'documentCreatedAt', 'orderPurchaseID'
	];

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



	public function generateDocumentData($customerID, $productKey, $documentType, $documentData, $orderID)
	{
		return $data = [
			'documentCustomerID' => $customerID,
			'documentProductKey' => $productKey,
			'documentType' => $documentType,
			'documentData' => $documentData,
			'documentLastModified' => date('Y-m-d'),
			'documentCreatedAt' => date('Y-m-d'), 
			'orderPurchaseID' => $orderID];
	}

	// this value will not set unless the key is equal to a long text ie default json object
	public function modifyDocument($productKey, $data)
	{
		$document = $this->where(['documentProductKey' => $productKey])->first();

		$dataObject = [
			'documentLastModified' => date('Y-m-d'),
			'documentData' => $data
		];

		return $this->update($document['documentID'], $dataObject);
	}

	public function addDocument($data)
	{
		return $this->insert($data);
	}
}
