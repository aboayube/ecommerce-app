<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AppevaluationResource;
use App\Models\appevaluation;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class AppevaluationController extends Controller
{
    public function sotre(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'evaluation' => 'required',
            'note'        => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => true, 'message' => $validator->errors()], 200);
        }
        $evaluation = appevaluation::create([
            'evaluation' => $request->post('evaluation'),
            'note' => $request->post('note'),
            'user_id' => auth()->id(),
        ]);
        if ($evaluation) {
            return response()->json(['errors' => false, 'message' => new AppevaluationResource($evaluation), 'status' => 201]);
        } else {
            return response()->json(['errors' => true, 'message' => "return data error", 'status' => 404]);
        }
    }
}
