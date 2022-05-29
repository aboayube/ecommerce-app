<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use  App\Helpers\ImageClass;
use App\Models\AdvertisementUser;

class AdvertisementUserController extends Controller
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
        $advertisementUsers = AdvertisementUser::orderBy('id', 'DESC')->with(['user', 'product'])->paginate(6);
        return view(
            'admin.advertisementUser',
            compact(
                'advertisementUsers',
            )
        );
    }
    // عملية الاضافة
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'price' => 'required',
            'image' => 'required',
            'period' => 'required',
            'status' => 'required',
            'user_id' => 'required',
            'product_id' => 'required',
        ]);
        if ($validator->fails()) {
            alert()->error('اعلانات', 'هناك خطا ما');

            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ($request->image) {
            $filename = ImageClass::create($request->image, 'advertisementUser');
            $advertisementUser = AdvertisementUser::create([
                'price' => $request->post('price'),
                'image' => $filename,
                'period' => $request->post('period'),
                'status' => $request->post('status'),
                'user_id' => $request->post('user_id'),
                'product_id' => $request->post('product_id'),
            ]);
            alert()->success('اعلانات', 'تم اضافة اعلان بنجاح');
            return redirect()->route('admin.advertisementUsers.index');
        }
    }

    public function destroy(Request $request)
    {
        $advertisementUser = AdvertisementUser::where('id', $request->id)->first();
        if ($advertisementUser) {
            ImageClass::delete($advertisementUser->image, 'categories');
            /*   $post = Wasfa::where('category_id', $request->id)->first();
            if ($post) {
                alert()->warning('تصنيف', 'هناك مقالات يجيب حذفها بالاول لانها مرتبطه بقسم');
                return redirect()->back();
            } */
            $advertisementUser->delete();
            alert()->warning('اقسام', 'تم حذف القسم بنجاح');

            return redirect()->route('admin.advertisementUsers.index');
        } else {
            alert()->error('اقسام', 'هناك خطا ما');
            return false;
        }
    }
}
