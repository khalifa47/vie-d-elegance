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
}
