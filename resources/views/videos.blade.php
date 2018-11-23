<?php
$asset_path = URL::asset('public/assets');
$media_path = URL::asset('public/uploads/media');
$dir = ''; $lng =''; $align='';
$locale = session()->has('locale') ? session()->get('locale') : auth()->user()['language'];
if(empty($locale)){
  $locale = 'ar';
}
app()->setLocale($locale);
if (app()->getLocale() == 'ar') {
    $dir = 'rtl';
    $align='right';
    $lng = 'ar';
}else{
    $dir = 'ltr';
    $align='left';
    $lng = 'ru';
}
?>
@extends('layout')

@section('content')
  <!-- sticky header end --> 
  <!-- bage header Start -->

  <!-- bage header End --> 
  <!-- data Start -->
  <section>
    <div class="container ">
      <div class="row" dir="{{$dir}}"> 
        <!-- left sec Start -->
        <div class="row">
          @include('slider_video')
        </div>
@if(Auth::user())
<div class="row">
  <h2>اضافة فيديو جديد</h2>
  <form class="form-horizontal" method="POST" action="{{route('videos.post')}}" enctype="multipart/form-data">
                          {{ csrf_field() }}

                          <div dir="{{$dir}}" style="text-align:{{$align}}" class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                              <label for="name" class="control-label" autocomplete="off">{{_('العنوان (باللغة العربية)')}}</label><br>

                                  <input style="text-align:{{$align}}" id="title" type="text" class="form-control" name="title_ar" value="" autocomplete="off" required>

                                  @if ($errors->has(''))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('title') }}</strong>
                                      </span>
                                  @endif
                          </div>

                          <!-- <div dir="{{$dir}}" style="text-align:{{$align}}" class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                              <label style="text-align:{{$align}}" for="subject" class="control-label">{{_('نص الخبر (باللغة العربية)')}}</label><br>

                                  @if ($errors->has('body'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('body') }}</strong>
                                      </span>
                                  @endif
                                  <textarea id="summernote1" name="body_ar" style="text-align:{{$align}}" dir="{{$dir}}"></textarea>
                          </div> -->
                          <div dir="{{$dir}}" style="text-align:{{$align}}" class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                              <label for="name" class="control-label" autocomplete="off">{{_('العنوان (باللغة الروسية)')}}</label><br>

                                  <input style="text-align:left" dir="ltr" id="title" type="text" class="form-control" name="title_ru" value="" autocomplete="off" required>

                                  @if ($errors->has(''))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('title') }}</strong>
                                      </span>
                                  @endif
                          </div>

                          <!-- <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                              <label dir="{{$dir}}" style="text-align:{{$align}}" for="subject" class="control-label">{{_('نص الخبر (باللغة الروسية)')}}</label><br>

                                  @if ($errors->has('body'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('body') }}</strong>
                                      </span>
                                  @endif
                                  <textarea dir="ltr" style="direction: ltr;text-align:left" id="summernote2" name="body_ru"></textarea>
                          </div> -->

                          <div dir="{{$dir}}" style="text-align:{{$align}}" class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                              <label for="name" class="control-label" autocomplete="off">{{_('الفيديو')}}</label><br>

                                  <input style="text-align:left" dir="ltr" id="title" type="text" class="form-control" name="video_url" value="" autocomplete="off" required>
                          </div>

                        

                         
                          <div class="form-group text-center">
                                  <button type="submit" class="btn btn-primary">
                                      {{__('إضافة الفيديو')}}
                                  </button>
                          </div>
                      </form>


</div>

@endif




        
        <!-- Right Sec End --> 
      </div>
    </div>
  </section>
  <!-- Data End --> 
  @endsection
    
  <!-- Footer end -->
  
  @section('after')
  <!--jQuery easing--> 
  <script src="{{$asset_path}}/html5gallery/html5gallery.js"></script> 

  <script>
    $(document).ready(function(){
      setTimeout(function(){
        $('a[target="_blank"]').remove();
      },3000);
    });
  </script>
  
  @endsection