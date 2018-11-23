<div class="col-md-12 col-md-offset-2" dir="{{$dir}}">
    <div style="display:none;" class="html5gallery" data-skin="verticallight" data-width="700" data-height="400">
       <!-- Add Youtube video to Gallery -->
       @foreach($media as $video)
       @if($locale == "ar")
       <a href="{{$video->body_ar}}"><img src="https://img.youtube.com/vi/{{\App\Http\Controllers\Controller::getYouTubeId($video->body_ar)}}/2.jpg" alt="{{$video->title_ar}}" dir="rtl"></a>
       @else
       <a href="{{$video->body_ar}}"><img src="https://img.youtube.com/vi/{{\App\Http\Controllers\Controller::getYouTubeId($video->body_ar)}}/2.jpg" alt="{{$video->title_ru}}"></a>
       @endif
       @endforeach       

    </div>
</div>