<?php

namespace App\Controllers;

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
        $data['title'] = "Edit Profile";

        return view('pages/edit-profile', $data);
    }
}
