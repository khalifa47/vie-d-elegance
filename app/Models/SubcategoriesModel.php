<?php

namespace App\Models;

use CodeIgniter\Model;

class SubcategoriesModel extends Model
{
    protected $table = 'tbl_subcategories';
    protected $primaryKey = 'subcategory_id';
    protected $allowedFields = ['subcategory_name', 'category', 'is_deleted'];

    public function getSubcategories($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        }

        return $this->asArray()
            ->where(['subcategory_id' => $id])
            ->first();
    }

    public function checkSubcategory($subcat, $cat)
    {
        return $this->asArray()
            ->where(['subcategory_name' => $subcat])
            ->where(['category' => $cat])
            ->first();
    }
}
