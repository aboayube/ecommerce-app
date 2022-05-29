<?php

namespace App\Http\Controllers;

use App\Models\ProductdetialsInput;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ProductdetialsInputController extends Controller
{
    public function index()
    {
        $productdetialsInput = ProductdetialsInput::first();
        return view('admin.productdetialsInput', compact('productdetialsInput'));
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'input1' => 'required',
            'input1_en' => 'required',
            'input2' => 'required',
            'input2_en' => 'required',
        ]);
        if ($validator->fails()) {
            alert()->error('تصنيفات', 'هناك خطا ما');

            return redirect()->back()->withErrors($validator)->withInput();
        }
        $productdetialsInput = ProductdetialsInput::where('id', 1)->first();

        $data['input1'] = $request->post('input1');
        $data['input1_en'] = $request->post('input1_en');
        $data['input2'] = $request->post('input2');
        $data['input2_en'] = $request->post('input2_en');


        $productdetialsInput->update($data);

        alert()->success('اعدادات', 'تم  تعديل اعدادات الموقع بنجاح');

        return redirect()->route('admin.productdetialsInputs.index');
    }
}
