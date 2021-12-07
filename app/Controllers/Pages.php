<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\CategoriesModel;
use App\Models\PaymentTypesModel;

class Pages extends BaseController
{
    public function index()
    {
        $modelCategories = new CategoriesModel();
        $modelPayment = new PaymentTypesModel();

        $data = [
            'categories' => $modelCategories->getCategories(),
            'paymenttypes' => $modelPayment->getPaymentTypes(),
            'title' => 'Home'
        ];


        return view('pages/index', $data);
    }

    public function view($page)
    {
        if (!is_file(APPPATH . '/Views/pages/' . $page . '.php')) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException($page);
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter

        return view('pages/' . $page, $data);
    }

    public function login()
    {
        $modelCategories = new CategoriesModel();
        $modelPayment = new PaymentTypesModel();

        $data = [
            'categories' => $modelCategories->getCategories(),
            'paymenttypes' => $modelPayment->getPaymentTypes(),
            'title' => 'Login'
        ];

        return view('pages/login', $data);
    }

    public function editProfile()
    {
        $modelUsers = new UsersModel();
        $modelCat = new CategoriesModel();
        $modelPayment = new PaymentTypesModel();

        $data = [
            'user' => $modelUsers->getUsers(session()->get('id')),
            'categories' => $modelCat->getCategories(),
            'paymenttypes' => $modelPayment->getPaymentTypes(),
            'title' => 'Edit Profile'
        ];

        return view('users/edit-profile', $data);
    }

    public function editPassword()
    {
        $modelUsers = new UsersModel();
        $modelCat = new CategoriesModel();
        $modelPayment = new PaymentTypesModel();

        $data = [
            'user' => $modelUsers->getUsers(session()->get('id')),
            'categories' => $modelCat->getCategories(),
            'paymenttypes' => $modelPayment->getPaymentTypes(),
            'title' => 'Edit Password'
        ];

        return view('users/edit-password', $data);
    }

    public function addCategory()
    {
        $modelCategories = new CategoriesModel();
        $modelPayment = new PaymentTypesModel();

        $data = [
            'categories' => $modelCategories->getCategories(),
            'paymenttypes' => $modelPayment->getPaymentTypes(),
            'title' => 'Add Category'
        ];

        return view('items/admin/add-category', $data);
    }

    public function addItem()
    {
        $modelUsers = new UsersModel();
        $modelCat = new CategoriesModel();
        $modelPayment = new PaymentTypesModel();

        $data = [
            'user' => $modelUsers->getUsers(session()->get('id')),
            'categories' => $modelCat->getCategories(),
            'paymenttypes' => $modelPayment->getPaymentTypes(),
            'title' => 'Add Item'
        ];

        return view('items/admin/add-items', $data);
    }

    public function addUser()
    {
        $modelCategories = new CategoriesModel();
        $modelPayment = new PaymentTypesModel();

        $data = [
            'categories' => $modelCategories->getCategories(),
            'paymenttypes' => $modelPayment->getPaymentTypes(),
            'title' => 'Add User'
        ];

        return view('users/admin/add-user', $data);
    }
}
