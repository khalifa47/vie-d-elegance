<?php

namespace App\Controllers;

use App\Models\PaymentTypesModel;

class PaymentController extends BaseController
{
    public function addPaymentType()
    {
        $model = new PaymentTypesModel();

        $response = array(
            'status' => 0,
            'message' => ''
        );

        if ($model->checkPaymentType($_POST['paymentName'])) {
            $response['status'] = 0;
            $response['message'] = "Payment type: " . $_POST['paymentName'] . " already exists";
        } else if ($model->save([
            'paymenttype_name' => $_POST['paymentName'],
            'description' => $_POST['paymentDesc']
        ])) {
            $response['status'] = 1;
            $response['message'] = "Payment type: " . $_POST['paymentName'] . " added successfully";
        } else {
            $response['status'] = 0;
            $response['message'] = "Addition of payment type failed";
        }
        echo json_encode($response);
    }
}
