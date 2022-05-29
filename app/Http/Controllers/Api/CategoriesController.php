<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoriesResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    //
    public function index($lang)
    {
        $this->set_Language($lang);
        $categories = Category::where('status', '1')->paginate(10);
        if ($categories->count() > 0) {
            return response()->json(['error' => false, 'data' => CategoriesResource::collection($categories), 'status' => 200]);
        } else {
            return response()->json(['error' => true, 'message' => 'No wasfas found', 'status' => 200],);
        }
    }
    public function child_categories($parent_id, $lang)
    {
        $this->set_Language($lang);
        $categories = Category::where('status', '1')->where('parent_id', $parent_id)->paginate(10);
        if ($categories->count() > 0) {
            return response()->json(['error' => false, 'data' => CategoriesResource::collection($categories), 'status' => 200]);
        } else {
            return response()->json(['error' => true, 'message' => 'No wasfas found', 'status' => 200],);
        }
    }
}
