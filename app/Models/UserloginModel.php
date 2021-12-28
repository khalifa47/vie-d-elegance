<?php

namespace App\Models;

use CodeIgniter\Model;

class UserloginModel extends Model
{
    protected $table = 'tbl_userlogins';
    protected $primaryKey = 'userlogin_id';
    protected $allowedFields = ['user_id', 'user_ip', 'login_time', 'logout_time', 'is_deleted'];

    public function getUserLogins($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        }

        return $this->asArray()
            ->where(['userlogin_id' => $id])
            ->first();
    }

    public function insertUserLogin($data)
    {
        $this->save($data);
        return $this->getInsertID();
    }
}
