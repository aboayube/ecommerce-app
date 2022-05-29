<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AdvertisementResource;
use App\Http\Resources\CategoriesResource;
use App\Http\Resources\ColorResource;
use App\Http\Resources\DepartmentResource;
use App\Http\Resources\ProductInputResource;
use App\Http\Resources\ProductResource;
use App\Models\Advertisement;
use App\Models\Category;
use App\Models\Color;
use App\Models\Department;
use App\Models\Product;
use App\Models\ProductdetialsInput;
use App\Models\setting;
use Illuminate\Http\Request;

class GeneralApi extends Controller
{
    public function index($lang)
    {

        $this->set_Language($lang);
        $categoires = Category::where('status', '1')->paginate(10);
        $departments = Department::where('status', '1')->paginate(10);

        if ($departments->count() > 0) {
            return response()->json([
                'error' => false,
                'data' => [
                    'department' => DepartmentResource::collection($departments),
                    'categories' => CategoriesResource::collection($categoires),
                ], 'status' => 200
            ]);
        } else {
            return response()->json(['error' => true, 'message' => 'No wasfas found', 'status' => 200],);
        }
    }



    public function getLogo()
    {


        $setting = setting::select('image')->where('id', 1)->first();
        return response()->json(['error' => false, 'data' => ['logo' => asset('assets/setting/' . $setting["image"]),], 'status' => 200]);
    }

    public function whous($lang)
    {

        $this->set_Language($lang);
        $setting = setting::where('id', 1)->first();
        return response()->json(['error' => false, 'data' => ['who_us' => $setting->who_us(),], 'status' => 200]);
    }

    public function terms($lang)
    {

        $this->set_Language($lang);
        $setting = setting::where('id', 1)->first();
        return response()->json(['error' => false, 'data' => ['terms' => $setting->terms(),], 'status' => 200]);
    }
    public function getColors()
    {
        $colors = Color::where('status', "1")->get();
        if ($colors->count() > 0) {
            return response()->json(['error' => false, 'data' => ColorResource::collection($colors), 'status' => 200]);
        } else {
            return response()->json(['errors' => true, 'message' => "don't there data", 'status' => 404]);
        }
    }
    public function productsInput($lang)
    {
        $this->set_Language($lang);
        $inputs = ProductdetialsInput::whereId(1)->first();

        return response()->json(['error' => false, 'data' => new ProductInputResource($inputs), 'status' => 200]);
    }
    public function advertisement()
    {
        $advertisements = Advertisement::where("status", '1')->get();
        if ($advertisements->count() > 0) {
            return response()->json(['error' => false, 'data' => AdvertisementResource::collection($advertisements), 'status' => 200]);
        } else {
            return response()->json(['errors' => true, 'message' => "don't there data", 'status' => 404]);
        }
    }
}
