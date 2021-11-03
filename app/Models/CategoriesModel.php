<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoriesModel extends Model
{
    protected $table = 'tbl_categories';
    protected $primaryKey = 'category_id';
    protected $allowedFields = ['category_name', 'is_deleted'];

    public function getCategories($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        }

        return $this->asArray()
            ->where(['category_id' => $id])
            ->first();
    }

    public function checkCategory($cat)
    {
        return $this->asArray()
            ->where(['category_name' => $cat])
            ->first();
    }
}
