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
  <div class="container">
    <div class="page-header">
        <!-- title of post --> 
    </div>
  </div>
  <!-- bage header End --> 
  <!-- data Start -->
  <section>
    <div class="container ">
      <div class="row" dir="{{$dir}}"> 
        <!-- left sec Start -->
        <div class="col-md-16 col-sm-16">
          <div class="row"> 
            <!-- post details start -->
            <div class="col-sm-16">
              <div class="row">
                <div class="sec-topic col-sm-16  wow fadeInDown animated  animated" data-wow-delay="0.5s" style="visibility: visible; animation-delay: 0.5s; animation-name: fadeInDown;">
                  <div class="row">
                    <div class="col-sm-16">
                      @if(count($post->media) > 0 )
                      <img width="auto" height="auto" alt="" src="{{$media_path.'/'.$post->media[0]->id.'/'.$post->media[0]->file_name}}" class="img-thumbnail">
                      @endif
                    </div>
                    <div class="col-sm-16 sec-info">
                      <h3>{{$post->translate($locale)->title}}</h3>
                      <div class="text-danger sub-info-bordered">
                          @if(Auth::user())
                          @if(Auth::user()->can('manage-users'))
                          <div class="seen"><span>Seen: {{$post->seen}}</span></div>
                          @endif
                          @endif
                        <div class="author"><span class="ion-person icon"></span> {{__('By')}}: {{$post->author_name??$post->author->name}}</div>
                        <div class="time"><span class="ion-android-data icon"></span> {{$post->created_at->format('Y-m-d h:i:s A')}}</div>
                        {{-- <div class="comments"><span class="ion-chatbubbles icon"></span> {{$post->comments->count()}}</div> --}}
                        
                    
                      <p><span class="letter-badge"></span>{!! $post->translate($locale)->body !!}</p>
                      
                      
                      
                      
                    </div>
                  </div>
                </div>
                @if(Auth::user())
                  @if(Auth::user()->can('edit-news') || Auth::id() == $post->user_id )
                  <div class="row">
                    <div>
                      <a class="btn btn-primary" href="{{ route('post.edit',$post->id) }}">تعديل الخبر</a>
                      <a onclick="return confirm('هل أنت متأكد من المسح')" class="btn btn-danger" href="{{ route('post.destroy',$post->id) }}">مسح الخبر</a>
                    </div>
                  </div><br>
                  @endif
                @endif 
                <div class="row">
                <div class="col-sm-16 author-box" dir="{{$dir}}">
                  <div class="main-title-outer pull-{{$align}}">
                    <div class="main-title" style="float:{{$align}}">{{__('messages.writer')}}</div>
                  </div>

                    <div class=" col-xs-4 col-sm-2 pull-{{$align}}">
                      {{-- author image(fixed) --}}
                      @if($post->author_name != null)
                            @if($post->author_gender == 0)
                                <img class="img-thumbnail" src="{{$asset_path}}/images/male.png" width="128" height="128" alt="">
                            @else
                                <img class="img-thumbnail" src="{{$asset_path}}/images/female.png" width="128" height="128" alt="">
                            @endif
                      @else
                          @if($post->author->gender == "male")
                            <img class="img-thumbnail" src="{{$asset_path}}/images/male.png" width="128" height="128" alt="">
                          @else
                            <img class="img-thumbnail" src="{{$asset_path}}/images/female.png" width="128" height="128" alt="">
                          @endif
                      @endif          
                      <h4 class="text-center"><a href="#">{{$post->author_name ?? $post->author->name}}</a></h4>
                    </div>
                      <div class="col-xs-12 col-sm-14 pull-{{$align}}">
                        
                      </div>
                  </div>
                </div>
                
                  


                  @include('comments')

                <div class="col-sm-16">
                  <div class="main-title-outer pull-left">
                    <div class="main-title pull-{{$align}}">{{__('messages.leave a comment')}}</div>
                  </div>
                  <div class="col-xs-16 wow zoomIn animated animated" style="visibility: visible;">
                    <form action="{{route('post.comment',$post->id)}}" method="post" class="comment-form">
                          {{ csrf_field() }}
                      <div class="row">
                        @if(!Auth::user())
                        <div class="form-group col-sm-8 name-field">
                          <input type="text" name="author" placeholder="{{__('messages.Name')}}" required="" class="form-control">
                        </div>
                        <div class="form-group col-sm-8 email-field">
                          <input type="email" placeholder="{{__('messages.Email')}}" required="" class="form-control">
                        </div>
                        @endif
                        <div class="form-group col-sm-16">
                          <textarea placeholder="{{__('messages.Your Message')}}" rows="8" class="form-control" required="" id="message" name="body"></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <button class="btn btn-danger" type="submit">{{__('messages.Add Comment')}}</button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            <!-- post details end --> 
            
          </div>
        </div>
        <!-- left sec End --> 
        <!-- right sec Start -->
        
        <!-- Right Sec End --> 
      </div>
    </div>
  </section>
  <!-- Data End --> 
  @endsection
    
  <!-- Footer end -->
  
  @section('after')
  <!--jQuery easing--> 
  <script src="js/jquery.easing.1.3.js"></script> 
  <!--media queries to js--> 
  <script src="js/enquire.js"></script> 

  @endsection