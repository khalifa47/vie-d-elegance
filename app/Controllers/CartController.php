<?php

namespace App\Controllers;

use App\Models\CartModel;

class CartController extends BaseController
{
    public function addToCart()
    {
        $model = new CartModel();

        $response = array(
            'status' => 0,
            'message' => ''
        );

        if (session()->get('isLogged')) {
            $model->save([
                'user_id' => session()->get('id'),
                'product_id' => $_POST['productID']
            ]);
            $response['status'] = 1;
            $response['message'] = "Added to cart!";
        } else {
            $response['status'] = 0;
            $response['message'] = "You must be logged in first!";
        }

        echo json_encode($response);
    }
}
