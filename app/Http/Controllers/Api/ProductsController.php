<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\AdvertisementUser;
use App\Models\Product;
use App\Models\productdetails;
use App\Models\ProductPrice;
use App\Models\ProductUser;
use Illuminate\Support\Facades\DB;
use Throwable;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{

    public function addProduct(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'category_id' => 'required|numeric|exists:categories,id',
            'name' => "required",
            'name_en' => "required",
            'product_number' => "required",
            'discription' => "required",
            'discription_en' => "required",
            'url' => "required",
            'type' => "required",
            'count' => "required",
            'vendor_name' => "required",
            'country' => "required",
            'city' => "required",
            'phone' => "required",
            'whatsapp' => "required",
            'image' => "required|image",
            'email' => "required",
            'sentence_price' => 'required',
            'price' => 'required',
            'now_price' => 'required',
            'old_price' => 'required',
            'delivery_service' => 'required',


        ]);
        if ($validator->fails()) {

            return response()->json(['errors' => true, 'message' => $validator->errors()], 200);
        }


        $filename = time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move('assets', $filename);


        DB::beginTransaction();
        try {

            $product = Product::create([
                'name' => $request->post('name'),
                'name_en' => $request->post('name_en'),
                'product_number' => $request->post('product_number'),
                'email' => $request->post('email'),
                'image' => $filename,
                'discription' => $request->post('discription'),
                'discription_en' => $request->post('discription_en'),
                'url' => $request->post('url'),
                'count' => $request->post('count'),
                'vendor_name' => $request->post('vendor_name'),
                'country' => $request->post('country'),
                'category_id' => $request->post('category_id'),
                'city' => $request->post('city'),
                'phone' => $request->post('phone'),
                'whatsapp' => $request->post('whatsapp'),
                'type' =>  $request->post('type'),
                'status' => '0',
                'user_id' => auth()->id(),

            ]);
            $productprice = ProductPrice::create([
                'sentence_price' => $request->post('sentence_price'),
                'price' => $request->post('price'),
                'now_price' => $request->post('now_price'),
                'old_price' => $request->post('old_price'),
                'delivery_service' => $request->post('delivery_service'),
                'product_id' => $product->id,
                'user_id' => auth()->id(),
            ]);


            if ($product) {
                DB::commit();
                return response()->json(['errors' => false, 'message' => $product], 200);
            }

            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            return $e;
        }
    }
    public function show($product_id, $lang)
    {
        $this->set_Language($lang);
        $product = Product::where('id', $product_id)->where('status', '1')->first();

        if ($product) {
            return response()->json(['errors' => false, 'data' => new ProductResource($product)], 200);
        } else {
            return response()->json(['errors' => true, 'message' => 'product not found'], 200);
        }
    }
    public function addProductdetails(Request $request, $prouduct_id)
    {

        $proudct = Product::whereId($prouduct_id)->first();
        if ($proudct) {
            $validator = Validator::make($request->all(), [
                'color' => 'required',
                'size' => 'required',
                'status' => 'required',
                'measuring' => 'required',
                'measuring_value' => 'required',
                'appearance' => 'required',
                'appearance_value' => 'required',
                'image' => 'required|image',
            ]);
            if ($validator->fails()) {

                return response()->json(['errors' => true, 'message' => $validator->errors()], 200);
            }

            $filename = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move('assets', $filename);
            $productdetails = productdetails::create([

                'color' => $request->post('color'),
                'size' => $request->post('size'),
                'status' => $request->post('status'),
                'image' => $filename,
                'measuring' => $request->post('measuring'),
                'measuring_value' => $request->post('measuring_value'),
                'appearance' => $request->post('appearance'),
                'appearance_value' => $request->post('appearance_value'),
                'product_id' => $proudct->id,
                'user_id' => auth()->id(),
            ]);
            return response()->json(['errors' => false, 'message' => 'product details added successfully'], 200);
        } else {
            return response()->json(['errors' => true, 'message' => 'product not found'], 200);
        }
    }
    public function addadvertisement(Request $request, $prouduct_id)
    {
        $proudct = Product::whereId($prouduct_id)->first();

        if ($proudct) {
            $validator = Validator::make($request->all(), [
                'type' => 'required',
                'period' => 'required',
                'price' => 'required',
                'image' => 'required|image',
                'product_id' => 'required|exists:products,id',
            ]);
            if ($validator->fails()) {

                return response()->json(['errors' => true, 'message' => $validator->errors()], 200);
            }

            $filename = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move('assets', $filename);
            $productprice = AdvertisementUser::create([
                'type' => $request->post('type'),
                'period' => $request->post('period'),
                'price' => $request->post('price'),
                'status' => 'darft',
                'product_id' => $proudct->id,
                'image' => $filename,
                'user_id' => auth()->id(),
            ]);

            return response()->json(['errors' => false, 'datat' => $productprice], 200);
        } else {
            return response()->json(['errors' => true, 'message' => 'product not found'], 200);
        }
    }
    public function product_user(Request $request, $prouduct_id)
    {

        $proudct = Product::whereId($prouduct_id)->first();
        if ($proudct) {
            $validator = Validator::make($request->all(), [
                'color' => 'required',
                'size' => 'required',
                'countity' => 'required',
                'price' => 'required',
                'status' => 'required',
            ]);
            if ($validator->fails()) {

                return response()->json(['errors' => true, 'message' => $validator->errors()], 200);
            }
            $produtUser = ProductUser::create([
                'color' => $request->post('color'),
                'size' => $request->post('size'),
                'countity' => $request->post('countity'),
                'price' => $request->post('price'),
                'product_id' => $proudct->id,
                'status' => $request->post('status'),
                'user_id' => auth()->id(),
            ]);
            return response()->json(['errors' => false, 'datat' => $produtUser], 200);
        } else {
            return response()->json(['errors' => true, 'message' => 'product not found'], 200);
        }
    }
}
