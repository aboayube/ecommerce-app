@extends('layouts.app')
@section('title')
<div class="app-title">
    <div>
        <h1><i class="fa fa-th-list"></i>المحادثات</h1>
    </div>

</div>

@endsection
@section('content')

<!-- row -->
<div class="row">
    <div class="col-xl-12">
        <div class="card mg-b-20">
            <div class="card-header pb-0">
            </div>
            <div class="card-body">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-arabic" id="sampleTable">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>اسم مستخدم</th>
                                    <th>صورة المستخدم</th>
                                    <th>الرسالة </th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($messages as $message)
                                <tr>
                                    <td>{{$loop->iteration }}</td>
                                    <td>{{ $message->from->name }}</td>
                                    <td><img src="{{asset('assets/users/'.$message->from->image)}}" width="100px" height="100px"></td>
                                    <td>{{ $message->message }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-info" href="{{route('admin.conversations.show',$message->id)}}" title="رد"><i class="fa fa-edit"></i></a>
                                    </td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="text-center">
                    {{$messages->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection