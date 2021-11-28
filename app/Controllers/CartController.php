<?php

namespace App\Controllers;

use App\Models\CartModel;
use App\Models\CategoriesModel;

use App\Models\ItemsModel;
use App\Models\ImagesModel;

class CartController extends BaseController
{
    public function index()
    {
        $modelCategories = new CategoriesModel();
        $modelCart = new CartModel();
        $modelItems = new ItemsModel();
        $modelImages = new ImagesModel();

        $cartItems = array();
        $cartImages = array();

        foreach ($modelCart->getCartAtUser(session()->get('id')) as $item) {
            array_push($cartItems, $modelItems->getItems($item['product_id']));
            array_push($cartImages, $modelImages->getImages($item['product_id'])[0]);
        }

        $data = [
            'categories' => $modelCategories->getCategories(),
            'cartItems' => $cartItems,
            'cartImages' => $cartImages,
            'title' => 'My Cart'
        ];

        return view('items/cart', $data);
    }

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
