<?php
$asset_path = URL::asset('public/assets');
?>
@extends('admin.app')


@section('content')


<div class="row">
<h3>Reply To Message From {{$msg->author ?? $msg->user->name}}</h3>
<form class="form-horizontal" method="POST" action="{{ route('messages.reply',$msg->id) }}">
    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="col-md-2 control-label" autocomplete="off">Reply</label>
        <div class="col-md-6">
            <textarea rows="5" id="name" type="text" class="form-control" name="reply" required></textarea>
        </div>
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary">
                {{__('Send Reply to Email')}}
            </button>
        </div>
    </div>
</form>
</div>
@endsection