@extends('layouts.app')
@section('title')
<div class="app-title">
    <div>
        <h1><i class="fa fa-th-list"></i>عمليات شراء المستخدمين</h1>
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
                                <th class="border-bottom-0">صورة </th>
                                <th class="border-bottom-0">لون </th>
                                <th class="border-bottom-0">حجم </th>
                                <th class="border-bottom-0"> كمية </th>
                                <th class="border-bottom-0"> سعر </th>
                                <th class="border-bottom-0">الحالة </th>
                                <th class="border-bottom-0">مستخدم </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productusers as $productuser)
                            <tr>
                                <td>{{$productuser->product->product_number}}</td>
                                <td>{{ $productuser->product->name }}</td>
                                <td><img src="{{ asset('assets/products/'.$productuser->product->image) }}" width="100px" height="50px" /></td>
                                <td>{{ $productuser->color }}</td>
                                <td>{{ $productuser->size }}</td>
                                <td>{{ $productuser->countity }}</td>
                                <td>{{ $productuser->price }}</td>
                                <td>{{ $productuser->status }}</td>
                                <td>{{ $productuser->user->name }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$productusers->links()}}
                    <div class="text-center">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection