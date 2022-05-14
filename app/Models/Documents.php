<?php

namespace App\Models;

use CodeIgniter\Model;

class Documents extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'documents';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['path', 'created_at', 'updated_at'];

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
     *  @purpose: to add a new document to the storage
     */

     public function add($filePath)
     {
        $data = [
            'path' => $filePath,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        // add the document to the database
        $this->insert($data);
        // return the id of the document
        return $this->insertID;
     }


     /**
      *  @method: getDocByID
      *
      *  @purpose: to get a document by its ID
      */

      public function getDocByID($id)
      {
          return $this->where('id', $id)->first();
      }
}
