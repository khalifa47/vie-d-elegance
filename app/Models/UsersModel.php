<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'tbl_users';
    protected $primaryKey = 'user_id';
    protected $allowedFields = ['first_name', 'last_name', 'email', 'password', 'gender', 'role', 'is_deleted'];

    public function getUsers($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        }

        return $this->asArray()
            ->where(['user_id' => $id])
            ->first();
    }

    public function checkEmail($email)
    {
        return $this->asArray()
            ->where(['email' => $email])
            ->first();
    }

    public function insertUser($data)
    {
        $this->save($data);
        return $this->getInsertID();
    }

    public function getTopSpendingUsers()
    {
        return $this->asArray()
            ->join('tbl_order', 'tbl_order.customer_id = tbl_users.user_id')
            ->selectSum('order_amount')
            ->select(['user_id', 'first_name', 'last_name', 'email', 'gender'])
            ->groupby('customer_id')
            ->orderby('order_amount', 'DESC')
            ->limit(5)
            ->findAll();
    }

    // api functions

    public function getMinUsers($id = false, $sort = 'user_id', $filter_option = null, $filter_value = null)
    {
        if ($id === false) {
            if ($sort == 'latest_active') {
                $sort = 'tbl_order.order_id';
            }
            if ($filter_option == 'tbl_orderdetails.created_at') {
                $filter_option = 'DATE(' . $filter_option . ')';
            }
            if ($filter_option != null && $filter_value != null) {
                return $this->asArray()
                    ->join('tbl_order', 'tbl_order.customer_id = tbl_users.user_id', 'left')
                    ->join('tbl_orderdetails', 'tbl_orderdetails.order_id = tbl_order.order_id')
                    ->join('tbl_product', 'tbl_product.product_id = tbl_orderdetails.product_id')
                    ->select(['user_id', 'first_name', 'last_name', 'email', 'gender'])
                    ->where([$filter_option => $filter_value])
                    ->distinct()
                    ->orderby($sort, 'DESC')
                    ->findAll();
            }
            return $this->asArray()
                ->join('tbl_order', 'tbl_order.customer_id = tbl_users.user_id', 'left')
                ->join('tbl_orderdetails', 'tbl_orderdetails.order_id = tbl_order.order_id', 'left')
                ->select(['user_id', 'first_name', 'last_name', 'email', 'gender'])
                ->distinct()
                ->orderby($sort, 'DESC')
                ->findAll();
        }
        return $this->asArray()
            ->select(['user_id', 'first_name', 'last_name', 'email', 'gender'])
            ->where(['user_id' => $id])
            ->first();
    }
}
