@extends('layouts.app')
@section('title')
<div class="app-title">
    <div>
        <h1><i class="fa fa-th-list"></i>الوان المتاحة للمنتجات</h1>
    </div>

</div>

@endsection
@section('content')



<!-- row -->
<div class="row">
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">

                    <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">اضافة لون</a>
                </div>
            </div>
            <div class="card-body">
                <div class="tile-body">
                    <div class="table-responsive">
                        @foreach ($errors->all() as $error)
                        <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                        <table class="table table-hover table-bordered table-arabic" id="sampleTable">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>لون</th>
                                    <th>الحالة</th>
                                    <th>مستخدم</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($colors as $color)
                                <tr>
                                    <td>{{$loop->iteration }}</td>

                                    <td style="background-color:{{ $color->name }}">sad</td>
                                    <td>{{ $color->status ? 'مفعل':'غير مفعل'}}</td>

                                    <td>{{ $color->user->name }}</td>
                                    <td>
                                        @if($color->user_id==auth()->id() )
                                        <a class="modal-effect btn btn-sm btn-info" data-id="{{ $color->id }}" data-toggle="modal" id="showEditModelCategory" href="showEditModelCategory" title="تعديل"><i class="fa fa-edit"></i></a>
                                        <a class="modal-effect btn btn-sm btn-danger" data-id="{{ $color->id }}" data-name="{{$color->name}}" data-toggle="modal" id="showDeleteModelCategory" href="showDeleteModelCategory" title="حذف"><i class="fa fa-trash"></i></a>
                                        @endif
                                    </td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="text-center">
                    {{$colors->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="modaldemo8">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">اضافة قسم</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.colors.store')}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="exampleInputEmail1">اسم القسم</label>
                        <input type="color" class="form-control" id="color" name="color">
                    </div>



                    <div class="form-group">
                        <label for="exampleInputEmail1">حالة القسم</label>
                        <select class="form-control" name="status">
                            <option value="0">غير مفعل</option>
                            <option value="1">مفعل</option>

                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">تاكيد</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End Basic modal -->


</div>
<!-- edit -->

<div class="modal fade" id="categoryEditModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">تعديل لون</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{route('admin.colors.update')}}" method="POST" enctype="multipart/form-data">

                    @csrf
                    <input type="hidden" name="cat_id" id="cat_id">

                    <div class="form-group">
                        <label for="exampleInputEmail1">لون </label>
                        <input type="color" name="color" id="colorEdit">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">حالة لون</label>
                        <select class="form-control" name="status" id="status">
                            <option value="0">غير مفعل</option>
                            <option value="1">مفعل</option>

                        </select>
                    </div>



            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">تاكيد</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
            </div>
            </form>
        </div>
    </div>
</div>



<div class="modal" id="deleteCoateoryModel">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">حذف لون</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{route('admin.colors.delete')}}" method="POST">

                {{ csrf_field() }}
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




<!-- row closed -->
</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection

@push('scripts')

<script>
    $('body').on('click', '#showEditModelCategory', function() {
        var cat_id = $(this).data('id');
        $.get('/admin/colors/edit/' + cat_id, function(data) {
            $('#categoryEditModel').modal('show');
            $('#cat_id').val(data.id);
            $('#colorEdit').val(data.name);
            $(`#status option[value='${data.status}']`).prop('selected', true);
        })
    });
    $('body').on('click', '#showDeleteModelCategory', function() {
        var cat_id = $(this).data('id');
        var name = $(this).data('name');
        console.log(cat_id);
        $('#deleteCoateoryModel').modal('show');
        $('#cat_id_delete').val(cat_id);
        $('#delete_name').val(name);

    });


    function ColorToHex(color) {
        var hexadecimal = color.toString(16);
        return hexadecimal.length == 1 ? "0" + hexadecimal : hexadecimal;
    }

    function ConvertRGBtoHex(red, green, blue) {
        return "#" + ColorToHex(red) + ColorToHex(green) + ColorToHex(blue);
    }
    console.log(ConvertRGBtoHex(255, 100, 200));
</script>
@endpush