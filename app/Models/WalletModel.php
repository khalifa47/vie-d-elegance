<?php

namespace App\Models;

use CodeIgniter\Model;

class WalletModel extends Model
{
    protected $table = 'tbl_wallet';
    protected $primaryKey = 'wallet_id';
    protected $allowedFields = ['customer_id', 'amount_available', 'created_at', 'updated_at', 'is_deleted'];

    public function getWallets($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        }

        return $this->asArray()
            ->where(['wallet_id' => $id])
            ->first();
    }

    public function getWalletAtUser($uid)
    {
        return $this->asArray()
            ->where(['customer_id' => $uid])
            ->first();
    }
}
