@extends('layouts.app')
@section('content')

<!-- row -->
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="row">
    <div class="col-xl-12">
        <div class="card mg-b-20">

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered table-arabic" id="sampleTable">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">رقم المنتج</th>
                                <th class="border-bottom-0">اسم المنتج</th>
                                <th class="border-bottom-0">لون </th>
                                <th class="border-bottom-0">حجم </th>
                                <th class="border-bottom-0">الصورة </th>
                                <th class="border-bottom-0">{{$prodouctInput->input1}}</th>
                                <th class="border-bottom-0">{{$prodouctInput->input2}}</th>
                                <th class="border-bottom-0">الحالة </th>
                                <th class="border-bottom-0"> اسم البائع </th>
                                <th class="border-bottom-0">العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productdetails as $productdetail)
                            <tr>
                                <td>{{$productdetail->product->product_number}}</td>
                                <td>{{$productdetail->product->name}}</td>
                                <td>{{ $productdetail->color }}</td>
                                <td>{{ $productdetail->size }}</td>
                                <td><img src="{{ asset('assets/productdetails/'.$productdetail->image) }}" width="100px" height="50px" /></td>
                                <td>{{ $productdetail->measuring_value }}</td>
                                <td>{{ $productdetail->appearance_value }}</td>
                                <td>{{ $productdetail->status==1?'مفعل':'غير مفعل' }}</td>
                                <td>{{ $productdetail->user->name }}</td>

                                <td>
                                    <a class="modal-effect btn btn-sm btn-info" data-name="{{$productdetail->product->name}}" data-id="{{ $productdetail->id }}" data-toggle="modal" id="showEditModelCategory" href="javascript:void(0)" title="تعديل"><i class="fa fa-edit"></i></a>
                                    <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale" data-id="{{ $productdetail->id }}" data-name="{{ $productdetail->product->name }}" data-toggle="modal" id="showDeleteModelSupervisors" href="javascript:void(0)" title="حذف"><i class="fa fa-trash"></i></a>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$productdetails->links()}}
                    <div class="text-center">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal" id="editmodelNutrl">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title"> تعديل حاله</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.productdetails.update')}}" method="post">
                        @csrf
                        <input type="hidden" class="form-control" id="docotor_id" name="id">

                        <div class="form-group">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12 mt-4">
                                        <label for="exampleInputEmail1">status</label>
                                        <select name="status" id="status">
                                            <option value="0">غير فعال</option>
                                            <option value="1">فعال</option>
                                        </select>
                                        @error('status')
                                        <span class="btn btn-danger">{{$message}}</span>
                                        @enderror
                                    </div>

                                </div>
                                <hr>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">تاكيد</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                </div>
                </form>
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
            <form action="{{route('admin.productdetails.destroy')}}" method="POST">
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
</div>
</div>
@endsection
@push('scripts')
<script>
    //لما يروح الضغط عن اضهار العناصر
    $('#showElementModel').on('hidden.bs.modal', function(event) {
        $('#element_details').find('tbody tr').remove();
    })
    $(() => {
        //edit
        $('body').on('click', '#showEditModelCategory', function() {
            var docotor_id = $(this).data('id');
            var docotor_name = $(this).data('name');
            var nutr_val = $(this).data('value');
            $.get('/admin/productdetails/edit/' + docotor_id, function(data) {
                $('#editmodelNutrl').modal('show');
                $('#docotor_id').val(docotor_id);
                $('#docotor_name').val(docotor_name);
                $(`#status option[value='${data[0].status}']`).prop('selected', true);
                $(`#role option[value='${data[0].role}']`).prop('selected', true);
                // status
                // role


            });
        });
    })
    //لما يروح الضغط عن اضهار العناصر
    $('#showElementModel').on('hidden.bs.modal', function(event) {
        $('#element_details').find('tbody tr').remove();
    })
    // حذف

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