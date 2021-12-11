<?php

namespace App\Models;

use CodeIgniter\Model;

class AddressModel extends Model
{
    protected $table = 'tbl_addresses';
    protected $primaryKey = 'address_id';
    protected $allowedFields = ['user_id', 'address-line-1', 'address-line-2', 'additional-info'];

    public function getAddressAtUser($uid)
    {
        return $this->asArray()
            ->where(['user_id' => $uid])
            ->first();
    }
}
