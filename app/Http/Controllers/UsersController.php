<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    public function index() {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function show($id) {

        // Find the user
        $orders = Order::where('user_id', $id)->get();
    
        // Return array back to user details page

        return view('admin.users.details', compact('orders'));

    }
}
