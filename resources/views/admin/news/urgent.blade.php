@extends('admin.app')

@section('content')
	@include('admin.search_form')
	<div class="row">
	    <div class="col-sm-12">
	        <div class="white-box">
	            <h3 class="box-title" dir='rtl' style="text-align:right">الاخبار العاجلة</h3>
                                    
                                    
                        <table class="table table-hover table-bordered" dir="rtl">
	                    <thead>
	                        <tr>
	                            <th style="text-align: center;width:80%">عنوان الخبر</th>
	                            <th style="text-align: center;">اظهار/اخفاء</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    	@foreach($urgent_news as $new) 
	                        <tr id="tr{{$new->id}}">
	                            <td style="text-align: center;font-size: 16px">{{$new->translateOrNew('ar')->title}}</td>
	                            <td style="text-align: center;font-size: 16px"><input type="checkbox" class="changeStatus" id="{{$new->id}}" style="width: 20px;height: 20px;" {{$new->urgent == 1 ? "checked" : ""}}></td>
	                        </tr>
	                        @endforeach
	                        
	                    </tbody>
	                </table>

	        </div>
	    </div>
	</div>
{{$urgent_news->links()}}
@endsection

@section('after')
<script>
	$(document).ready(function(){
		$('.changeStatus').click(function(){

			var id = $(this).attr('id');
			$.ajax({
				url : "{{ route('news.urgent.change') }}",
				method : "GET",
				data : { 'id' : id },
				success : function(data){
				// 	location.reload();
				}
			});
			
		});
	});
</script>
@endsection