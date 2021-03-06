<?php

namespace App\Controllers;

use App\Models\AddressModel;
use Dompdf\Dompdf;

use App\Models\OrdersModel;
use App\Models\OrderDetailsModel;

use App\Models\CartModel;

use App\Models\CategoriesModel;
use App\Models\ItemsModel;
use App\Models\PaymentTypesModel;
use App\Models\UsersModel;
use App\Models\WalletModel;

class OrdersController extends BaseController
{


    public function index()
    {
        if (session()->get('isLogged')) {
            $modelCategs = new CategoriesModel();
            $modelPayment = new PaymentTypesModel();
            $modelOrders = new OrdersModel();
            $modelOrderDetails = new OrderDetailsModel();

            $data = [
                'categories' => $modelCategs->getCategories(),
                'paymenttypes' => $modelPayment->getPaymentTypes(),
                'orders' => $modelOrders->getOrdersAtUser(session()->get('id')),
                'orderdetails' => [],
                'title' => 'My Orders'
            ];



            foreach ($data['orders'] as $order) {
                array_push($data['orderdetails'], [$order['order_id'], $modelOrderDetails->getOrderDetailsAtOrder($order['order_id'])]);
            }

            return view('items/orders', $data);
        } else {
            return redirect()->to('/login');
        }
    }

    public function checkout()
    {
        $modelOrders = new OrdersModel();
        $modelOrderDetails = new OrderDetailsModel();
        $modelCart = new CartModel();
        $modelWallet = new WalletModel();
        $modelProducts = new ItemsModel();

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
            $allItemsValid = TRUE;
            $altMessage = 'Could not complete the order';

            foreach ($_POST['cartItems'] as $cartItem) {
                if ($modelProducts->getItems($cartItem['product_id'])['available_quantity'] < $cartItem['quantityVal']) {
                    $allItemsValid = FALSE;
                    $altMessage .= '. Item with ID: ' . $cartItem['product_id'] . ' exceeded stock limit: ' . $modelProducts->getItems($cartItem['product_id'])['available_quantity'];
                }
            }

            if ($allItemsValid) {
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
                    $modelProducts->update($cartItem['product_id'], [
                        'available_quantity' => $modelProducts->getItems($cartItem['product_id'])['available_quantity'] - $cartItem['quantityVal']
                    ]);
                }

                $response['status'] = 1;
                $response['message'] = "Order completed successfully!";
                $response['orderID'] = $orderID;
            } else {
                $response['status'] = 0;
                $response['message'] = $altMessage;
            }
        }
        echo json_encode($response);
    }

    public function generateReceipt($orderID)
    {
        $modelOrderDetails = new OrderDetailsModel();
        $modelOrder = new OrdersModel();
        $modelUser = new UsersModel();
        $modelAddress = new AddressModel();
        $modelPayment = new PaymentTypesModel();

        $data = [
            'order' => $modelOrder->getOrders($orderID),
            'orderItems' => $modelOrderDetails->getOrderDetailsAtOrder($orderID),
            'user' => $modelUser->getUsers(session()->get('id')),
            'address' => $modelAddress->getAddressAtUser(session()->get('id')),
            'paymenttype' => '',
            'title' => 'Order Receipt'
        ];

        $data['paymenttype'] = $modelPayment->getPaymentTypes($data['order']['payment_type'])['paymenttype_name'];

        $dompdf = new Dompdf();
        $dompdf->loadHtml(view('items/receipt', $data));
        $dompdf->setPaper('A4');
        $dompdf->render();
        $dompdf->stream("receipt#" . $orderID . ".pdf", ['Attachment' => 0]);
    }

    public function cancelOrder()
    {
        $modelOrder = new OrdersModel();

        $response = array(
            'status' => 0,
            'message' => ''
        );

        if ($modelOrder->update($_POST['orderID'], ['order_status' => 'cancelled'])) {
            $response['status'] = 1;
            $response['message'] = "Order cancelled successfully";
        } else {
            $response['status'] = 0;
            $response['message'] = "Delete falied";
        }

        echo json_encode($response);
    }

    public function deleteOrderItem()
    {
        $modelOrderDetails = new OrderDetailsModel();
        $modelOrders = new OrdersModel();

        $response = array(
            'status' => 0,
            'message' => ''
        );

        if ($modelOrders->update($_POST['orderID'], ['order_amount' => $modelOrders->getOrders($_POST['orderID'])['order_amount'] - $modelOrderDetails->getOrderDetail($_POST['orderItemID'])['orderdetails_total']]) && $modelOrderDetails->delete($_POST['orderItemID'])) {
            if (empty($modelOrderDetails->getOrderDetailsAtOrder($_POST['orderID']))) {
                $modelOrders->delete($_POST['orderID']);
                $response['message'] = "Order completely deleted!";
            } else {
                $response['message'] = "Item removed successfully";
            }
            $response['status'] = 1;
        } else {
            $response['status'] = 0;
            $response['message'] = "Delete failed";
        }

        echo json_encode($response);
    }
}
