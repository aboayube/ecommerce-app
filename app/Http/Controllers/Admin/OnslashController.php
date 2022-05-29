<?php

namespace App\Http\Controllers\Admin;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Onslash;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use  App\Helpers\ImageClass;
use App\Models\User;

class OnslashController extends Controller
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
        $onslashs = Onslash::orderBy('id', 'DESC')->with(['user'])->paginate(6);
        return view(
            'admin.onslash',
            compact(
                'onslashs',
            )
        );
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|unique:onslashes,title|max:50',
            'title_en' => 'required|unique:onslashes,title_en|max:50',
            'description' => 'required',
            'description_en' => 'required',
            'image' => 'required'


        ]);
        if ($validator->fails()) {
            alert()->error('شاشات onslash', 'هناك خطا ما');

            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($request->image) {
            $filename = ImageClass::create($request->image, 'onslashes');
            $category = Onslash::create([
                'title_en' => $request->post('title_en'),
                'title' => $request->post('title'),
                'description' => $request->post('description'),
                'description_en' => $request->post('description_en'),
                'status' => $request->post('status'),
                'user_id' => auth()->user()->id,
                'image' => $filename,


            ]);
            alert()->success('شاشات onslash', 'تم اضافة قسم بنجاح');
            return redirect()->route('admin.onslashs.index');
        }
    }
    public function edit($id)
    {
        $onslash = Onslash::where('id', $id)->first();
        if ($onslash) {
            return Response::json($onslash);
        }
        return false;
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'title_en' => 'required',
            'description' => 'required',
            'description_en' => 'required',
        ]);
        if ($validator->fails()) {
            alert()->error('شاشات onslash',  'هناك خطا ما');

            return redirect()->back()->withErrors($validator)->withInput();
        }
        $onslash = Onslash::where('id', $request->post('cat_id'))->first();

        if (!$onslash) {
            alert()->error('اقسام', 'هناك خطا ما');
        } else {
            if ($request->image) {
                $data['image'] =   ImageClass::update($request->image, $onslash->image, 'onslashes');
            }

            $data['title'] = $request->post('title');
            $data['title_en'] = $request->post('title_en');
            $data['description'] = $request->post('description');
            $data['description_en'] = $request->post('description_en');
            $data['status'] = $request->post('status');
            $onslash->update($data);
            alert()->success('شاشات onslash', 'تم اضافة قسم بنجاح');
            return redirect()->route('admin.onslashs.index');
        }
    }
    public function destroy(Request $request)
    {
        $cat = Onslash::where('id', $request->id)->first();
        if ($cat) {
            ImageClass::delete($cat->image, 'onslashes');
            /*   $post = Wasfa::where('category_id', $request->id)->first();
            if ($post) {
                alert()->warning('تصنيف', 'هناك مقالات يجيب حذفها بالاول لانها مرتبطه بقسم');
                return redirect()->back();
            } */
            $cat->delete();
            alert()->warning('شاشات onslash', 'تم حذف القسم بنجاح');

            return redirect()->route('admin.onslashs.index');
        } else {
            alert()->error('شاشات onslash', 'هناك خطا ما');
            return false;
        }
    }
}
