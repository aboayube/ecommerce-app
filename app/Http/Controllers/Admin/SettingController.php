<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageClass;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Stevebauman\Purify\Facades\Purify;


class SettingController extends Controller
{
    function __construct()
    {
        /*   $this->middleware('permission:settings-index', ['only' => ['index']]);
        $this->middleware('permission:settings-update', ['only' => ['update']]);
 */
    }
    public function index()
    {
        $setting = Setting::first();
        return view('admin.setting', compact('setting'));
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'name_en' => 'required',
            'discription' => 'required',
            'discription_en' => 'required',
            'logo' => 'nullable|image',
            'email' => 'required',
            'status' => 'required',
            'facebook' => 'required',
            'twiter' => 'required',
            'linked_in' => 'required',
            'instagram' => 'required',
            'whatsapp' => 'required',
            'address' => 'required',
            'terms' => 'required',
            'terms_en' => 'required',
            'who_us' => 'required',
            'who_us_en' => 'required',
        ]);
        if ($validator->fails()) {
            alert()->error('تصنيفات', 'هناك خطا ما');

            return redirect()->back()->withErrors($validator)->withInput();
        }
        $setting = Setting::where('id', 1)->first();

        $data['name'] = $request->post('name');
        $data['name_en'] = $request->post('name_en');
        $data['discription'] = Purify::clean($request->post('discription'));
        $data['discription_en'] = Purify::clean($request->post('discription_en'));
        $data['email'] = $request->post('email');
        $data['facebook'] = $request->post('facebook');
        $data['twiter'] = $request->post('twiter');
        $data['linked_in'] = $request->post('linked_in');
        $data['instagram'] = $request->post('instagram');
        $data['whatsapp'] = $request->post('whatsapp');
        $data['address'] = $request->post('address');
        $data['status'] = $request->post('status');
        $data['terms'] = $request->post('terms');
        $data['terms_en'] = $request->post('terms_en');
        $data['who_us'] = $request->post('who_us');
        $data['who_us_en'] = $request->post('who_us_en');
        $setting->update($data);
        $file = $request->image;
        if ($request->image) {
            $image =  ImageClass::update($file, $setting->image, 'setting');
            $setting->update([
                'image' => $image
            ]);
        }
        alert()->success('اعدادات', 'تم  تعديل اعدادات الموقع بنجاح');

        return redirect()->route('admin.settings.index');
    }
}
