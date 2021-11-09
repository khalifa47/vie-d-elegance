<?php

namespace App\Controllers;

use App\Models\CategoriesModel;
use App\Models\SubcategoriesModel;

use App\Models\ItemsModel;
use App\Models\ImagesModel;

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
    public function getSubcategories()
    {
        $model = new SubcategoriesModel();

        $response = array(
            'status' => 0,
            'subcats' => ''
        );

        if (!empty($model->getSubcategoriesAtCategory($_POST['categ_id']))) {
            $response['status'] = 1;
            $response['subcats'] = $model->getSubcategoriesAtCategory($_POST['categ_id']);
        } else {
            $response['status'] = 0;
        }
        echo json_encode($response);
    }

    public function addItem()
    {
        $modelImages = new ImagesModel();
        $modelItems = new ItemsModel();

        $response = array(
            'status' => 0,
            'message' => ''
        );

        if ($_POST['subcat'] == 'def') {
            $response['status'] = 0;
            $response['message'] = "Select appropriate categories";
        } else if ($_POST['uprice'] < 0) {
            $response['status'] = 0;
            $response['message'] = "Invalid price entered";
        } else if ($_POST['av_q'] < 0) {
            $response['status'] = 0;
            $response['message'] = "Invalid quantity entered";
        } else if (!isset($_FILES['item_images']['name']) || count($_FILES['item_images']['name']) < 2) {
            $response['status'] = 0;
            $response['message'] = "You have to upload at least 1 image";
        } else if (count($_FILES['item_images']['name']) > 5) {
            $response['status'] = 0;
            $response['message'] = "You can upload a maximum of 5 images";
        } else {
            //for the data
            $prod_id = $modelItems->insertItem([
                "product_name" => $_POST['iname'],
                "product_description" => $_POST['idesc'],
                "product_image" => $_POST['alttext'],
                "unit_price" => $_POST['uprice'],
                "available_quantity" => $_POST['av_q'],
                "subcategory_id" => $_POST['subcat'],
                "added_by" => $_POST['admin_id']
            ]);

            //for the files
            $files_upload_path = "./assets/items_img";

            for ($i = 0; $i < count($_FILES['item_images']['name']); $i++) {
                $file_ext = strtolower(pathinfo($_FILES['item_images']['name'][$i], PATHINFO_EXTENSION));
                $rand_fname = md5(rand() * time()) . url_title($_POST['iname'], "_", true) . ".$file_ext";
                $filepath = $files_upload_path . "/" . $rand_fname;
                if (!move_uploaded_file($_FILES['item_images']['tmp_name'][$i], $filepath)) {
                    $response['status'] = 0;
                    $response['message'] = "An error occurred while uploading the files";
                }
                $modelImages->save([
                    "product_image" => $rand_fname,
                    "product_id" => $prod_id,
                    "added_by" => $_POST['admin_id']
                ]);
            }
            $response['status'] = 1;
            $response['message'] = "Added item successfully: " . $_POST['iname'];
        }
        echo json_encode($response);
    }
}
