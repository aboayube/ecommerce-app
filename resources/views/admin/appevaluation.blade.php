@extends('layouts.app')


@section('content')
<!-- row -->
<div class="row">
    <div class="col-xl-12">
        <div class="card mg-b-20">

            <div class="card-body">
                <div class="table-responsive">
                    <table id="example1" class="table key-buttons text-md-nowrap" data-page-length='50' style="text-align: center">
                        <thead>
                            <tr>
                                <th class="border-bottom-0">#</th>
                                <th class="border-bottom-0">مستخدم</th>
                                <th class="border-bottom-0">تقييم</th>
                                <th class="border-bottom-0">ملاحظات</th>
                                <th class="border-bottom-0">العمليات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($appevaluations as $appevaluation)
                            <tr>
                                <td>{{$loop->iteration }}</td>
                                <td>{{ $appevaluation->user->name }}</td>
                                <td>{{ $appevaluation->evaluation }}</td>
                                <td>{{ $appevaluation->note }}</td>
                                <td>
                                    @if(auth()->user()->role=='admin')
                                    <a class="modal-effect btn btn-sm btn-danger" id="deleteCoateory" data-effect="effect-scale" data-id="{{ $appevaluation->id }}" data-name="{{ $appevaluation->user->name }}" data-toggle="modal" href="deleteCoateory" title="حذف"><i class="fa fa-trash"></i></a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{$appevaluations->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>




    <div class="modal" id="deleteCoateoryModel">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content modal-content-demo">
                <div class="modal-header">
                    <h6 class="modal-title">حذف القسم</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form action="{{route('admin.appevaluations.delete')}}" method="POST">

                    {{ csrf_field() }}
                    <div class="modal-body">
                        <p>هل انت متاكد من عملية الحذف ؟</p><br>
                        <input type="hidden" name="id" id="delete_id" value="">
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
<!-- Internal Data tables -->
<script>
    $('body').on('click', '#deleteCoateory', function() {

        $('#deleteCoateoryModel').modal('show');
        var id = $(this).data('id')
        var name = $(this).data('name')
        console.log(name);
        console.log(name, id)
        $('#delete_id').val(id);
        $('#delete_name').val(name);
    })
</script>
@endpush