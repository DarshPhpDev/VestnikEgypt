<?php
$asset_path = URL::asset('public/assets');
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
  <div class="container">
    <div dir="{{$dir}}" style="text-align:{{$align}}" class="page-header">
        <!-- title of post --> 
      <h1>{{_('تعديل الخبر')}}</h1>
    </div>
  </div>
  <!-- bage header End --> 
  <!-- data Start -->
  <section>
    <div class="container ">
      <div class="row">
              <div class="panel panel-default">
                  <div class="panel-body">
                      <form class="form-horizontal" method="POST" action="{{route('post.update',$post->id)}}" enctype="multipart/form-data">
                          {{ csrf_field() }}

                          <div dir="{{$dir}}" style="text-align:{{$align}}" class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                              <label for="name" class="control-label" autocomplete="off">{{_('العنوان (باللغة العربية)')}}</label><br>

                                  <input style="text-align:{{$align}}"  type="text" class="form-control" name="subject_ar" value="{{ $post->translate('ar')? $post->translate('ar')->title : "" }}" autocomplete="off" >

                                  @if ($errors->has(''))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('title') }}</strong>
                                      </span>
                                  @endif
                          </div>

                          <div dir="{{$dir}}" style="text-align:{{$align}}" class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                              <label style="text-align:{{$align}}" for="subject" class="control-label">{{_('نص الخبر (باللغة العربية)')}}</label><br>

                                  @if ($errors->has('body'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('body') }}</strong>
                                      </span>
                                  @endif
                                  <textarea id="editor1" name="body_ar" style="text-align:{{$align}}" dir="{{$dir}}">{!! $post->translate('ar')!= null ? $post->translate('ar')->body :"" !!}</textarea>
                          </div>
                          <div dir="{{$dir}}" style="text-align:{{$align}}" class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                              <label for="name" class="control-label" autocomplete="off">{{_('العنوان (باللغة الروسية)')}}</label><br>

                                  <input style="text-align:left" dir="ltr"  type="text" class="form-control" name="subject_ru" value="{{ $post->translate('ru')? $post->translate('ru')->title :"" }}" autocomplete="off" >

                                  @if ($errors->has(''))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('title') }}</strong>
                                      </span>
                                  @endif
                          </div>

                          <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                              <label dir="{{$dir}}" style="text-align:{{$align}}" for="subject" class="control-label">{{_('نص الخبر (باللغة الروسية)')}}</label><br>

                                  @if ($errors->has('body'))
                                      <span class="help-block">
                                          <strong>{{ $errors->first('body') }}</strong>
                                      </span>
                                  @endif
                                  <textarea dir="ltr" style="direction: ltr;text-align:left" id="editor2" name="body_ru">{!! $post->translate('ru')? $post->translate('ru')->body : "" !!}</textarea>
                          </div>

                          <div dir="{{$dir}}" class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                              <label style="text-align:{{$align}}" for="subject" class="control-label">{{_('صنف الخبر')}}</label><br>

                                  <select name="category_id" class="form-control">
                                    @foreach($cats as $value)
                                        <option value="{{$value->id}}" {{$value->id == $post->category->id ? "selected" : "" }} >{{$value->translate('ar')->name}}</option>
                                    @endforeach
                                  </select>
                          </div>

                          <div dir="{{$dir}}" style="text-align:{{$align}}" class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                              <label for="name" class="control-label" autocomplete="off">{{_('صورة الخبر الرئيسية')}}</label><br>

                                  <input style="text-align:{{$align}}" type="file" class="form-control" name="main_image" value="" autocomplete="off" required>
                          </div>

                          @if(Auth::user()->can('manage-users') || Auth::user()->can('edit-news'))
                          <div dir="{{$dir}}" style="text-align:{{$align}}" class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                              <label for="name" class="control-label" autocomplete="off"> {{__('كاتب الخبر (إن وجد)')}} </label><br>

                                  <input style="text-align:right" dir="rtl" id="title" type="text" class="form-control" name="author" value="{{$post->author_name ?? ''}}" autocomplete="off" placeholder='يمكنك ترك هذا الحقل فارغ'>
                          </div>
                          <div dir="{{$dir}}" class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                              <label style="text-align:{{$align}}" for="subject" class="control-label">{{_('جنس كاتب الخبر')}}</label><br>

                                  <select name="author_gender" class="form-control">
                                        <option value="0">{{__('ذكر')}}</option>
                                        <option value="1">{{__('أنثى')}}</option>
                                  </select>
                          </div>
                            <div dir="{{$dir}}" style="text-align:{{$align}}" class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="control-label" autocomplete="off">{{_('اضافة الى الاسلايدر')}}</label><br>
                                <input type="checkbox" name="slider" {{$post->slider == 1 ? "checked" : ""}}>
                            </div>
                            <div dir="{{$dir}}" style="text-align:{{$align}}" class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="control-label" autocomplete="off">{{_('اضافة الى الاخبار العاجلة')}}</label><br>
                                <input type="checkbox" name="urgent" {{$post->urgent == 1 ? "checked" : ""}}>
                            </div>
                          @endif

                         
                          <div class="form-group text-center">
                                  <button type="submit" class="btn btn-primary">
                                      {{__('تعديل الخبر')}}
                                  </button>
                          </div>
                      </form>
                  </div>
              </div>
      </div>
    </div>
  </section>
  <!-- Data End --> 
  @endsection
    
  <!-- Footer end -->
  
  @section('after')
  <script src="{{$asset_path}}/ckeditor/ckeditor.js"></script>
  <script>
    CKEDITOR.editorConfig = function(config) {
  // ...
     config.filebrowserBrowseUrl = '{{$asset_path}}/ckeditor/kcfinder/browse.php?opener=ckeditor&type=files';
     config.filebrowserImageBrowseUrl = '{{$asset_path}}/ckeditor/kcfinder/browse.php?opener=ckeditor&type=images';
     config.filebrowserFlashBrowseUrl = '{{$asset_path}}/ckeditor/kcfinder/browse.php?opener=ckeditor&type=flash';
     config.filebrowserUploadUrl = '{{$asset_path}}/ckeditor/kcfinder/upload.php?opener=ckeditor&type=files';
     config.filebrowserImageUploadUrl = '{{$asset_path}}/ckeditor/kcfinder/upload.php?opener=ckeditor&type=images';
     config.filebrowserFlashUploadUrl = '{{$asset_path}}/ckeditor/kcfinder/upload.php?opener=ckeditor&type=flash';
  // ...
  };
     window.onload = function() {
        CKEDITOR.replace( 'editor1' );
        CKEDITOR.replace( 'editor2' );
    };
  </script>
    {{-- <script src="{{$asset_path}}/admin/js/summernote.js"></script> --}}
    <!-- include summernote-ko-KR -->
    {{-- @if( $locale == 'ar')
      <script src="{{$asset_path}}/admin/js/summernote-ar-AR.js"></script>
    @endif --}}
   {{--  <script>
        $('#summernote1').summernote({
          height: 300,                  // set editor height
          minHeight: null,              // set minimum height of editor
          maxHeight: null,              // set maximum height of editor
          focus: true ,                 // set focus to editable area after initializing summernote
          lang: 'ar-AR'                 // default: 'en-US'
        });
        $('#summernote2').summernote({
          height: 300,                  // set editor height
          minHeight: null,              // set minimum height of editor
          maxHeight: null,              // set maximum height of editor
          focus: true ,                 // set focus to editable area after initializing summernote
        });
    </script> --}}
  @endsection