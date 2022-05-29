<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\ImageClass;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Purify\Facades\Purify;

class ProfileController extends Controller
{
    function __construct()
    {
        /*   $this->middleware('permission:settings-index', ['only' => ['index']]);
        $this->middleware('permission:settings-update', ['only' => ['update']]);
 */
    }
    public function index()
    {
        $user = auth()->user();
        return view('admin.profile', compact('user'));
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'name_en' => 'required',
            'image' => 'nullable|image',
            'country' => 'required',
            'mobile' => 'required',
        ]);
        if ($validator->fails()) {
            alert()->error('profile', 'هناك خطا ما');

            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user = User::whereId(auth()->id())->first();

        $data['name'] = $request->post('name');
        $data['name_en'] = $request->post('name_en');
        $data['country'] = $request->post('country');
        $data['mobile'] = $request->post('mobile');

        $user->update($data);
        $file = $request->image;
        if ($request->password) {
            $pass = bcrypt($request->password);
            $user->update(['password' => $pass]);
        }
        if ($request->image) {
            $image =  ImageClass::update($file, $user->image, 'users');
            $user->update([
                'image' => $image
            ]);
        }
        alert()->success('profile', 'تم  تعديل اعدادات الموقع بنجاح');

        return redirect()->route('admin.profile.index');
    }
    //
}
