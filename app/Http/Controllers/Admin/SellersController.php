<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Models\vendor;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class SellersController extends Controller
{
    function __construct()
    {
        /*      $this->middleware('permission:users-index', ['only' => ['index']]);
        $this->middleware('permission:users-edit', ['only' => ['edit']]);
        $this->middleware('permission:users-show', ['only' => ['show']]);
        $this->middleware('permission:users-update', ['only' => ['update']]);
        $this->middleware('permission:users-delete', ['only' => ['destroy']]);
   */
    }
    public function index(Request $request)
    {

        $data = User::orderBy('id', 'DESC')->where('role', 'seller')->paginate(5);

        return view('admin.users.sallers', compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    public function edit($id)
    {
        $user = User::whereId($id)->select('status')->first();
        return Response::json($user);
    }
    public function update(Request $request)
    {
        $user = User::find($request->id);

        $validator = Validator::make($request->all(), [
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            \Alert::error('مستخدمين', 'هناك خطا');

            return redirect()->back()->withErrors($validator);
        }

        $user->update([
            'status' => $request->post('status'),
        ]);
        \Alert::success('مستخدمين', 'تم التعديل بنجاح');


        return redirect()->route('admin.sellers.index');
    }

    public function show($id)
    {
        $user = User::whereId($id)->where('role', 'seller')->first();

        if ($user) {
            $data = vendor::where('user_id', $id)->first();
            if ($data) {
                return Response::json($data);
            } else {
                return false;
            }
        }
        return false;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        User::find($request->id)->delete();
        return redirect()->route('admin.sallers.index');
    }
}
