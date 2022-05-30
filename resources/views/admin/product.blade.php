@extends('layouts.app')
@section('title')
<div class="app-title">
    <div>
        <h1><i class="fa fa-th-list"></i>المنتج {{$product->name}}</h1>
    </div>

</div>

@endsection
@section('content')
<main class="app-content">
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <section class="invoice">
                    <div class="row mb-4">
                        <div class="col-6">
                            <h2 class="page-header"><i class="fa fa-globe"></i> {{$product->name()}}</h2>
                        </div>
                        <div class="col-6">
                            <h5 class="text-right">Date:{{$product->created_at}}</h5>
                        </div>
                    </div>
                    <div class="row invoice-info">
                        <img src="{{asset('assets/products/'.$product->image)}}" width="100px" height="50px" />
                        {{$product->discription()}}<br><br>
                        <span>{{$product->count}}</span><br><br>
                        <span>{{$product->vendor_name}}</span><br><br>
                        <span>{{$product->city}}</span><br><br>
                        <span>{{$product->phone}}</span><br><br>
                        <span>{{$product->whatsapp}}</span><br><br>
                        <span>{{$product->type}}</span><br><br>
                        <span>{{$product->category->name}}</span><br><br>
                        <span>{{$product->department->name}}</span><br><br>
                        <span>{{$product->product_number}}</span><br><br>

                        <p>url <a href="{{$product->url}}">view<a></p>
                    </div>
                    <div class="row">
                        <div class="col-12 table-responsive">
                            <h1>Prouduct details</h1>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>color</th>
                                        <th>size</th>
                                        <th>image</th>
                                        <th>status</th>
                                        <th>measuring</th>
                                        <th>measuring_value</th>
                                        <th>appearance</th>
                                        <th>appearance_value</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @foreach ($product->productdetails as $details)
                                        <td>{{$details->id}}</td>
                                        <td>{{$details->color}}</td>
                                        <td>{{$details->size}}</td>
                                        <td><img src="{{asset('assets/images/'.$details->image)}}"></td>
                                        <td>{{$details->status}}</td>
                                        <td>{{$details->measuring}}</td>
                                        <td>{{$details->measuring_value}}</td>
                                        <td>{{$details->appearance}}</td>
                                        <td>{{$details->appearance_value}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="col-12 table-responsive">
                            <h1>Prouduct price</h1>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>sentence_price</th>
                                        <th>price</th>
                                        <th>now_price</th>
                                        <th>old_price</th>
                                        <th>delivery_service</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @foreach ($product->prices as $price)
                                        <td>{{$price->id}}</td>
                                        <td>{{$price->sentence_price}}</td>
                                        <td>{{$price->price}}</td>
                                        <td>{{$price->now_price}}</td>
                                        <td>{{$price->old_price}}</td>
                                        <td>{{$price->delivery_service}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>


                        <div class="col-12 table-responsive">
                            <h1>Prouduct review</h1>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>evaluation</th>
                                        <th>note</th>
                                        <th>user_id</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @foreach ($product->rattingProdut as $rating)
                                        <td>{{$rating->id}}</td>
                                        <td>{{$rating->evaluation}}</td>
                                        <td>{{$rating->note}}</td>
                                        <td>{{$rating->user->name}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row d-print-none mt-2">
                        <div class="col-12 text-right"><a class="btn btn-primary" href="javascript:window.print();" target="_blank"><i class="fa fa-print"></i> Print</a></div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</main>

@endsection