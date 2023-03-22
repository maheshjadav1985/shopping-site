<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;


class DashboardController extends Controller
{

    public function index() {
        $product = new Product();
        $order = new Order();
        $user = new User();

        return view('admin.dashboard', compact('product','order','user'));
    }

}
