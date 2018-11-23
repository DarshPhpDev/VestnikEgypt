@extends('admin.app')

@section('content')

	<div class="row">
	    <div class="col-sm-12">
	        <div class="white-box">
	            <h3 class="box-title">Change User Role</h3>
	            <div class="table-responsive">
	                <table class="table table-striped table-bordered">
	                    <thead>
	                        <tr>
	                            <th style="text-align: center;">User Data</th>
	                            <th style="text-align: center;">Click to Choose New Role</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    	@foreach($users as $user)
	                        <tr>
	                            <td style="text-align: center;font-size: 16px; width: 450px">
	                            	<br>
	                            	{{$user->name}}
	                            	<br><br>
	                            	<span style="font-size: 16px" class="label label-info">{{$user->email}}</span>
	                            </td>
	                            <td class="text-center">
								<ul class="nav nav-pills nav-stacked">
									@foreach($roles as $key => $value)
						                <li class="{{$user->roles->first() ? ($key == $user->roles->first()->id ? 'active' : '') : ''}}"><a href="{{route('users.changerole',['userId'=>$user->id,'roleId'=>$key])}}">{{ucfirst($value)}}</a></li>
									@endforeach
				              	</ul>
	                            </td>
	                        </tr>
	                    	
	                        @endforeach
	                    </tbody>
	                </table>
	            </div>
	        </div>
	    </div>
	</div>
{{$users->links()}}
@endsection