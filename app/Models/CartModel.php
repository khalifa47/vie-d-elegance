<?php

namespace App\Models;

use CodeIgniter\Model;

class CartModel extends Model
{
    protected $table = 'tbl_cart';
    protected $allowedFields = ['user_id', 'product_id', 'quantity', 'price'];

    public function getCartAtUser($uid)
    {
        return $this->asArray()
            ->where(['category_name' => $uid])
            ->findAll();
    }
}
