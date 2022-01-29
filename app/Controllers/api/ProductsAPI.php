<?php

namespace App\Controllers\api;

use App\Controllers\BaseController;
use App\Models\APItokensModel;
use App\Models\APIusersModel;
use App\Models\ItemsModel;
use App\Models\UsersModel;


use CodeIgniter\API\ResponseTrait;


class ProductsAPI extends BaseController
{
    use ResponseTrait;

    public function multiple($sort_option = 'product_id')
    {
        $apiUsers = new APIusersModel();
        $apiTokens = new APItokensModel();

        $authUser = $this->request->getGet('uname') && $this->request->getGet('uname') == $apiUsers->getApiUsers($this->request->getGet('uname'))['username'];

        if ($authUser) {
            $itemsModel = new ItemsModel();
            if ($this->request->getGet('namesearch')) {
                return $this->respond($itemsModel->searchProduct($_GET['namesearch']), 200);
            }

            $authKey = $this->request->getGet('key') && $this->request->getGet('key') == $apiUsers->getApiUsers($this->request->getGet('uname'))['key'];
            $authToken = $this->request->getGet('token') && $this->request->getGet('token') == $apiTokens->getSpecificToken($apiUsers->getApiUsers($this->request->getGet('uname'))['apiuser_id'], 2)['api_token'];
            if ($authKey && $authToken) {
                $tokenValid = $apiTokens->getSpecificToken($apiUsers->getApiUsers($this->request->getGet('uname'))['apiuser_id'], 2)['expires_on'] > date('Y-m-d H:i:s');
                if ($tokenValid) {
                    if ($this->request->getGet('userid')) {
                        return $this->respond($itemsModel->getMinProducts(false, $sort_option, 'user_id', $_GET['userid']), 200);
                    }
                    if ($sort_option == 'sales') {
                        return $this->respond($itemsModel->getMinProducts(false, $sort_option), 200);
                    }
                } else {
                    return $this->failUnauthorized("Expired token. Please generate a new token");
                }
            } else {
                if ($sort_option != 'sales') {
                    return $this->respond($itemsModel->getMinProducts(false, $sort_option), 200);
                }
                return $this->failUnauthorized("Invalid key/token combination");
            }
        }

        return $this->failUnauthorized('Unauthorized! Please check your query arguments. Also, ensure you enter your username. Check the documentation for reference.');
    }
    public function single($pid)
    {
        $apiUsers = new APIusersModel();

        $authUser = $this->request->getGet('uname') && $this->request->getGet('uname') == $apiUsers->getApiUsers($this->request->getGet('uname'))['username'];

        if ($authUser) {
            $itemsModel = new ItemsModel();
            return $this->respond($itemsModel->getMinProducts($pid), 200);
        }

        return $this->failUnauthorized('Unauthorized! You are not a registered API user. Please contact the admin.');
    }
}
