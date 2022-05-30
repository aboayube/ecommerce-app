@extends('layouts.app')
@section('title')
<div class="app-title">
    <div>
        <h1><i class="fa fa-th-list"></i>عمليات الدفع داخل التطبيق</h1>
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
                                <th class="border-bottom-0">نوع العملية </th>
                                <th class="border-bottom-0">الصورة </th>
                                <th class="border-bottom-0"> سعر </th>
                                <th class="border-bottom-0"> نوع </th>
                                <th class="border-bottom-0">الحالة </th>
                                <th class="border-bottom-0">مستخدم </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $payment)
                            <tr>
                                <td>{{$payment->product->product_number}}</td>
                                <td>{{ $payment->product->name }}</td>
                                <td>{{ $payment->payment_type }}</td>
                                <td><img src="{{ asset('assets/products/'.$payment->product->image) }}" width="100px" height="50px" /></td>
                                <td>{{ $payment->price }}</td>
                                <td>{{ $payment->type }}</td>
                                <td>{{ $payment->status }}</td>
                                <td>{{ $payment->user->name }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$payments->links()}}
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