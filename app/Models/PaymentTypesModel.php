<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentTypesModel extends Model
{
    protected $table = 'tbl_paymenttypes';
    protected $primaryKey = 'paymenttype_id';
    protected $allowedFields = ['paymenttype_name', 'description', 'is_deleted'];

    public function getPaymentTypes($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        }

        return $this->asArray()
            ->where(['paymenttype_id' => $id])
            ->first();
    }
}
