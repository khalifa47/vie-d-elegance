<?php

namespace App\Models;

use CodeIgniter\Model;

class OrdersModel extends Model
{
    protected $table = 'tbl_order';
    protected $primaryKey = 'order_id';
    protected $allowedFields = ['customer_id', 'order_amount', 'order_status', 'payment_type', 'created_at', 'updated_at', 'is_deleted'];

    public function getOrders($id = false, $limit5 = false)
    {
        if ($id === false && $limit5 === false) {
            return $this
                ->orderby('created_at', 'DESC')
                ->findAll();
        } else if ($id === false && $limit5 !== false) {
            return $this
                ->orderby('created_at', 'DESC')
                ->limit(5)
                ->findAll();
        }

        return $this->asArray()
            ->where(['order_id' => $id])
            ->first();
    }
    public function getOrdersAtUser($uid)
    {
        return $this->asArray()
            ->orderby('created_at', 'DESC')
            ->where(['customer_id' => $uid])
            ->findAll();
    }

    public function insertOrder($data)
    {
        $this->save($data);
        return $this->getInsertID();
    }

    public function getSalesTotal()
    {
        return $this->asArray()
            ->selectSum('order_amount')
            ->findAll();
    }

    public function getMinTransactions($id = false, $sort = 'order_id', $filter_option = null, $filter_value = null)
    {
        if ($id === false) {
            if ($filter_option != null && $filter_value != null) {
                $filterClause = "$filter_option='$filter_value'";

                if ($filter_option == 'tbl_order.created_at') {
                    if (strpos($filter_value, ' ') != false) {
                        $dateArr = explode(' ', $filter_value);
                        $filterClause = "tbl_order.created_at BETWEEN DATE('" . $dateArr[0] . "') AND DATE('" . $dateArr[1] . "')";
                    }
                }
                return $this->asArray()
                    ->join('tbl_orderdetails', 'tbl_orderdetails.order_id = tbl_order.order_id')
                    ->join('tbl_product', 'tbl_product.product_id = tbl_orderdetails.product_id')
                    ->join('tbl_subcategories', 'tbl_subcategories.subcategory_id = tbl_product.subcategory_id')
                    ->join('tbl_categories', 'tbl_subcategories.category = tbl_categories.category_id')
                    ->select(['tbl_order.order_id', 'customer_id', 'order_amount', 'order_status', 'payment_type', 'tbl_order.created_at'])
                    ->where($filterClause)
                    ->distinct()
                    ->orderby($sort, 'DESC')
                    ->findAll();
            }
            return $this->asArray()
                ->select(['tbl_order.order_id', 'customer_id', 'order_amount', 'order_status', 'payment_type', 'created_at'])
                ->orderby($sort, 'DESC')
                ->findAll();
        }
        return $this->asArray()
            ->select(['tbl_order.order_id', 'customer_id', 'order_amount', 'order_status', 'payment_type', 'created_at'])
            ->where(['order_id' => $id])
            ->first();
    }
}
