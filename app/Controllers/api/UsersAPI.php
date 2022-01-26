<?php

namespace App\Controllers\api;

use App\Controllers\BaseController;
use App\Models\UsersModel;

use CodeIgniter\API\ResponseTrait;


class UsersAPI extends BaseController
{
    use ResponseTrait;

    public function multiple($sort_option = 'user_id')
    {
        $usersModel = new UsersModel();

        if ($this->request->getGet('productid')) {
            return $this->respond($usersModel->getMinUsers(false, $sort_option, 'tbl_product.product_id', $_GET['productid']), 200);
        }
        if ($this->request->getGet('subcategory')) {
            return $this->respond($usersModel->getMinUsers(false, $sort_option, 'tbl_product.subcategory_id', $_GET['subcategory']), 200);
        }
        if ($this->request->getGet('datepurchased')) {
            return $this->respond($usersModel->getMinUsers(false, $sort_option, 'tbl_orderdetails.created_at', $_GET['datepurchased']), 200);
        }

        return $this->respond($usersModel->getMinUsers(false, $sort_option), 200);

        // echo $option;
        // echo $_GET['uname'];
        // echo $_GET['key'];
        // echo $_GET['token'];
    }
    public function single($uid)
    {
        $usersModel = new UsersModel();

        return $this->respond($usersModel->getMinUsers($uid), 200);

        // echo $uid;
        // echo $_GET['uname'];
        // echo $_GET['key'];
        // echo $_GET['token'];
    }
}
