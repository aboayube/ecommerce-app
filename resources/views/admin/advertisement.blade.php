@extends('layouts.app')
@section('title')
<div class="app-title">
    <div>
        <h1><i class="fa fa-th-list"></i> اعلانات</h1>
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

                    <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">اضافة اعلان</a>
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
                                    <th>نوع</th>
                                    <th>فترة</th>
                                    <th>سعر</th>
                                    <th>مستخدم</th>
                                    <th>حالة</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($advertisements as $advertisement)
                                <tr>
                                    <td>{{$loop->iteration }}</td>
                                    <td>{{ $advertisement->type }}</td>
                                    <td>{{ $advertisement->period }}</td>
                                    <td>{{ $advertisement->price }}</td>
                                    <td>{{ $advertisement->user->name }}</td>
                                    <td>{{ $advertisement->status ? 'مفعل':'غير مفعل'}}</td>
                                    <td>
                                        @if($advertisement->user_id==auth()->id() )
                                        <a class="modal-effect btn btn-sm btn-info" data-id="{{ $advertisement->id }}" data-toggle="modal" id="showEditModelCategory" href="showEditModelCategory" title="تعديل"><i class="fa fa-edit"></i></a>
                                        <a class="modal-effect btn btn-sm btn-danger" data-id="{{ $advertisement->id }}" data-name="{{$advertisement->period}}" data-toggle="modal" id="showDeleteModelCategory" href="showDeleteModelCategory" title="حذف"><i class="fa fa-trash"></i></a>
                                        @endif
                                    </td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="text-center">
                    {{$advertisements->links()}}
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal" id="modaldemo8">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">اضافة اعلان</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.advertisements.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputEmail1">type</label>
                        <select class="form-control" id="" name="type">
                            <option value="1"> صفحة رئيسية</option>
                            <option value="2">اعلان </option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">period</label>
                        <input type="text" class="form-control" id="" name="period">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">price</label>
                        <input type="text" class="form-control" id="" name="price">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">حالة القسم</label>
                        <select class="form-control" name="status" id="status">
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
                <h5 class="modal-title" id="exampleModalLabel">تعديل اعلان</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="{{route('admin.advertisements.update')}}" method="POST" enctype="multipart/form-data">

                    @csrf
                    <input type="hidden" name="cat_id" id="cat_id">

                    <div class="form-group">
                        <label for="exampleInputEmail1">type</label>
                        <select class="form-control" id="type" name="type">
                            <option value="1"> صفحة رئيسية</option>
                            <option value="2">اعلان </option>
                        </select>
                    </div>
                    <div class="form-group">

                        <label for="recipient-name" class="col-form-label">period</label>
                        <input class="form-control" name="period" id="period" type="text">
                    </div>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">price</label>
                        <input class="form-control" name="price" id="price" type="text">

                    </div>
                    <div class="form-group">
                        <input type="hidden" name="id" id="cat_id">
                        <label for="recipient-name" class="col-form-label">اسم اعلان:</label>
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
            <form action="{{route('admin.advertisements.delete')}}" method="POST">

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
        $.get('/admin/advertisements/edit/' + cat_id, function(data) {
            $('#categoryEditModel').modal('show');
            $('#cat_id').val(data.id);
            $('#type').val(data.type);
            $('#period').val(data.period);
            $('#price').val(data.price);
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