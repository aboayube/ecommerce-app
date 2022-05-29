<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReviewSalers;
use Illuminate\Http\Request;

class ReviewSalersController extends Controller
{
    //
    function __construct()
    {
        /*      $this->middleware('permission:wasfas-index', ['only' => ['index']]);
        $this->middleware('permission:wasfas-store', ['only' => ['store']]);
        $this->middleware('permission:wasfas-edit', ['only' => ['edit']]);
        $this->middleware('permission:wasfas-update', ['only' => ['update']]);
        $this->middleware('permission:wasfas-delete', ['only' => ['destroy']]);
 */
    }
    public function index()
    {
        $reviewsalers = ReviewSalers::orderBy('id', 'DESC')->with(['user', 'product'])->paginate(10);
        return view('admin.reviewsalers', compact('reviewsalers'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $review = ReviewSalers::where('id', $request->id)->first();
        $review->delete();
        alert()->warning('وصفات', 'تم حذف وصفات بنجاح');
        return redirect()->route('admin.reviewsalers.index');
    }
}
