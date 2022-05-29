<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ImageClass;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterUserController extends Controller
{
    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'mobile' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => true, 'data' => 'somthing was error', 'status' => 200]);
        }
        $credentials = $request->only('mobile', 'password');
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            $data['user'] = new UserResource($user);
            $data['token'] = $user->createToken('my-app-token')->plainTextToken;
            return response()->json(['error' => false, 'data' => $data, "status" => 200]);
        } else {

            return response()->json(['error' => true, 'data' => "somthing is error", 'status' => 200]);
        } //end of else

    }
    //
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3|string',
            'name_en' => 'required|min:3|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'mobile' => 'required|numeric|min:10',
            'country' => 'required|string',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => 'true', 'message' => $validator->errors()->first(), 'status' => 200]);
        }
        $datauser =  $user = User::create([
            'name' => $request->post('name'),
            'name_en' => $request->post('name_en'),
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'mobile' => $request->mobile,
            'role' => 'user',
            'status' => '1',
            'country' => $request->post('country')
        ]);
        $user->assignRole('user');
        $data['user'] = new UserResource($datauser);
        $data['token'] = $user->createToken('my-app-token')->plainTextToken;

        return response()->json(['error' => false, 'data' => $data, 'status' => 200], 200);
    }
    public function respassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => 'required|numeric|min:10',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|min:6|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'true', 'message' => $validator->errors()->first(), 'status' => 200]);
        }
        $user = User::where('mobile', $request->mobile)->first();
        if ($user) {
            $user->password = bcrypt($request->password);
            $user->save();
            return response()->json(['error' => false, 'data' => 'password change successfully', 'status' => 200], 200);
        }
    }
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json(['error' => false, 'message' => 'logout successfuly', 'status' => 200]);
    }
}
