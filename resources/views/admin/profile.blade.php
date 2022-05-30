@extends('layouts.app')
@section('title')
<div class="app-title">
    <div>
        <h1><i class="fa fa-th-list"></i>تعديل بيانات حساب شخصي</h1>
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

        <div class="col-xl-3">
            @if(isset($user->image))
            <img width="100" height="200" class="logo-website" src="{{asset('assets/users/'.$user->image)}}">
            @endif
        </div>
        <div class="col-xl-9">
            <div class="card mg-b-20">
                <div class="card-header pb-0">
                    <div class="main-content-label mg-b-5 text-center">
                        profile
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <form action="{{route('admin.profile.update')}}" method="POST" class="text-center" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">اسم</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" value="{{old('name',$user->name)}}" name="name">
                                    @error('name')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" value="{{old('name_en',$user->name_en)}}" name="name_en">
                                    @error('name_en')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="password" name="password">
                                    @error('password')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="country" class="col-sm-2 col-form-label">country</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="country" value="{{old('country',$user->country)}}" name="country">
                                    @error('country')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="mobile" class="col-sm-2 col-form-label">mobile</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="mobile" value="{{old('mobile',$user->mobile)}}" name="mobile">
                                    @error('mobile')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="image" class="col-sm-2 col-form-label">شعار الموقع</label>
                                <div class="col-sm-10">
                                    <input type="file" name="image">
                                    @error('image')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="whatsapp" class="col-sm-2 col-form-label">whatsapp</label>
                                <div class="col-sm-10">
                                    <select class="form-control" id="status" name="status">
                                        <option value="1" {{$user->status == 1 ? 'selected' : ''}}>مفعل</option>
                                        <option value="0" {{$user->status == 0 ? 'selected' : ''}}>غير مفعل</option>
                                    </select>
                                    @error('whatsapp')
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