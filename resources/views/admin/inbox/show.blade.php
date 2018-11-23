@extends('admin.app')


@section('content')



<div class="row">


	<div class="table-responsive">
	                <table class="table table-hover table-bordered">
	                    <thead>
	                        <tr>
	                            <th style="text-align: center;">Author</th>
	                            <th style="text-align: center;">Time</th>
	                            <th style="text-align: center;">Title</th>
	                            <th style="text-align: center;">Body</th>
	                            <th style="text-align: center;">Actions</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	             
	                        <tr>
	                            <td style="text-align: center;font-size: 16px">{{$message->user_id ? $message->user->name : 'Visitor'}}</td>
	                            <td style="text-align: center;font-size: 16px">{{$message->created_at}}</td>
	                            <td style="text-align: center;font-size: 16px">{{$message->title}}</td>
	                            <td style="text-align: center;font-size: 14px">{{$message->body}}</td>
	                            <td style="text-align: center;font-size: 16px">
									<a class="btn deleteNews btn-danger" href="{{route('messages.destroy',$message->id)}}" onclick="return confirm('Are you sure you want to delete this message?');">Delete Message</a>
									<a class="btn deleteNews btn-default" href="{{route('messages.inbox')}}">Back to inbox</a>
									<a class="btn btn-primary" href="{{route('messages.reply',$message->id)}}" class="pull-right">reply to Message</a>
	                            </td>
	                        </tr>
	            
	                    </tbody>
	                </table>
	            </div>

</div>

@endsection
