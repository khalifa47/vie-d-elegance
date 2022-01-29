<?php

namespace App\Controllers\api;

use App\Controllers\BaseController;
use App\Models\APItokensModel;
use App\Models\APIusersModel;
use App\Models\OrdersModel;


use CodeIgniter\API\ResponseTrait;


class TransactionAPI extends BaseController
{
    use ResponseTrait;

    public function multiple($sort_option = 'order_id')
    {
        $apiUsers = new APIusersModel();
        $apiTokens = new APItokensModel();

        date_default_timezone_set('Africa/Nairobi');

        $authUser = $this->request->getGet('uname') && $this->request->getGet('uname') == $apiUsers->getApiUsers($this->request->getGet('uname'))['username'];

        if ($authUser) {
            $authKey = $this->request->getGet('key') && $this->request->getGet('key') == $apiUsers->getApiUsers($this->request->getGet('uname'))['key'];
            $authToken = $this->request->getGet('token') && $this->request->getGet('token') == $apiTokens->getSpecificToken($apiUsers->getApiUsers($this->request->getGet('uname'))['apiuser_id'], 3)['api_token'];
            if ($authKey && $authToken) {
                $tokenValid = $apiTokens->getSpecificToken($apiUsers->getApiUsers($this->request->getGet('uname'))['apiuser_id'], 3)['expires_on'] > date('Y-m-d H:i:s');
                if ($tokenValid) {
                    $ordersModel = new OrdersModel();

                    if ($this->request->getGet('productid')) {
                        return $this->respond($ordersModel->getMinTransactions(false, $sort_option, 'tbl_product.product_id', $_GET['productid']), 200);
                    }
                    if ($this->request->getGet('subcategory')) {
                        return $this->respond($ordersModel->getMinTransactions(false, $sort_option, 'tbl_product.subcategory_id', $_GET['subcategory']), 200);
                    }
                    if ($this->request->getGet('category')) {
                        return $this->respond($ordersModel->getMinTransactions(false, $sort_option, 'tbl_categories.category_id', $_GET['category']), 200);
                    }
                    if ($this->request->getGet('daterange')) {
                        return $this->respond($ordersModel->getMinTransactions(false, $sort_option, 'tbl_order.created_at', $_GET['daterange']), 200);
                    }

                    return $this->respond($ordersModel->getMinTransactions(false, $sort_option), 200);
                } else {
                    return $this->failUnauthorized("Expired token. Please generate a new token");
                }
            } else {
                return $this->failUnauthorized("Invalid key/token combination");
            }
        }

        return $this->failUnauthorized('Unauthorized! Please check your query arguments. Check the documentation for reference.');
    }
    public function single($oid)
    {
        $apiUsers = new APIusersModel();
        $apiTokens = new APItokensModel();

        date_default_timezone_set('Africa/Nairobi');

        $authUser = $this->request->getGet('uname') && $this->request->getGet('uname') == $apiUsers->getApiUsers($this->request->getGet('uname'))['username'];

        if ($authUser) {
            $authKey = $this->request->getGet('key') && $this->request->getGet('key') == $apiUsers->getApiUsers($this->request->getGet('uname'))['key'];
            $authToken = $this->request->getGet('token') && $this->request->getGet('token') == $apiTokens->getSpecificToken($apiUsers->getApiUsers($this->request->getGet('uname'))['apiuser_id'], 3)['api_token'];
            if ($authKey && $authToken) {
                $tokenValid = $apiTokens->getSpecificToken($apiUsers->getApiUsers($this->request->getGet('uname'))['apiuser_id'], 3)['expires_on'] > date('Y-m-d H:i:s');
                if ($tokenValid) {
                    $ordersModel = new OrdersModel();
                    return $this->respond($ordersModel->getMinTransactions($oid), 200);
                } else {
                    return $this->failUnauthorized("Expired token. Please generate a new token");
                }
            } else {
                return $this->failUnauthorized("Invalid key/token combination");
            }
        }

        return $this->failUnauthorized('Unauthorized! Please check your query arguments. Check the documentation for reference.');
    }
}
