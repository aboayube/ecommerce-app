<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use App\Models\ProductUser;

class ProductUserController extends Controller
{
    function __construct()
    {
        /*      $this->middleware('permission:wasfas-index', ['only' => ['index']]);
        $this->middleware('permission:wasfas-store', ['only' => ['store']]);
        $this->middleware('permission:wasfas-edit', ['only' => ['edit']]);
        $this->middleware('permission:wasfas-update', ['only' => ['update']]);
        $this->middleware('permission:wasfas-delete', ['only' => ['destroy']]);
 */
    }
    public function index()
    {
        $productusers = ProductUser::orderBy('id', 'DESC')->with(['user', 'product'])->paginate(10);


        return view('admin.productuser', compact('productusers'));
    }
}
