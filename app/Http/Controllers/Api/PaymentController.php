<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'status' => 'required',
            'price' => 'required',
            'payment_type' => "product_salers",
            'type' => 'required',
            'payment_type' => 'required',

        ]);


        if ($validator->fails()) {
            return response()->json(['errors' => true, 'message' => $validator->errors()], 200);
        }

        $payment = Payment::create([
            'product_id' => $request->post('product_id'),
            'status' => $request->post('status'),
            'price' => $request->post('price'),
            'payment_type' => $request->post('payment_type'),
            'type' => $request->post('type'),
            'user_id' => auth()->id(),
        ]);
        if ($payment) {
            return response()->json(['errors' => false, 'message' => 'success', 'data' => $payment], 200);
        } else {
            return response()->json(['errors' => true, 'message' => 'error'], 200);
        }
    }
}
