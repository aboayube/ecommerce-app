<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class ProductPriceController extends Controller
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

    /**
     * Show the form for editing the specified resource.
     *تعديل الحالة
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $wasfa = Product::whereId($id)->select('status')->first();

        return Response::json($wasfa);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = Product::find($request->id);

        $validator = Validator::make($request->all(), [
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            alert()->error('منتجات', 'هناك خطا');

            return redirect()->back()->withErrors($validator);
        }

        $user->update([
            'status' => $request->post('status'),
        ]);
        alert()->success('منتجات', 'تم التعديل بنجاح');


        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $product = Product::where('id', $request->id)->first();
        if ($product->image) {
            ImageClass::delete($product->image, 'products');

            $product->delete();
            alert()->warning('وصفات', 'تم حذف وصفات بنجاح');
            return redirect()->route('admin.products.index');
        }
    }
}
