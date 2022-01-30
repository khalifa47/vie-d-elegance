<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemsModel extends Model
{
    protected $table = 'tbl_product';
    protected $primaryKey = 'product_id';
    protected $allowedFields = ['product_name', 'product_description', 'product_image', 'unit_price', 'available_quantity', 'subcategory_id', 'created_at', 'updated_at', 'added_by', 'is_deleted'];

    public function getItems($id = false)
    {
        if ($id === false) {
            return $this->findAll();
        }

        return $this->asArray()
            ->where(['product_id' => $id])
            ->first();
    }

    public function insertItem($data)
    {
        $this->save($data);
        return $this->getInsertID();
    }

    public function getItemsAtCateg($categ_id)
    {
        return $this->asArray()
            ->where(['subcategory_id' => $categ_id])
            ->findAll();
    }

    public function getTopPerformingProducts()
    {
        return $this->asArray()
            ->join('tbl_orderdetails', 'tbl_orderdetails.product_id = tbl_product.product_id')
            ->selectSum('orderdetails_total')
            ->select(['tbl_product.product_id', 'product_name', 'unit_price', 'available_quantity'])
            ->groupby('tbl_orderdetails.product_id')
            ->orderby('orderdetails_total', 'DESC')
            ->limit(5)
            ->findAll();
    }

    public function getRevenueByCategory()
    {
        return $this->asArray()
            ->join('tbl_orderdetails', 'tbl_orderdetails.product_id = tbl_product.product_id')
            ->join('tbl_subcategories', 'tbl_subcategories.subcategory_id = tbl_product.subcategory_id')
            ->join('tbl_categories', 'tbl_subcategories.category = tbl_categories.category_id')
            ->selectSum('orderdetails_total')
            ->select('tbl_categories.category_name')
            ->groupby('tbl_categories.category_id')
            ->findAll();
    }

    // api function

    public function getMinProducts($id = false, $sort = 'product_id', $filter_option = null, $filter_value = null)
    {
        if ($id === false) {
            if ($sort == 'sales') {
                $sort = 'orderdetails_total';
            }
            if ($filter_option != null && $filter_value != null) {
                return $this->asArray()
                    ->join('tbl_orderdetails', 'tbl_orderdetails.product_id = tbl_product.product_id')
                    ->join('tbl_order', 'tbl_order.order_id = tbl_orderdetails.order_id')
                    ->join('tbl_users', 'tbl_users.user_id = tbl_order.customer_id')
                    ->join('tbl_subcategories', 'tbl_subcategories.subcategory_id = tbl_product.subcategory_id')
                    ->join('tbl_categories', 'tbl_subcategories.category = tbl_categories.category_id')
                    ->select(['tbl_product.product_id', 'product_name', 'product_description', 'unit_price', 'available_quantity', 'tbl_product.subcategory_id'])
                    ->where([$filter_option => $filter_value])
                    ->distinct()
                    ->orderby($sort, 'DESC')
                    ->findAll();
            }
            return $this->asArray()
                ->join('tbl_orderdetails', 'tbl_product.product_id = tbl_orderdetails.product_id', 'left')
                ->select(['tbl_product.product_id', 'product_name', 'product_description', 'unit_price', 'available_quantity', 'tbl_product.subcategory_id'])
                ->selectSum('orderdetails_total')
                ->groupby('product_id')
                ->orderby($sort, 'DESC')
                ->findAll();
        }
        return $this->asArray()
            ->select(['product_id', 'product_name', 'product_description', 'unit_price', 'available_quantity', 'subcategory_id'])
            ->where(['product_id' => $id])
            ->first();
    }

    public function searchProduct($searchval)
    {
        return $this->asArray()
            ->select(['product_id', 'product_name', 'product_description', 'unit_price', 'available_quantity', 'subcategory_id'])
            ->like('product_name', $searchval, 'both')
            ->findAll();
    }
}
