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


<div class="container" dir="{{$dir}}">
  <div class="row" dir="{{$dir}}">
    @if($posts->count() > 0)
      @foreach($posts as $post)
        <div class="topic col-md-8 pull-{{$align}}" dir="{{$dir}}"> <a href="{{route('post.show',$post->id)}}">
          @if(count($post->media) > 0 )
          <img class="img-thumbnail" src="{{$media_path.'/'.$post->media[0]->id.'/'.$post->media[0]->file_name}}" width="600px" height="227px" style="height: 250px" alt=""/>
          @else
          <img class="img-thumbnail" src="http://via.placeholder.com/600x227" width="600" height="227" alt=""/>
          @endif
          <h3>{{$post->translate($locale)->title}}</h3>
          <div class="text-danger sub-info-bordered ">
            <div class="time"><span class="ion-android-data icon"></span> {{$post->created_at->format('Y-m-d h:i:s A')}}</div>
            <div class="comments"><span class="ion-chatbubbles icon"></span> {{ $post->comments->count() }}</div>
          </div>
          </a>
          {{-- <p>{{ substr($post->translate($locale)->body,0,20) }}</p> --}}
        </div>
      @endforeach
    @else
      <div class="row" style="height: 400px">
        <h2 class="text-center">{{__('messages.No Posts Found')}}</h2>
      </div>
    @endif  
      </div>
      <div class="text-center">
          {{$posts->links()}}
      </div>
        
  </div>
  
  
  


    


@endsection
