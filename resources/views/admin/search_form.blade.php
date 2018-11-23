<?php $url=Route::currentRouteName(); ?>
<div class="input-group pull-right" style="display: inline-block;width:275px;">
    {!! Form::open(['method' => 'GET', 'url' => route($url) , 'class' => 'navbar-form navbar-right','style'=>'width:310px;margin:0;'])  !!}   
        <input type="text"  class="form-control" autocomplete="off" name="search" value="{{isset($keyword)? $keyword : ''}}" placeholder="{{__('Search')}}...">
        <span class="input-group-btn">
            <button class="btn btn-default" type="submit">
                <i class="fa fa-search"></i>
            </button>
        </span>
    {!! Form::close() !!}
</div>