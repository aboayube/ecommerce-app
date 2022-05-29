<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Problems;
use Illuminate\Http\Request;

class ProblemsController extends Controller
{
    public function index()
    {
        $problems = Problems::orderBy('id', 'DESC')->paginate(10);
        return view(
            'admin.problems',
            compact(
                'problems',
            )
        );
    }
    public function destroy(Request $request)
    {
        $problems = Problems::where('id', $request->post('id'))->first();
        if ($problems) {
            $problems->delete();
            alert()->warning('اسئلة شائعة', 'تم حذف سؤال بنجاح');
            return redirect()->route('admin.problems.index');
        } else {
            alert()->error('اسئلة الشائعة', 'هناك خطا ما');
            return false;
        }
    }
}
