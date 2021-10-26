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
}
