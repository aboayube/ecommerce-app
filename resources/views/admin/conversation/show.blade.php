@foreach($messages as $msg)
{{$msg->message}}
{{$msg->to_id}}
{{$from_id =$msg->from_id}}
{{$msg->conversation_id}}

@endforeach


<form action="{{route('admin.conversations.store')}}" method="post">
    @csrf
    <div class="form-group">
        <label for="message">Message</label>
        <textarea name="message" id="message" cols="30" rows="10" class="form-control"></textarea>
    </div>
    <input type="hidden" name="from_id" value="{{$from_id }}" />
    <input type="hidden" name="conversation_id" value="{{$id}}" />

    <button type="submit" class="btn btn-primary">Submit</button>