@extends('layouts.app')
@section('title')
<div class="app-title">
    <div>
        <h1><i class="fa fa-th-list"></i>المحادثات</h1>
    </div>
</div>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <h3 class="tile-title">Chat</h3>
            <div class="messanger">
                <div class="messages">
                    @foreach($messages as $msg)
                    @php
                    $from_id = $msg->from_id;
                    dd($from_id)
                    @end

                    @if($msg->from_id == auth()->id())
                    <div class="message"><img src="{{asset('assets/users/'.$msg->from->image)}}" width="50px" height="50px">
                        <p class="info">{{$msg->message}}</p>
                    </div>
                    @else
                    <div class="message me"><img src="{{asset('assets/users/'.auth()->user()->image)}}" width="50px" height="50px">
                        <p class="info">{{$msg->message}}</p>
                    </div>
                    @endif
                    @endforeach

                </div>
                <form action="{{route('admin.conversations.store')}}" method="post">
                    @csrf
                    <div class="sender">


                        <input type="hidden" name="conversation_id" value="{{$id}}" />
                        <input type="hidden" name="from_id" value="{{$from_id }}" />
                        <input type="text" placeholder="Send Message" name="message">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-lg fa-fw fa-paper-plane"></i></button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection