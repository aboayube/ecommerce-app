@extends('layouts.app')
@section('title')
<div class="app-title">
    <div>
        <h1><i class="fa fa-th-list"></i>تقييم البائعين</h1>
    </div>

</div>

@endsection
@section('content')
<div class="row">
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-arabic" id="sampleTable">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">رقم المنتج</th>
                                <th class="border-bottom-0">اسم المنتج </th>
                                <th class="border-bottom-0">صورة </th>
                                <th class="border-bottom-0">تقييم </th>
                                <th class="border-bottom-0">ملاحظات </th>
                                <th class="border-bottom-0"> بائع </th>
                                <th class="border-bottom-0"> مستخدم </th>
                                <th class="border-bottom-0"> عمليات </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reviewsalers as $review)
                            <td>{{$review->product->product_number}}</td>
                            <td>{{ $review->product->name }}</td>
                            <td><img src="{{ asset('assets/products/'.$review->product->image) }}" width="100px" height="50px" /></td>
                            <td>{{ $review->note }}</td>
                            <td>{{ $review->evaluation }}</td>
                            <td>{{ $review->salers->name }}</td>
                            <td>{{ $review->user->name }}</td>

                            <td> <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale" data-id="{{ $review->id }}" data-name="{{ $review->note }}" data-toggle="modal" id="showDeleteModelSupervisors" href="javascript:void(0)" title="حذف"><i class="fa fa-trash"></i></a>

                            </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$reviewsalers->links()}}
                    <div class="text-center">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
<div class="modal" id="deleteCoateoryModel">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">حذف بائع</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{route('admin.reviewproducts.delete')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <p>هل انت متاكد من عملية الحذف ؟</p><br>
                    <input type="hidden" name="id" id="cat_id_delete" value="">
                    <input class="form-control" name="name" id="delete_name" type="text" readonly>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                    <button type="submit" class="btn btn-danger">تاكيد</button>
                </div>
        </div>
        </form>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $('body').on('click', '#showDeleteModelSupervisors', function() {
        var cat_id = $(this).data('id');
        var name = $(this).data('name');
        console.log("🚀 ~ file: supervisors.blade.php ~ line 291 ~ $ ~ name", cat_id)
        $('#deleteCoateoryModel').modal('show');
        $('#cat_id_delete').val(cat_id);
        $('#delete_name').val(name);

    });
</script>
@endpush