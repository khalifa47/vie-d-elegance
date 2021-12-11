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

    public function editPaymentType()
    {
        $model = new PaymentTypesModel();

        $response = array(
            'status' => 0,
            'message' => ''
        );

        if ($model->update($_POST['ptypeID'], [
            'paymenttype_name' => $_POST['ptypeName'],
            'description' => $_POST['ptypeDesc']
        ])) {
            $response['status'] = 1;
            $response['message'] = "Payment name updated to: " . $_POST['ptypeName'] . "\nPayment description updated to: " . $_POST['ptypeDesc'];
        } else {
            $response['status'] = 0;
            $response['message'] = "Payment type name update failed!";
        }

        echo json_encode($response);
    }

    public function deletePaymentType()
    {
        $model = new PaymentTypesModel();

        $response = array(
            'status' => 0,
            'message' => ''
        );

        if ($model->delete($_POST['ptypeID'])) {
            $response['status'] = 1;
            $response['message'] = "Payment type deleted successfully";
        } else {
            $response['status'] = 0;
            $response['message'] = "Payment type deletion failed!";
        }

        echo json_encode($response);
    }
}
