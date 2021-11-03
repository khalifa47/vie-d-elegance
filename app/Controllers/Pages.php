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

    public function editProfile()
    {
        $model = new UsersModel();
        $model = new CategoriesModel();

        $data = [
            'user' => $model->getUsers(session()->get('id')),
            'categories' => $model->getCategories(),
            'title' => 'Edit Profile'
        ];

        return view('users/edit-profile', $data);
    }

    public function editPassword()
    {
        $model = new UsersModel();
        $model = new CategoriesModel();

        $data = [
            'user' => $model->getUsers(session()->get('id')),
            'categories' => $model->getCategories(),
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
}
