<?php

namespace App\Controllers;

use App\Models\CategoriesModel;

class ItemsController extends BaseController
{
    public function index()
    {
        $model = new CategoriesModel();

        $data = [
            'categories' => $model->getCategories(),
            'title' => 'Items'
        ];

        return view('items/items', $data);
    }
    public function view($id = null)
    {
        // $model = new CategoriesModel();
        // $model = new UsersModel();

        // $data['user'] = $model->getUsers($id);

        // if (empty($data['user'])) {
        //     throw new \CodeIgniter\Exceptions\PageNotFoundException('Item does not exist: ' . $id);
        // }

        // $data['title'] = $data['user']['first_name'] . " " . $data['user']['last_name'];

        return view('items/item', ['title' => 'Item']);
    }
}
