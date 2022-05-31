@extends('layouts.app')
@section('title')
<div class="app-title">
    <div>
        <h1><i class="fa fa-th-list"></i>المنتجات</h1>
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
                                <th class="border-bottom-0">اسم المنتجen </th>
                                <th class="border-bottom-0">الصورة </th>
                                <th class="border-bottom-0">رقم الجوال </th>
                                <th class="border-bottom-0"> اسم البائع </th>
                                <th class="border-bottom-0">القسم</th>
                                <th class="border-bottom-0">الحالة </th>
                                <th class="border-bottom-0">التصنيف </th>
                                <th class="border-bottom-0">مستخدم </th>
                                <th class="border-bottom-0">العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <td>{{$product->product_number}}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->name_en }}</td>
                                <td><img src="{{ asset('assets/products/'.$product->image) }}" width="100px" height="50px" /></td>
                                <td>{{ $product->phone }}</td>
                                <td>{{ $product->vendor_name }}</td>
                                <td>{{ $product->department->name??'' }}</td>
                                <td>{{ $product->status==1?'مفعل':'غير مفعل' }}</td>

                                <td>{{ $product->category->name }}</td>
                                <td>{{ $product->user->name }}</td>

                                <td>
                                    <a class="modal-effect btn btn-sm btn-info" href="{{route('admin.products.show',$product->id)}}" title="show"><i class="fa fa-eye"></i></a>
                                    <a class="modal-effect btn btn-sm btn-info" data-name="{{$product->name}}" data-id="{{ $product->id }}" data-toggle="modal" id="showEditModelCategory" href="javascript:void(0)" title="تعديل"><i class="fa fa-edit"></i></a>
                                    <a class="modal-effect btn btn-sm btn-danger" data-effect="effect-scale" data-id="{{ $product->id }}" data-name="{{ $product->name }}" data-toggle="modal" id="showDeleteModelSupervisors" href="javascript:void(0)" title="حذف"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$products->links()}}
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
                    <form action="{{route('admin.products.update')}}" method="post">
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

                                    <div class="col-md-12 mt-4">
                                        <label for="exampleInputEmail1">قسم</label>
                                        <select name="department" id="department">
                                            @foreach($departments as $department)
                                            <option value="{{$department->id}}">{{$department->name}}</option>
                                            @endforeach
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
                <h6 class="modal-title">حذف منتج</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{route('admin.products.destroy')}}" method="POST">
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
    $(() => {
        //edit
        $('body').on('click', '#showEditModelCategory', function() {
            var docotor_id = $(this).data('id');
            var docotor_name = $(this).data('name');
            var nutr_val = $(this).data('value');
            $.get('/admin/products/edit/' + docotor_id, function(data) {
                console.log(data);
                $('#editmodelNutrl').modal('show');
                $('#docotor_id').val(docotor_id);
                $('#docotor_name').val(docotor_name);
                $(`#status option[value='${data.status}']`).prop('selected', true);
                $(`#department option[value='${data.department_id}']`).prop('selected', true);
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