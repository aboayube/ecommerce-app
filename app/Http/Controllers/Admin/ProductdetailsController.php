<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use App\Models\productdetails;
use App\Models\ProductdetialsInput;

class ProductdetailsController extends Controller
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

        $prodouctInput = ProductdetialsInput::first();
        $productdetails = productdetails::orderBy('id', 'DESC')->with(['user', 'product'])->paginate(10);


        return view('admin.productdetails', compact('productdetails', 'prodouctInput'));
    }

    /**
     * Show the form for editing the specified resource.
     *تعديل الحالة
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $productdetails = productdetails::whereId($id)->select('status')->first();

        return Response::json($productdetails);
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
        $productdetails = productdetails::find($request->id);

        $validator = Validator::make($request->all(), [
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            alert()->error('منتجات', 'هناك خطا');

            return redirect()->back()->withErrors($validator);
        }

        $productdetails->update([
            'status' => $request->post('status'),
        ]);
        alert()->success('منتجات', 'تم التعديل بنجاح');


        return redirect()->route('admin.productdetails.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $productdetails = productdetails::where('id', $request->id)->first();
        if ($productdetails->image) {
            ImageClass::delete($productdetails->image, 'productdetails');

            $productdetails->delete();
            alert()->warning('وصفات', 'تم حذف وصفات بنجاح');
            return redirect()->route('admin.productdetails.index');
        }
    }
}
