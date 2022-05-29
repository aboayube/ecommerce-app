<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Advertisement;

class AdvertisementController extends Controller
{
    function __construct()
    {
        /*    $this->middleware('permission:category-index', ['only' => ['index']]);
        $this->middleware('permission:category-store', ['only' => ['store']]);
        $this->middleware('permission:category-edit', ['only' => ['edit']]);
        $this->middleware('permission:category-update', ['only' => ['update']]);
        $this->middleware('permission:category-delete', ['only' => ['destroy']]);
    */
    }
    public function index()
    {
        $advertisements = Advertisement::orderBy('id', 'DESC')->with(['user'])->paginate(10);
        return view(
            'admin.advertisement',
            compact(
                'advertisements',
            )
        );
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'period' => 'required',
            'price' => 'required',
            'status' => 'required'
        ]);
        if ($validator->fails()) {
            alert()->error('اقسام', 'هناك خطا ما');

            return redirect()->back()->withErrors($validator)->withInput();
        }
        $advertisements = Advertisement::create([
            'type' => $request->post('type'),
            'period' => $request->post('period'),
            'price' => $request->post('price'),
            'status' => $request->post('status'),
            'user_id' => auth()->user()->id,
        ]);
        alert()->success('اعلانات التطبيق', 'تم اضافة قسم بنجاح');
        return redirect()->route('admin.advertisements.index');
    }
    public function edit($id)
    {
        $advertisements = Advertisement::where('id', $id)->first();
        if ($advertisements) {
            return Response::json($advertisements);
        }
        return false;
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'period' => 'required',
            'price' => 'required',
            'status' => 'required'
        ]);
        if ($validator->fails()) {
            alert()->error('اقسام', 'هناك خطا ما');

            return redirect()->back()->withErrors($validator)->withInput();
        }
        $advertisements = Advertisement::where('id', $request->post('cat_id'))->first();

        if (!$advertisements) {
            alert()->error('اقسام', 'هناك خطا ما');
        } else {

            $data['type'] = $request->post('type');
            $data['period'] = $request->post('period');
            $data['price'] = $request->post('price');
            $data['status'] = $request->post('status');
            $advertisements->update($data);
            alert()->success('اقسام', 'تم اضافة قسم بنجاح');
            return redirect()->route('admin.advertisements.index');
        }
    }
    public function destroy(Request $request)
    {
        $department = Advertisement::where('id', $request->id)->first();
        if ($department) {
            $department->delete();
            alert()->warning('اقسام', 'تم حذف القسم بنجاح');

            return redirect()->route('admin.advertisements.index');
        } else {
            alert()->error('اقسام', 'هناك خطا ما');
            return false;
        }
    }
}
