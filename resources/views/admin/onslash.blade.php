@extends('layouts.app')
@section('title')
<div class="app-title">
    <div>
        <h1><i class="fa fa-th-list"></i>شاشات Onslashs</h1>
    </div>

</div>

@endsection
@section('content')
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach

<!-- row -->
<div class="row">
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">

                    <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">اضافة شاشة</a>
                </div>
            </div>
            <div class="card-body">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-arabic" id="sampleTable">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>عنوان</th>
                                    <th>عنوان en</th>
                                    <th>وصف</th>
                                    <th>وصف en</th>
                                    <th>صورة</th>

                                    <th>مستخدم</th>
                                    <th>حالة</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($onslashs as $onslash)
                                <tr>
                                    <td>{{$loop->iteration }}</td>

                                    <td>{{ $onslash->title }}</td>
                                    <td>{{ $onslash->title_en }}</td>

                                    <td>{{ $onslash->description }}</td>
                                    <td>{{ $onslash->description_en }}</td>
                                    <td><img src="{{asset('assets/onslashes/'.$onslash->image)}}" width="100px" height="100px"></td>
                                    <td>{{ $onslash->user->name }}</td>
                                    <td>{{ $onslash->status ? 'مفعل':'غير مفعل'}}</td>
                                    <td>
                                        @if($onslash->user_id==auth()->id() )
                                        <a class="modal-effect btn btn-sm btn-info" data-id="{{ $onslash->id }}" data-toggle="modal" id="showEditModelCategory" href="showEditModelCategory" title="تعديل"><i class="fa fa-edit"></i></a>
                                        <a class="modal-effect btn btn-sm btn-danger" data-id="{{ $onslash->id }}" data-name="{{$onslash->title}}" data-toggle="modal" id="showDeleteModelCategory" href="showDeleteModelCategory" title="حذف"><i class="fa fa-trash"></i></a>
                                        @endif
                                    </td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="text-center">
                    {{$onslashs->links()}}
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
                <form action="{{route('admin.onslashs.store')}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="exampleInputEmail1">عنوان القسم</label>
                        <input type="text" class="form-control" id="" name="title">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">عنوان en</label>
                        <input type="text" class="form-control" id="" name="title_en">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">وصف القسم</label>
                        <textarea class="form-control" id="" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> en وصف القسم</label>
                        <textarea class="form-control" id="" name="description_en"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">صورة</label>
                        <input type="file" class="form-control" id="" name="image">
                    </div>
                    <label for="exampleInputEmail1">حالة القسم</label>
                    <select class="form-control" name="status" id="status">
                        <option value="0">غير مفعل</option>
                        <option value="1">مفعل</option>

                    </select>
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
                <h5 class="modal-title" id="exampleModalLabel">تعديل القسم</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{route('admin.onslashs.update')}}" method="POST" enctype="multipart/form-data">

                    @csrf
                    <input type="hidden" name="cat_id" id="cat_id">

                    <div class="form-group">

                        <label for="recipient-name" class="col-form-label">اسم القسم:</label>
                        <input class="form-control" name="title" id="name" type="text">
                    </div>
                    <div class="form-group">

                        <label for="recipient-name" class="col-form-label">اسم en:</label>
                        <input class="form-control" name="title_en" id="name_en" type="text">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">وصف القسم</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"> en وصف القسم</label>
                        <textarea class="form-control" id="description_en" name="description_en"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">صورة</label>
                        <input type="file" class="form-control" id="" name="image">
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="id" id="cat_id">
                        <label for="recipient-name" class="col-form-label">اسم القسم:</label>
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
                <h6 class="modal-title">حذف القسم</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{route('admin.onslashs.delete')}}" method="POST">

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
        $.get('/admin/onslashs/edit/' + cat_id, function(data) {
            $('#categoryEditModel').modal('show');
            $('#cat_id').val(data.id);
            $('#name').val(data.title);
            $('#name_en').val(data.title_en);
            $('#description').val(data.description);
            $('#description_en').val(data.description_en);
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
</script>
@endpush