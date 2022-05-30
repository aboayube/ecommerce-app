@extends('layouts.app')
@section('title')
<div class="app-title">
    <div>
        <h1><i class="fa fa-th-list"></i>قيم متغيرة للمنتج </h1>
    </div>

</div>

@endsection
@section('content')
<style>
    .table-responsive {
        overflow-x: hidden;
        direction: rtl
    }

    .logo-website {
        width: 104%;
        height: 275px;
    }
</style>
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
<div class="container">
    <div class="row">
        <div class="col-xl-9">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="main-content-label mg-b-5 text-center">
                        اعدادات الخاصة بموقع
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <form action="{{route('admin.productdetialsInputs.update')}}" method="POST" class="text-center" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">اسم</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="input1" value="{{old('input1',$productdetialsInput->input1)}}" name="input1">
                                    @error('input1')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" value="{{old('input1_en',$productdetialsInput->input1_en)}}" name="input1_en">
                                    @error('input1_en')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <!-- =================== -->
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">اسم</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="input2" value="{{old('input2',$productdetialsInput->input2)}}" name="input2">
                                    @error('input2')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" value="{{old('input2_en',$productdetialsInput->input2_en)}}" name="input2_en">
                                    @error('input2_en')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <button class="btn btn-info">تعديل</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- row closed -->
    </div>
    <!-- Container closed -->
</div>
</div>
</div>
@endsection