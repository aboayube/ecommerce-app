<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\appevaluation;
use Illuminate\Http\Request;

class AppevaluationController extends Controller
{
    public function index()
    {
        $appevaluations = appevaluation::orderBy('id', 'DESC')->paginate(10);
        return view(
            'admin.appevaluation',
            compact(
                'appevaluations',
            )
        );
    }
    public function destroy(Request $request)
    {
        $appevaluation = appevaluation::where('id', $request->post('id'))->first();
        if ($appevaluation) {
            $appevaluation->delete();
            alert()->warning('تقييم المستخدمين', 'تم حذف سؤال بنجاح');
            return redirect()->route('admin.problems.index');
        } else {
            alert()->error('تقييم المستخدمين', 'هناك خطا ما');
            return false;
        }
    }
}
