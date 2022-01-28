<?php

namespace App\Models;

use CodeIgniter\Model;

class APIproductsModel extends Model
{
    protected $table = 'tbl_apiproducts';
    protected $primaryKey = 'apiproduct_id';
    protected $allowedFields = ['productname', 'added_by', 'created_at', 'updated_at', 'is_deleted'];

    public function getApiProducts($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        }

        return $this->asArray()
            ->where(['apiproduct_id' => $id])
            ->first();
    }
}
