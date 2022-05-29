<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OnslashResource;
use App\Models\Onslash;
use Illuminate\Http\Request;

class OnlasheController extends Controller
{
    public function index($lang)
    {

        $this->set_Language($lang);
        $onslashes = Onslash::where('status', '1')->orderBy('id', 'DESC')->paginate(10);
        if ($onslashes->count() > 0) {
            return response()->json(['error' => false, 'data' => OnslashResource::collection($onslashes), 'status' => 200]);
        } else {
            return response()->json(['error' => true, 'message' => 'No wasfas found', 'status' => 200],);
        }
    }
}
