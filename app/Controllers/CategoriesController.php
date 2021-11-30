<?php

namespace App\Controllers;

use App\Models\CategoriesModel;
use App\Models\SubcategoriesModel;

class CategoriesController extends BaseController
{
    public function addCategory()
    {
        $model = new CategoriesModel();

        $response = array(
            'status' => 0,
            'message' => ''
        );

        if (empty($_POST['categ'])) {
            $response['message'] = "All fields must be filled";
        } else {
            if ($model->checkCategory($_POST['categ'])) {
                $response['status'] = 0;
                $response['message'] = "Category already exists";
            } else {
                $model->save([
                    "category_name" => $_POST['categ']
                ]);
                $response['status'] = 1;
                $response['message'] = "Added Category: " . $_POST['categ'];
            }
        }
        echo json_encode($response);
    }

    public function addSubcategory()
    {
        $model = new SubcategoriesModel();

        $response = array(
            'status' => 0,
            'message' => ''
        );


        if (empty($_POST['subcateg']) || empty($_POST['assoc_categ'])) {
            $response['status'] = 0;
            $response['message'] = "All fields must be filled";
        } else {
            if ($_POST['assoc_categ'] === "def") {
                $response['status'] = 0;
                $response['message'] = "Choose a valid category";
            } else if ($model->checkSubcategory($_POST['subcateg'], $_POST['assoc_categ'])) {
                $response['status'] = 0;
                $response['message'] = "Subcategory already exists";
            } else {
                $model->save([
                    "subcategory_name" => $_POST['subcateg'],
                    "category" => $_POST['assoc_categ']
                ]);
                $response['status'] = 1;
                $response['message'] = "Added Subcategory: " . $_POST['subcateg'];
            }
        }
        echo json_encode($response);
    }

    public function editCategory()
    {
        $model = new CategoriesModel();

        $response = array(
            'status' => 0,
            'message' => ''
        );

        if ($model->update($_POST['categoryID'], [
            'category_name' => $_POST['categoryName']
        ])) {
            $response['status'] = 1;
            $response['message'] = "Category name updated to " . $_POST['categoryName'];
        } else {
            $response['status'] = 0;
            $response['message'] = "Category name update failed!";
        }

        echo json_encode($response);
    }

    public function deleteCategory()
    {
        $model = new CategoriesModel();

        $response = array(
            'status' => 0,
            'message' => ''
        );

        if ($model->delete($_POST['categoryID'])) {
            $response['status'] = 1;
            $response['message'] = "Category deleted successfully";
        } else {
            $response['status'] = 0;
            $response['message'] = "Category deletion failed!";
        }

        echo json_encode($response);
    }
}
