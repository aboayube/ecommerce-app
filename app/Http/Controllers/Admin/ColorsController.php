<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageClass;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ColorsController extends Controller
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
        $colors = Color::orderBy('id', 'DESC')->with(['user'])->paginate(6);
        return view(
            'admin.colors',
            compact(
                'colors',
            )
        );
    }
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'color' => 'required',
            'status' => 'required',
        ]);
        if ($validator->fails()) {
            alert()->error('اقسام', 'هناك خطا ما');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $category = Color::create([
            'name' => $request->post('color'),
            'status' => $request->post('status'),
            'user_id' => auth()->user()->id,
        ]);
        alert()->success('اقسام', 'تم اضافة قسم بنجاح');
        return redirect()->route('admin.colors.index');
    }
    public function edit($id)
    {
        $cat = Color::where('id', $id)->first();
        if ($cat) {
            return Response::json($cat);
        }
        return false;
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'status' => 'required',
        ]);
        if ($validator->fails()) {
            alert()->error('اقسام', 'هناك خطا ما');

            return redirect()->back()->withErrors($validator)->withInput();
        }
        $cat = Color::where('id', $request->post('cat_id'))->first();
        if (!$cat) {
            alert()->error('اقسام', 'هناك خطا ما');
        } else {
            $data['status'] = $request->post('status');
            $cat->update($data);
            alert()->success('اقسام', 'تم اضافة قسم بنجاح');
            return redirect()->route('admin.colors.index');
        }
    }
    public function destroy(Request $request)
    {
        $cat = Color::where('id', $request->id)->first();
        if ($cat) {
            $cat->delete();
            alert()->warning('اقسام', 'تم حذف القسم بنجاح');
            return redirect()->route('admin.colors.index');
        } else {
            alert()->error('اقسام', 'هناك خطا ما');
            return false;
        }
    }
}
