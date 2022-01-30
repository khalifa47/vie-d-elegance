<?php

namespace App\Controllers;

use App\Models\CartModel;
use App\Models\CategoriesModel;

use App\Models\ItemsModel;
use App\Models\ImagesModel;

use App\Models\PaymentTypesModel;

class CartController extends BaseController
{
    public function index()
    {
        if (session()->get('isLogged')) {
            $modelPayment = new PaymentTypesModel();
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
                'paymenttypes' => $modelPayment->getPaymentTypes(),
                'cartItems' => $cartItems,
                'cartImages' => $cartImages,
                'title' => 'My Cart'
            ];

            return view('items/cart', $data);
        } else {
            return redirect()->to('/login');
        }
    }

    public function addToCart()
    {
        $model = new CartModel();

        $response = array(
            'status' => 0,
            'message' => ''
        );

        if (session()->get('isLogged')) {
            if ($model->getCartID(session()->get('id'), $_POST['productID'])) {
                $response['status'] = 2;
                $response['message'] = "Item is already in the cart!";
            } else {
                $model->save([
                    'user_id' => session()->get('id'),
                    'product_id' => $_POST['productID']
                ]);
                $response['status'] = 1;
                $response['message'] = "Added to cart!";
            }
        } else {
            $response['status'] = 0;
            $response['message'] = "You must be logged in first!";
        }

        echo json_encode($response);
    }

    public function deleteCartItem()
    {
        $model = new CartModel();

        $response = array(
            'status' => 0,
            'message' => ''
        );

        if ($model->delete($model->getCartID($_POST['userID'], $_POST['productID'])['cart_id'])) {
            $response['status'] = 1;
            $response['message'] = "Delete successful";
        } else {
            $response['status'] = 0;
            $response['message'] = "Delete falied";
        }

        echo json_encode($response);
    }
}
