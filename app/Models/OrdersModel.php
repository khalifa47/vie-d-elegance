<?php

namespace App\Models;

use CodeIgniter\Model;

class OrdersModel extends Model
{
    protected $table = 'tbl_order';
    protected $primaryKey = 'order_id';
    protected $allowedFields = ['customer_id', 'order_amount', 'order_status', 'payment_type', 'created_at', 'updated_at', 'is_deleted'];

    public function getOrders($id = false)
    {
        if ($id === false) {
            return $this
                ->orderby('created_at', 'DESC')
                ->findAll();
        }

        return $this->asArray()
            ->where(['order_id' => $id])
            ->first();
    }
    public function getOrdersAtUser($uid)
    {
        return $this->asArray()
            ->orderby('created_at', 'DESC')
            ->where(['customer_id' => $uid])
            ->findAll();
    }

    public function insertOrder($data)
    {
        $this->save($data);
        return $this->getInsertID();
    }
}