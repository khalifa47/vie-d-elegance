<?php

namespace App\Controllers;

use App\Models\WalletModel;
use App\Models\CategoriesModel;

class WalletController extends BaseController
{
    public function index()
    {
        // $modelCategs = new CategoriesModel();
        // $modelWallet = new WalletModel();

        // $data = [
        //     'wallet' => $modelWallet->getWalletAtUser(session()->get('id')),
        //     'categories' => $modelCategs->getCategories(),
        //     'title' => 'V-Wallet'
        // ];

        // return view('transactions/wallet', $data);
    }
}
