<?php

namespace App\Controllers\api;

use App\Controllers\BaseController;
use App\Models\APItokensModel;
use App\Models\APIusersModel;
use App\Models\UsersModel;


use CodeIgniter\API\ResponseTrait;


class UsersAPI extends BaseController
{
    use ResponseTrait;

    public function portal($uname)
    {
        if ($this->request->getGet('key')) {
            $apiUsers = new APIusersModel();
            $apiTokens = new APItokensModel();

            if ($_GET['key'] == $apiUsers->getApiUsers($uname)['key']) {
                // $apiproductstokens = $apiTokens->getTokensForUser($apiUsers->getApiUsers($uname)['apiuser_id']);

                $data = [
                    'key' => $_GET['key'],
                    'products' => $apiTokens->getTokensForUser($apiUsers->getApiUsers($uname)['apiuser_id'])
                ];
                // foreach ($apiproductstokens as $prod) {
                //     foreach ($data['products'] as $newprod) {
                //         if ($prod['productname'] != $newprod['productname']) {
                //             array_push($data['products'], $prod);
                //         }
                //     }
                // }
                return view('api/api-user', $data);
            }
        }

        return view('errors/html/unauthorized');
    }

    public function multiple($sort_option = 'user_id')
    {
        $apiUsers = new APIusersModel();
        $apiTokens = new APItokensModel();

        date_default_timezone_set('Africa/Nairobi');

        $authUser = $this->request->getGet('uname') && $this->request->getGet('uname') == $apiUsers->getApiUsers($this->request->getGet('uname'))['username'];

        if ($authUser) {
            $authKey = $this->request->getGet('key') && $this->request->getGet('key') == $apiUsers->getApiUsers($this->request->getGet('uname'))['key'];
            $authToken = $this->request->getGet('token') && $this->request->getGet('token') == $apiTokens->getSpecificToken($apiUsers->getApiUsers($this->request->getGet('uname'))['apiuser_id'], 1)['api_token'];
            if ($authKey && $authToken) {
                $tokenValid = $apiTokens->getSpecificToken($apiUsers->getApiUsers($this->request->getGet('uname'))['apiuser_id'], 1)['expires_on'] > date('Y-m-d H:i:s');
                if ($tokenValid) {
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
                } else {
                    return $this->failUnauthorized("Expired token. Please generate a new token");
                }
            } else {
                return $this->failUnauthorized("Invalid key/token combination");
            }
        }

        return $this->failUnauthorized('Unauthorized! Please check your query arguments. Check the documentation for reference.');
    }
    public function single($uid)
    {
        $apiUsers = new APIusersModel();
        $apiTokens = new APItokensModel();

        date_default_timezone_set('Africa/Nairobi');

        $authUser = $this->request->getGet('uname') && $this->request->getGet('uname') == $apiUsers->getApiUsers($this->request->getGet('uname'))['username'];

        if ($authUser) {
            $authKey = $this->request->getGet('key') && $this->request->getGet('key') == $apiUsers->getApiUsers($this->request->getGet('uname'))['key'];
            $authToken = $this->request->getGet('token') && $this->request->getGet('token') == $apiTokens->getSpecificToken($apiUsers->getApiUsers($this->request->getGet('uname'))['apiuser_id'], 1)['api_token'];
            if ($authKey && $authToken) {
                $tokenValid = $apiTokens->getSpecificToken($apiUsers->getApiUsers($this->request->getGet('uname'))['apiuser_id'], 1)['expires_on'] > date('Y-m-d H:i:s');
                if ($tokenValid) {
                    $usersModel = new UsersModel();
                    return $this->respond($usersModel->getMinUsers($uid), 200);
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
