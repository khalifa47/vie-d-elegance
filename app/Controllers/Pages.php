<?php

namespace App\Controllers;

use App\Models\UsersModel;
use App\Models\CategoriesModel;

class Pages extends BaseController
{
    public function index()
    {
        $model = new CategoriesModel();

        $data = [
            'categories' => $model->getCategories(),
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
        $model = new CategoriesModel();

        $data = [
            'categories' => $model->getCategories(),
            'title' => 'Login'
        ];

        return view('pages/login', $data);
    }

    public function editProfile()
    {
        $modelUsers = new UsersModel();
        $modelCat = new CategoriesModel();

        $data = [
            'user' => $modelUsers->getUsers(session()->get('id')),
            'categories' => $modelCat->getCategories(),
            'title' => 'Edit Profile'
        ];

        return view('users/edit-profile', $data);
    }

    public function editPassword()
    {
        $modelUsers = new UsersModel();
        $modelCat = new CategoriesModel();

        $data = [
            'user' => $modelUsers->getUsers(session()->get('id')),
            'categories' => $modelCat->getCategories(),
            'title' => 'Edit Password'
        ];

        return view('users/edit-password', $data);
    }

    public function addCategory()
    {
        $model = new CategoriesModel();

        $data = [
            'categories' => $model->getCategories(),
            'title' => 'Add Category'
        ];

        return view('items/admin/add-category', $data);
    }

    public function addItem()
    {
        $modelUsers = new UsersModel();
        $modelCat = new CategoriesModel();

        $data = [
            'user' => $modelUsers->getUsers(session()->get('id')),
            'categories' => $modelCat->getCategories(),
            'title' => 'Add Item'
        ];

        return view('items/admin/add-items', $data);
    }

    public function addUser()
    {
        $model = new CategoriesModel();

        $data = [
            'categories' => $model->getCategories(),
            'title' => 'Add User'
        ];

        return view('users/admin/add-user', $data);
    }

    public function cart()
    {
        $model = new CategoriesModel();

        $data = [
            'categories' => $model->getCategories(),
            'title' => 'My Cart'
        ];

        return view('items/cart', $data);
    }
}
