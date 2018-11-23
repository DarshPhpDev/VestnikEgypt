@extends('admin.app')

@section('content')
	@include('admin.search_form')
	<div class="row">
	    <div class="col-sm-12">
	        <div class="white-box">
	            <h3 class="box-title">Users</h3>
	            <div class="table-responsive">
	                <table class="table table-hover">
	                    <thead>
	                        <tr>
	                            <th>#</th>
	                            <th>Name</th>
	                            <th>Email</th>
	                            <th>Role</th>
	                            <th>Actions</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    	<?php $i=1; ?>
	                    	@foreach($users as $user)
	                    	@if($user->id == 40)
	                    	    <?php continue; ?>
	                    	@endif
	                        <tr>
	                            <td style="font-size: 16px">{{$i}}</td>
	                            <td style="font-size: 16px">{{$user->name}}</td>
	                            <td style="font-size: 16px">{{$user->email}}</td>
	                            <td style="font-size: 16px">{{$user->roles->first()?$user->roles->first()->display_name : ""}}</td>
	                            <td>
	                            	@if($user->id != 1)
									<a href="{{route('users.edit',$user->id)}}" class="btn btn-info">Edit</a>
									<a href="{{route('users.block',$user->id)}}" class="btn {{$user->blocked == 0 ? "btn-warning" : "btn-success"}}">{{$user->blocked == 0 ? __('Block') : __('UnBlock')}}</a>
									<a href="{{route('users.destroy',$user->id)}}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
									@endif
	                            </td>
	                        </tr>
	                    	<?php $i++; ?>
	                        @endforeach
	                    </tbody>
	                </table>
	            </div>
	        </div>
	    </div>
	</div>
{{$users->links()}}
@endsection