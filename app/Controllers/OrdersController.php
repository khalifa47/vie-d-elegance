<?php

namespace App\Controllers;

use App\Models\OrdersModel;
use App\Models\OrderDetailsModel;

use App\Models\CartModel;

use App\Models\CategoriesModel;
use App\Models\PaymentTypesModel;

class OrdersController extends BaseController
{
    public function index()
    {
        $modelCategs = new CategoriesModel();
        $modelPayment = new PaymentTypesModel();

        $data = [
            'categories' => $modelCategs->getCategories(),
            'paymenttypes' => $modelPayment->getPaymentTypes(),
            'title' => 'Orders'
        ];

        return view('items/orders', $data);
    }

    public function checkout()
    {
        $modelOrders = new OrdersModel();
        $modelOrderDetails = new OrderDetailsModel();
        $modelCart = new CartModel();

        $response = array(
            'status' => 0,
            'message' => ''
        );

        $orderStatus = 'pending_payment';

        if ($_POST['ptype'] == 4) {
            $orderStatus = 'paid';
        }
        if ($_POST['ptype'] == 'def') {
            $response['status'] = 0;
            $response['message'] = 'Please select a payment type';
        } else {
            $orderID = $modelOrders->insertOrder([
                'customer_id' => $_POST['userID'],
                'order_amount' => $_POST['orderAmt'],
                'order_status' => $orderStatus,
                'payment_type' => $_POST['ptype']
            ]);

            foreach ($_POST['cartItems'] as $cartItem) {
                $modelOrderDetails->save([
                    'order_id' => $orderID,
                    'product_id' => $cartItem['product_id'],
                    'product_price' => $cartItem['unit_price'],
                    'order_quantity' => $cartItem['quantityVal'],
                    'orderdetails_total' => ($cartItem['unit_price'] * $cartItem['quantityVal'])
                ]);
                $modelCart->delete($modelCart->getCartID($_POST['userID'], $cartItem['product_id'])['cart_id']);
            }

            $response['status'] = 1;
            $response['message'] = "Order completed successfully!";
        }
        echo json_encode($response);
    }
    // public function view($id = null)
    // {
    //     $modelCategs = new CategoriesModel();
    //     $modelPayment = new PaymentTypesModel();

    //     $data = [
    //         'categories' => $modelCategs->getCategories(),
    //         'paymenttypes' => $modelPayment->getPaymentTypes()
    //     ];

    //     if (empty($data['item'])) {
    //         throw new \CodeIgniter\Exceptions\PageNotFoundException('Item does not exist: ' . $id);
    //     }

    //     $data['title'] = $data['item']['product_name'];

    //     return view('items/order', $data);
    // }
}
