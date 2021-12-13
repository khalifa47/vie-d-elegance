<?php

namespace App\Controllers;

use App\Models\AddressModel;
use Dompdf\Dompdf;

use App\Models\OrdersModel;
use App\Models\OrderDetailsModel;

use App\Models\CartModel;

use App\Models\CategoriesModel;
use App\Models\PaymentTypesModel;
use App\Models\UsersModel;
use App\Models\WalletModel;

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
        $modelWallet = new WalletModel();

        $response = array(
            'status' => 0,
            'message' => '',
            'orderID' => 0
        );

        $orderStatus = 'pending_payment';

        if ($_POST['ptype'] == 'def') {
            $response['status'] = 0;
            $response['message'] = 'Please select a payment type';
        } else {
            if ($_POST['ptype'] == 4) {
                $orderStatus = 'paid';
                $balance = $modelWallet->getWalletAtUser($_POST['userID'])['amount_available'];
                $newBalance = $balance - $_POST['orderAmt'];
                if ($newBalance < 0) {
                    $response['status'] = 0;
                    $response['message'] = 'Insufficient balance in the wallet. Please top up or select a different payment type.';
                    echo json_encode($response);
                    return;
                } else {
                    $modelWallet->update($modelWallet->getWalletAtUser($_POST['userID'])['wallet_id'], [
                        'amount_available' => $newBalance
                    ]);

                    session()->set(['walletBal' => $newBalance]);
                }
            }
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
            $response['orderID'] = $orderID;
        }
        echo json_encode($response);
    }

    public function generateReceipt($orderID)
    {
        $modelOrderDetails = new OrderDetailsModel();
        $modelOrder = new OrdersModel();
        $modelUser = new UsersModel();
        $modelAddress = new AddressModel();

        $data = [
            'order' => $modelOrder->getOrders($orderID),
            'orderItems' => $modelOrderDetails->getOrderDetailsAtOrder($orderID),
            'user' => $modelUser->getUsers(session()->get('id')),
            'address' => $modelAddress->getAddressAtUser(session()->get('id')),
            'title' => 'Order Receipt'
        ];

        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('items/receipt', $data));
        $dompdf->setPaper('A4');
        $dompdf->render();
        $dompdf->stream("receipt" . $orderID . ".pdf");
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
