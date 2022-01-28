<?php

namespace App\Models;

use CodeIgniter\Model;

class APIusersModel extends Model
{
    protected $table = 'tbl_apiusers';
    protected $primaryKey = 'apiuser_id';
    protected $allowedFields = ['username', 'key', 'added_by', 'created_at', 'updated_at', 'is_deleted'];

    public function getApiUsers($uname = false)
    {
        if ($uname === false) {
            return $this->findAll();
        }

        return $this->asArray()
            ->where(['username' => $uname])
            ->first();
    }

    public function getApiUserById($id)
    {
        return $this->asArray()
            ->where(['apiuser_id' => $id])
            ->first();
    }
}
