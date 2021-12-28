<?php

namespace App\Models;

use CodeIgniter\Model;

class OrdersModel extends Model
{
    protected $table = 'tbl_order';
    protected $primaryKey = 'order_id';
    protected $allowedFields = ['customer_id', 'order_amount', 'order_status', 'payment_type', 'created_at', 'updated_at', 'is_deleted'];

    public function getOrders($id = false, $limit5 = false)
    {
        if ($id === false && $limit5 === false) {
            return $this
                ->orderby('created_at', 'DESC')
                ->findAll();
        } else if ($id === false && $limit5 !== false) {
            return $this
                ->orderby('created_at', 'DESC')
                ->limit(5)
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

    public function getSalesTotal()
    {
        return $this->asArray()
            ->selectSum('order_amount')
            ->findAll();
    }
}
