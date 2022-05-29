<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ReviewProduct;
use App\Models\ReviewSalers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RattingController extends Controller
{

    public function ratingSallar(Request $request, $prouduct_id)
    {
        $proudct = Product::whereId($prouduct_id)->first();
        if ($proudct) {
            $validator = Validator::make($request->all(), [
                'note' => 'required',
                'evaluation' => 'required',
            ]);
            if ($validator->fails()) {

                return response()->json(['errors' => true, 'message' => $validator->errors()], 200);
            }
            $review = ReviewSalers::create([
                'note' => $request->note,
                'evaluation' => $request->evaluation,
                'product_id' => $prouduct_id,
                'salers_id' => $proudct->user_id,
                'user_id' => auth()->id(),
            ]);
            return response()->json(['errors' => false, 'datat' => $review], 200);
        } else {
            return response()->json(['errors' => true, 'message' => 'هذا المنتج غير موجود'], 200);
        }
    }

    public function ratingProudct(Request $request, $prouduct_id)
    {
        $proudct = Product::whereId($prouduct_id)->first();
        if ($proudct) {
            $validator = Validator::make($request->all(), [
                'note' => 'required',
                'evaluation' => 'required',
            ]);
            if ($validator->fails()) {

                return response()->json(['errors' => true, 'message' => $validator->errors()], 200);
            }
            $product =     ReviewProduct::create([
                'note' => $request->note,
                'evaluation' => $request->evaluation,
                'product_id' => $proudct->id,
                'user_id' => auth()->id(),
            ]);
            return response()->json(['errors' => false, 'datat' => $product], 200);
        } else {
            return response()->json(['errors' => true, 'message' => 'هذا المنتج غير موجود'], 200);
        }
    }
    //
}
