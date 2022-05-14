<?php

namespace App\Models;

use CodeIgniter\Model;

class Orders extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'orders';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id',  'price', 'order_date', 'document_id'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


    /**
     * 
     *  @method: add
     * 
     *  
     *   @purpose: to add a new document to the storage
     */

    public function add($userID, $price, $order_date, $documentID)
    {
        $data = [
            'user_id' => $userID,
            'price' => $price,
            'order_date' => $order_date,
            'document_id' => $documentID
        ];

        $this->insert($data);
        return $this->insertID;
    }



    /**
     * 
     *  @delete: delete
     * 
     *  @purpose: inorder to delete an existing document from the storage
     */

    public function remove($documentID, $userID)
    {
        return $this->where('document_id', $documentID)
                    ->where('user_id', $userID)
                    ->delete();
    }

    
}
