<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemsModel extends Model
{
    protected $table = 'tbl_product';
    protected $primaryKey = 'product_id';
    protected $allowedFields = ['product_name', 'product_description', 'product_image', 'unit_price', 'available_quantity', 'subcategory_id', 'created_at', 'updated_at', 'added_by', 'is_deleted'];

    public function getItems($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        }

        return $this->asArray()
            ->where(['product_id' => $id])
            ->first();
    }

    public function insertItem($data)
    {
        $this->save($data);
        return $this->getInsertID();
    }

    public function getItemsAtCateg($categ_id)
    {
        return $this->asArray()
            ->where(['subcategory_id' => $categ_id])
            ->findAll();
    }
}
