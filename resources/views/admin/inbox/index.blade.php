<?php
$asset_path = URL::asset('public/assets');
?>
@extends('admin.app')


@section('content')


<div class="row">
  <div class="list-group">
    @foreach($messages as $message)
      <span href="{{route('messages.show',$message->id)}}" class="list-group-item"><strong>{{$message->user_id ? $message->user->name : 'Visitor'}}</strong> : {{$message->title}} <br>Email: {{$message->email}} <br>Seen: @if($message->seen == 1) <img src="{{$asset_path}}/images/seen.png" width="12" height="12"> @endif
    <a href="{{route('messages.show',$message->id)}}" class="pull-right">View Message</a>
    
    </span>
      

    @endforeach
  </div>
</div>
@endsection