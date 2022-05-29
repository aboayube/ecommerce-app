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
                                <th class="border-bottom-0">اسم المنتج </th>
                                <th class="border-bottom-0">الصورة اعلان </th>
                                <th class="border-bottom-0"> فترة </th>
                                <th class="border-bottom-0"> نوع </th>
                                <th class="border-bottom-0">الحالة </th>
                                <th class="border-bottom-0">السعر </th>
                                <th class="border-bottom-0"> اسم البائع </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($advertisementUsers as $advertisementUser)
                            <tr>
                                <!--  ['price', 'image', 'period', 'status', 'user_id', 'product_id'] -->
                                <td>{{$advertisementUser->product->product_number}}</td>
                                <td>{{ $advertisementUser->product->name }}</td>
                                <td><img src="{{ asset('assets/advertisementUsers/'.$advertisementUser->image) }}" width="100px" height="50px" /></td>
                                <td>{{ $advertisementUser->period }}</td>
                                <td>{{ $advertisementUser->type }}</td>
                                <td>{{ $advertisementUser->status }}</td>
                                <td>{{ $advertisementUser->price}}</td>
                                <td>{{ $advertisementUser->user->name }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$advertisementUsers->links()}}
                    <div class="text-center">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- showElementModel -->
</div>
</div>
@endsection