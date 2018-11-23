@extends('admin.app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">{{__('Edit ') . $user->name}}</div>

                <div class="panel-body">
                    @include('admin.users.form',['type'=>'update'])
                </div>
            </div>
        </div>
    </div>

@endsection