@extends('admin.app')

@section('content')
	@include('admin.search_form')
	<div class="row">
	    <div class="col-sm-12">
	        <div class="white-box">
	            <h3 class="box-title">News</h3>
	            <div class="table-responsive">
	                <table class="table table-hover table-bordered" dir="rtl">
	                    <thead>
	                        <tr>
	                            <th style="text-align: center;">#</th>
	                            <th style="text-align: center;">عنوان</th>
	                            <th style="text-align: center;">موضوع</th>
	                            <th style="text-align: center;">الصنف</th>
	                            <th style="text-align: center;">الكاتب</th>
	                            <th style="text-align: center;">التاريخ</th>
	                            <th style="text-align: center;">خيارات</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    	<?php $i=1; ?>
	                    	@foreach($news as $new)
	                        <tr id="tr{{$new->id}}">
	                            <td style="text-align: center;font-size: 16px">{{$i}}</td>
	                            <td style="text-align: center;font-size: 16px">{{$new->translateOrNew('ar')->title}}</td>
	                            <td style="text-align: center;font-size: 16px">{!! strlen($new->translateOrNew('ar')->body) > 20 ? substr($new->translateOrNew('ar')->body,0,20) : $new->translateOrNew('ar')->body !!}</td>
	                            <td style="text-align: center;font-size: 16px">{{$new->category->translateOrNew('ar')->name}}</td>
	                            <td style="text-align: center;font-size: 16px">{{$new->author->name}}</td>
	                            <td style="text-align: center;font-size: 16px">{{$new->created_at ? $new->created_at->format('Y-m-d H:i:s') : ""}}</td>
	                            <td style="text-align: center;font-size: 16px">
	                            	@php

	                            	@endphp
	                            	<a href="{{route('news.edit',$new->id)}}" class="btn btn-info">تعديل</a>
									<a id="{{$new->id}}" class="btn deleteNews btn-danger">مسح</a>
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
{{$news->links()}}
@endsection

@section('after')
<script>
	$(document).ready(function(){
		$('.deleteNews').click(function(){
			if(confirm('Are you sure you want to delete this news?')){
				var id = $(this).attr('id');
				$.ajax({
					url : "{{ route('news.destroy') }}",
					method : "GET",
					data : { 'id' : id },
					success : function(data){
						if(data == "done"){
							$('#tr'+id).remove();
						}
					}
				});
			}
		});
	});
</script>
@endsection