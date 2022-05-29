<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProblemsResource;
use App\Models\Problems;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class ProblemsControllers extends Controller
{
    public function sotre(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'problem'        => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => true, 'message' => $validator->errors()], 200);
        }
        $problems = Problems::create([
            'title' => $request->post('title'),
            'problem' => $request->post('problem'),
            'user_id' => auth()->id(),
        ]);
        if ($problems) {
            return response()->json(['errors' => false, 'message' => new ProblemsResource($problems), 'status' => 201]);
        } else {
            return response()->json(['errors' => true, 'message' => "return data error", 'status' => 404]);
        }
    }
}
