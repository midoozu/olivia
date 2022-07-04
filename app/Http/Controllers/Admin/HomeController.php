<?php

namespace App\Http\Controllers\Admin;

use App\Models\Inventory;

class HomeController
{
    public function index()
    {

       $todayincome =  Inventory::with('branchIncomes')->get();



        return view('admin.home',compact('todayincome'));
    }
}
