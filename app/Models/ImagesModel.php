<?php

namespace App\Models;

use CodeIgniter\Model;

class ImagesModel extends Model
{
    protected $table = 'tbl_productimages';
    protected $primaryKey = 'productimages_id';
    protected $allowedFields = ['product_image', 'product_id', 'created_at', 'updated_at', 'added_by', 'is_deleted'];

    public function getImage($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        }

        return $this->asArray()
            ->where(['productimages_id' => $id])
            ->first();
    }
}
