<?php

namespace App\Models;

use CodeIgniter\Model;

class APItokensModel extends Model
{
    protected $table = 'tbl_apitokens';
    protected $primaryKey = 'apitoken_id';
    protected $allowedFields = ['api_userid', 'api_productid', 'api_token', 'created_at', 'expires_on', 'is_deleted'];

    public function getApiTokens($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        }

        return $this->asArray()
            ->where(['apitoken_id' => $id])
            ->first();
    }

    public function getTokensForUser($uid)
    {
        return $this->asArray()
            ->join('tbl_apiusers', 'tbl_apitokens.api_userid = tbl_apiusers.apiuser_id')
            ->join('tbl_apiproducts', 'tbl_apiproducts.apiproduct_id = tbl_apitokens.api_productid')
            ->select(['productname', 'api_token'])
            ->orderby('apitoken_id', 'DESC')
            ->distinct()
            ->where(['api_userid' => $uid])
            ->findAll();
    }

    public function getSpecificToken($uid, $pid)
    {
        return $this->asArray()
            ->orderby('apitoken_id', 'DESC')
            ->where(['api_userid' => $uid, 'api_productid' => $pid])
            ->first();
    }

    public function insertToken($data)
    {
        $this->save($data);
        return $this->getInsertID();
    }
}
