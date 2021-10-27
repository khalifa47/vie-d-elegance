<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Pages extends BaseController
{
    public function index()
    {
        $data['title'] = "Home";

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

        $data['title'] = "Edit Profile";

        $data = [
            'user' => $model->getUsers(session()->get('id')),
            'title' => 'Edit Profile'
        ];

        return view('users/edit-profile', $data);
    }
}
