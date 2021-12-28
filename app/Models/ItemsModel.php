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
}
