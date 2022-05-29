<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Payment;
use App\Models\Product;
use App\Models\ProductPrice;
use App\Models\User;
use Illuminate\Http\Request;

class DashboradController extends Controller
{

    public function index(Request $request)
    {


        $user = User::where('role', 'user')->count();
        $department = Department::where('status', '1')->count();
        $product = Product::where('status', '1')->count();
        $product_price = ProductPrice::count();
        $payment = Payment::where('status', '1')->count();

        return view('dashboard', compact('user', 'department', 'product', 'product_price', 'payment'));
    }
    //
}
