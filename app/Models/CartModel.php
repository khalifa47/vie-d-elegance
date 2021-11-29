<?php

namespace App\Models;

use CodeIgniter\Model;

class CartModel extends Model
{
    protected $table = 'tbl_cart';
    protected $primaryKey = 'cart_id';
    protected $allowedFields = ['user_id', 'product_id'];

    public function getCartAtUser($uid)
    {
        return $this->asArray()
            ->where(['user_id' => $uid])
            ->findAll();
    }

    public function getCartID($uid, $pid)
    {
        return $this->asArray()
            ->where(['user_id' => $uid])
            ->where(['product_id' => $pid])
            ->first();
    }
}
