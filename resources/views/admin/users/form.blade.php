<?php
    if(Route::currentRouteName() == "users.create"){
        $url = 'users.store';
    }else{
        $url = 'users.update';
    }
?>
<form class="form-horizontal" method="POST" action="{{ $url == 'users.update' ? route($url,$user->id) : route($url) }}">
    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="col-md-4 control-label" autocomplete="off">Name</label>

        <div class="col-md-6">
            <input id="name" type="text" class="form-control" name="name" value="{{ isset($user) ? $user->name : "" }}" autocomplete="off" required>

            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email" class="col-md-4 control-label">E-Mail Address</label>

        <div class="col-md-6">
            <input id="email" type="email" class="form-control" name="email" value="{{ isset($user) ? $user->email : "" }}" autocomplete="off" required>

            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <label for="password" class="col-md-4 control-label">Password</label>

        <div class="col-md-6">
            <input id="password" type="password" class="form-control" name="password" autocomplete="off" required>

            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group">
        <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

        <div class="col-md-6">
            <input id="password-confirm" type="password" class="form-control" autocomplete="off" name="password_confirmation" required>
        </div>
    </div>
    <div class="form-group">
        <label for="password-confirm" class="col-md-4 control-label">Gender</label>
        <div class="col-md-6">
            <select class="form-control" name="gender">
                <option value="male">male</option>
                <option value="female">female</option>
            </select>
        </div>
    </div>
    @if(Route::currentRouteName() == "users.create")
    <div class="form-group">
        <label for="password-confirm" class="col-md-4 control-label">Role</label>

        <div class="col-md-6">
            <select class="form-control" name="role">
                @foreach($roles as $key => $value)
                    <option value="{{$key}}">{{$value}}</option>
                @endforeach
            </select>
        </div>
    </div>
    @endif
    <div class="form-group text-center">
        <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                {{isset($type) ?__('Update User') : __('Create User')}}
            </button>
        </div>
    </div>
</form>