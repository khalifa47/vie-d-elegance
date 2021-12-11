<?php

namespace App\Controllers;

use App\Models\AddressModel;

use App\Models\CategoriesModel;
use App\Models\PaymentTypesModel;

class AddressController extends BaseController
{
    public function index()
    {
        $modelCat = new CategoriesModel();
        $modelPayment = new PaymentTypesModel();
        $modelAddress = new AddressModel();

        $data = [
            'categories' => $modelCat->getCategories(),
            'paymenttypes' => $modelPayment->getPaymentTypes(),
            'address' => $modelAddress->getAddressAtUser(session()->get('id')),
            'title' => 'Address'
        ];

        return view('users/address', $data);
    }

    public function addAddress()
    {
        $modelAddress = new AddressModel();

        $response = array(
            'status' => 0,
            'message' => ''
        );

        if ($modelAddress->save([
            'user_id' => $_POST['uid'],
            'address-line-1' => $_POST['line1'],
            'address-line-2' => $_POST['line2'],
            'additional-info' => empty($_POST['add']) ? "No additional info" : $_POST['add']
        ])) {
            $response['status'] = 1;
            $response['message'] = "Address added successfully";
        } else {
            $response['status'] = 0;
            $response['message'] = "Address failed to add";
        }
        echo json_encode($response);
    }

    public function updateAddress()
    {
        $modelAddress = new AddressModel();

        $response = array(
            'status' => 0,
            'message' => ''
        );

        if ($modelAddress->update($_POST['uid'], [
            'address-line-1' => $_POST['line1'],
            'address-line-2' => $_POST['line2'],
            'additional-info' => empty($_POST['add']) ? "No additional info" : $_POST['add']
        ])) {
            $response['status'] = 1;
            $response['message'] = "Address updated successfully";
        } else {
            $response['status'] = 0;
            $response['message'] = "Address failed to update";
        }
        echo json_encode($response);
    }
}
