<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\User;

class DepartmentController extends Controller
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
        $departements = Department::orderBy('id', 'DESC')->with(['user'])->paginate(10);
        return view(
            'admin.departements',
            compact(
                'departements',
            )
        );
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'name_en' => 'required',
            'status' => 'required'
        ]);
        if ($validator->fails()) {
            alert()->error('اقسام', 'هناك خطا ما');

            return redirect()->back()->withErrors($validator)->withInput();
        }
        $category = Department::create([
            'name' => $request->post('name'),
            'name_en' => $request->post('name_en'),
            'status' => $request->post('status'),
            'user_id' => auth()->user()->id,
        ]);
        alert()->success('اقسام', 'تم اضافة قسم بنجاح');
        return redirect()->route('admin.departments.index');
    }
    public function edit($id)
    {
        $department = Department::where('id', $id)->first();
        if ($department) {
            return Response::json($department);
        }
        return false;
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'name_en' => 'required',
            'status' => 'required',
        ]);
        if ($validator->fails()) {
            alert()->error('اقسام', 'هناك خطا ما');

            return redirect()->back()->withErrors($validator)->withInput();
        }
        $department = Department::where('id', $request->post('cat_id'))->first();

        if (!$department) {
            alert()->error('اقسام', 'هناك خطا ما');
        } else {

            $data['name'] = $request->post('name');
            $data['name_en'] = $request->post('name_en');
            $data['status'] = $request->post('status');
            $department->update($data);
            alert()->success('اقسام', 'تم اضافة قسم بنجاح');
            return redirect()->route('admin.departments.index');
        }
    }
    public function destroy(Request $request)
    {
        $department = Department::where('id', $request->id)->first();
        if ($department) {
            $department->delete();
            alert()->warning('اقسام', 'تم حذف القسم بنجاح');

            return redirect()->route('admin.departments.index');
        } else {
            alert()->error('اقسام', 'هناك خطا ما');
            return false;
        }
    }
}
