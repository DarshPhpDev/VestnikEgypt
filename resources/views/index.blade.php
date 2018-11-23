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
<div class="container">
    <div class="row">
      <!-- hot news start -->
      <div class="col-sm-16 hot-news hidden-xs">
        <div class="row">
          <div class="col-sm-16"> <span class="ion-ios7-timer icon-news pull-{{$locale =='ar' ? 'right' : 'left'}}"></span>
            <ul id="js-news" class="js-hidden">

              @foreach($urgent_posts as $post)
                
                
              <li class="news-item"><a href="{{route('post.show',$post->id)}}">{{ $post->translate($locale)->title }}</a></li>

              @endforeach
            </ul>
          </div>
        </div>
      </div>
      <!-- hot news end --> 
      <!-- banner outer start -->
      <div  class="col-sm-16 banner-outer wow fadeInLeft animated" data-wow-delay="1s" data-wow-offset="50">
        <div class="row">
          <div class="col-sm-16 col-md-10 col-lg-8"> 
            
            <!-- carousel start -->
            <div id="sync1" class="owl-carousel">
              
                @foreach($slider_posts as $post)
                
              <div class="box item" dir="{{$dir}}"> <a href="#">
                <div class="carousel-caption" style="text-align: {{$align}}" dir="{{$dir}}"><a style="color: #fff" href="{{ route('post.show',$post->id) }}">{{$post->translate($locale)->title}}</a></div>
                @if(count($post->media) > 0 )
                <img class="img-responsive" src="{{$media_path.'/'.$post->media[0]->id.'/'.$post->media[0]->file_name}}" width="1600" height="972" alt="" style="height: 400px"/>
                @endif
                <div class="overlay"></div>
                <div class="overlay-info">
                  <div class="cat">
                    <p class="cat-data"><span class="ion-model-s"></span>{{$post->category->translate($locale)->name}}</p>
                  </div>
                  <div class="info">
                    <p><span class="ion-android-data"></span> {{$post->created_at->format('Y-m-d h:i:s A')}}<span class="ion-chatbubbles"></span>{{$post->comments->count()}}</p>
                  </div>
                </div>
                </a></div>
                @endforeach
             
              
              
              
            </div>
            <div class="row">
              <div id="sync2" class="owl-carousel">
                @foreach($slider_posts as $post)
                
                <div class="item">
                    @if(count($post->media) > 0 )
                <img class="img-responsive" src="{{$media_path.'/'.$post->media[0]->id.'/'.$post->media[0]->file_name}}"  width="1600" height="972" alt="" style="width: 300px;height: 100px" />
                @endif
                </div>
                @endforeach
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-md-6 col-lg-8 hidden-sm hidden-xs">
            @if( isset($random_three_posts) && count($random_three_posts) >= 3 )
            <div class="row">
              
              <div class="col-lg-6 hidden-md"><a href="{{route('post.show',$random_three_posts[0]->id)}}">
                <div class="box">
                  <div class=" carousel-caption">{{$random_three_posts[0]->translate($locale)->title}}</div>
                  @if(count($random_three_posts[0]->media) > 0 )
                    <img class="match-height" src="{{$media_path.'/'.$random_three_posts[0]->media[0]->id.'/'.$random_three_posts[0]->media[0]->file_name}}" width="236" height="480"  alt="" style="height:480px;width:236px"/>
                @endif
                  <div class="overlay"></div>
                  <div class="overlay-info">
                    <div class="cat">
                      <p class="cat-data"><span class="ion-model-s"></span>{{$random_three_posts[0]->category->translate($locale)->name}}</p>
                    </div>
                    <div class="info">
                      <p><span class="ion-android-data"></span> {{$random_three_posts[0]->created_at->format('Y-m-d h:i:s A')}}<span class="ion-chatbubbles"></span> {{$random_three_posts[0]->comments->count()}}</p>
                    </div>
                  </div>
                </div>
                </a> </div>
                

              <div class="col-md-16 col-lg-10">
                <div class="row">
                  
                  <div class="col-sm-16 right-img-top "> <a href="{{route('post.show',$random_three_posts[1]->id)}}">
                    <div class="box">
                      <div class="carousel-caption">{{$random_three_posts[1]->translate($locale)->title}}</div>
                      @if(count($random_three_posts[1]->media) > 0 )
                      <img class="img-responsive" src="{{$media_path.'/'.$random_three_posts[1]->media[0]->id.'/'.$random_three_posts[1]->media[0]->file_name}}" width="440" height="292" alt="" style="height:292px;width:440px"/>
                      @endif
                      <div class="overlay"></div>
                      <div class="overlay-info">
                        <div class="cat">
                          <p class="cat-data"><span class="ion-model-s"></span>{{$random_three_posts[1]->category->translate($locale)->name}}</p>
                        </div>
                        <div class="info">
                          <p><span class="ion-android-data"></span>{{$random_three_posts[1]->created_at->format('Y-m-d h:i:s A')}}<span class="ion-chatbubbles"></span>{{$random_three_posts[1]->comments->count()}}</p>
                        </div>
                      </div>
                    </div>
                    </a> </div>
                    
                  <div class="col-sm-16 right-img-btm "> <a href="{{route('post.show',$random_three_posts[2]->id)}}">
                    <div class="box">
                      <div class="carousel-caption">{{$random_three_posts[2]->translate($locale)->title}}</div>
                      <img class="img-responsive" src="{{$media_path.'/'.$random_three_posts[2]->media[0]->id.'/'.$random_three_posts[2]->media[0]->file_name}}" width="440" height="292" alt="" style="height:292px;width:440px"/>
                      <div class="overlay"></div>
                      <div class="overlay-info">
                        <div class="cat">
                          <p class="cat-data"><span class="ion-model-s"></span>{{$random_three_posts[2]->category->translate($locale)->name}}</p>
                        </div>
                        <div class="info">
                          <p><span class="ion-android-data"></span>{{$random_three_posts[2]->created_at->format('Y-m-d h:i:s A')}}<span class="ion-chatbubbles"></span>{{$random_three_posts[2]->comments->count()}}</p>
                        </div>
                      </div>
                    </div>
                    </a> </div>
                    
                </div>
              </div>
              
              
              
              @endif
            </div>
          </div>
        </div>
      </div>
      <!-- banner outer end --> 
      
    </div>
  </div>
  <!-- top sec end --> 
  
  <!-- data start -->
  <br>
  <div class="container ">
    <div class="row "> 
      <!-- left sec start -->
      <div class="col-md-11 col-sm-11">
        <div class="row"> 
          <!-- business start -->
          
          <!-- business end --> 
          
          <!-- Science & Travel start -->
          <div class="col-sm-16">
            <div class="row">
              <div class="col-xs-16 col-sm-8  wow fadeInLeft animated science" data-wow-delay="0.5s" data-wow-offset="130">
                <div class="main-title-outer pull-left">
                  <div class="main-title pull-{{$align}}"><?php
                echo \App\Category::find(2)->translate($locale)->name
              ?></div>
                </div>
                <div class="row">
                    @if($post_cat_2 != null)
                    
                  <div class="topic col-sm-16"> <a href="{{route('post.show',$post_cat_2->id)}}"> @if(count($post_cat_2->media) > 0) <img class=" img-thumbnail"  src="{{$media_path.'/'.$post_cat_2->media[0]->id.'/'.$post_cat_2->media[0]->file_name}}" width="600" height="227" alt="" style="height:227px;width:600px"/> @endif
                    <h3>{{$post_cat_2->translate($locale)->title}}</h3>
                    <div class="text-danger sub-info-bordered ">
                      <div class="time"><span class="ion-android-data icon"></span> {{$post_cat_2->created_at->format('Y-m-d h:i:s A')}}</div>
                      <div class="comments"><span class="ion-chatbubbles icon"></span> {{$post_cat_2->comments->count()}}</div>
                    </div>
                    </a>
                  </div>
                  
                  @endif
                  <div class="col-sm-16">
                    <ul class="list-unstyled  top-bordered ex-top-padding">
                        
                        @foreach($cat2_posts as $post)
                      

                      <li> <a href="{{route('post.show',$post->id) }}">
                        <div class="row">
                          <div class="col-lg-3 col-md-4 hidden-sm  ">@if(count($post->media) > 0)<img style="height:76px;width:76px" width="76" height="76" alt="" src="{{$media_path.'/'.$post->media[0]->id.'/'.$post->media[0]->file_name}}" class="img-thumbnail pull-left" style="height:76px;width:76px"> @endif</div>
                          <div class="col-lg-13 col-md-12">
                            <h4>{{$post->translate($locale)->title}}</h4>
                            <div class="text-danger sub-info">
                              <div class="time"><span class="ion-android-data icon"></span>{{$post->created_at->format('Y-m-d h:i:s A')}}</div>
                              <div class="comments"><span class="ion-chatbubbles icon"></span>{{$post->comments->count()}}</div>
                              <!--<div class="stars"><span class="ion-ios7-star"></span><span class="ion-ios7-star"></span><span class="ion-ios7-star"></span><span class="ion-ios7-star"></span><span class="ion-ios7-star-half"></span></div>-->
                            </div>
                          </div>
                        </div>
                        </a> </li>
                        @endforeach

                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-sm-8 col-xs-16 wow fadeInRight animated" data-wow-delay="0.5s" data-wow-offset="130">
                <div class="main-title-outer pull-left">
                  <div class="main-title pull-{{$align}}"><?php
                echo \App\Category::find(3)->translate($locale)->name
              ?></div>
                </div>
                <div class="row left-bordered">
                    @if($post_cat_3 != null)
                    
                  <div class="topic col-sm-16"> <a href="{{route('post.show',$post_cat_3->id)}}"> @if(count($post_cat_3->media) > 0) <img class=" img-thumbnail"  src="{{$media_path.'/'.$post_cat_3->media[0]->id.'/'.$post_cat_3->media[0]->file_name}}" width="600" height="227" alt="" style="height:227px;width:600px"/> @endif
                    <h3>{{$post_cat_3->translate($locale)->title}}</h3>
                    <div class="text-danger sub-info-bordered ">
                      <div class="time"><span class="ion-android-data icon"></span> {{$post_cat_3->created_at->format('Y-m-d h:i:s A')}}</div>
                      <div class="comments"><span class="ion-chatbubbles icon"></span> {{$post_cat_3->comments->count()}}</div>
                    </div>
                    </a>
                  </div>
                  
                  @endif
                  <div class="col-sm-16">
                    <ul class="list-unstyled top-bordered ex-top-padding">
                      @foreach($cat3_posts as $post)
                      

                      <li> <a href="{{route('post.show',$post->id) }}">
                        <div class="row">
                          <div class="col-lg-3 col-md-4 hidden-sm  ">@if(count($post->media) > 0)<img style="height:76px;width:76px" width="76" height="76" alt="" src="{{$media_path.'/'.$post->media[0]->id.'/'.$post->media[0]->file_name}}" class="img-thumbnail pull-left" style="height:76px;width:76px"> @endif</div>
                          <div class="col-lg-13 col-md-12">
                            <h4>{{$post->translate($locale)->title}}</h4>
                            <div class="text-danger sub-info">
                              <div class="time"><span class="ion-android-data icon"></span>{{$post->created_at->format('Y-m-d h:i:s A')}}</div>
                              <div class="comments"><span class="ion-chatbubbles icon"></span>{{$post->comments->count()}}</div>
                              <!--<div class="stars"><span class="ion-ios7-star"></span><span class="ion-ios7-star"></span><span class="ion-ios7-star"></span><span class="ion-ios7-star"></span><span class="ion-ios7-star-half"></span></div>-->
                            </div>
                          </div>
                        </div>
                        </a> </li>
                        @endforeach
                      
                    </ul>
                  </div>
                </div>
              </div>
            </div>
            <hr>
          </div>
          <!-- Scince & Travel end --> 
          <!-- lifestyle start-->
          <div class="col-sm-16 wow fadeInUp animated " data-wow-delay="0.5s" data-wow-offset="100">
            <div class="main-title-outer pull-left">
              <div class="main-title pull-{{$align}}"><?php
                echo \App\Category::find(1)->translate($locale)->name
              ?></div>
              <div class="span-outer"></div>
            </div>
            <div class="row">
              <div id="owl-lifestyle" class="owl-carousel owl-theme lifestyle pull-{{$align}}">
                

              @foreach($cat1_posts as $post)
                     

           

                <div class="item topic"> <a href="{{route('post.show',$post->id)}}"> @if(count($post->media) > 0 ) <img class="img-thumbnail" src="{{$media_path.'/'.$post->media[0]->id.'/'.$post->media[0]->file_name}}" width="300" height="132" alt="" style="height: 150px" /> @endif
                  <h4>{{$post->translate($locale)->title}}</h4>
                  <div class="text-danger sub-info-bordered remove-borders">
                    <div class="time"><span class="ion-android-data icon"></span> {{$post->created_at->format('Y-m-d h:i:s A')}}</div>
                    <div class="comments"><span class="ion-chatbubbles icon"></span> {{$post->comments->count()}}</div>
                    
                  </div>
                  </a> </div>
                
                   @endforeach
              </div>
            </div>
            <hr>
          </div>
          <!-- lifestyle end --> 
          
          <!--Recent videos start-->
          
          <!--Recent videos end--> 
          <!--wide ad start-->
{{--           <div class="col-sm-16 wow fadeInDown animated " data-wow-delay="0.5s" data-wow-offset="25"><img class="img-responsive" src="{{$asset_path}}/images/ads/728-90-ad.gif" width="728" height="90" alt="" style="height:90px;width:728px"/></div> --}}
          <!--wide ad end--> 
          
        </div>
      </div>
      <!-- left sec end --> 
      <!-- right sec start -->
      <div class="col-sm-5 hidden-xs right-sec">
        <div class="bordered top-margin">
          <div class="row ">
            <div class="col-sm-16 bt-space wow fadeInUp animated" data-wow-delay="1s" data-wow-offset="50"> <img class="img-responsive" src="{{$asset_path}}/images/ads/336-280-ad.gif" width="336" height="280" alt="" style="height:280px;width:336px"/> <a href="#" class="sponsored">{{__('messages.Social')}}</a> </div>
            <div class="col-sm-16 bt-spac wow fadeInUp animated" data-wow-delay="1s" data-wow-offset="150">
              <div class="table-responsive">
                <table class="table table-bordered social">
                  <tbody>
                    <tr>
                      <td><a class="twitter" href="#">
                        <p><span class="ion-social-twitter"></span> 11
                          followers</p>
                        </a></td>
                      <td><a class="facebook" href="#">
                        <p> <span class="ion-social-facebook"></span> 2682<br>
                          fans</p>
                        </a></td>
                        <td><a class="instagram" href="#">
                        <p> <span class="ion-social-instagram"></span> 118
                          followers</p>
                        </a></td>
                    </tr>
                    <tr>
                      <td><a class="youtube" href="#">
                        <p> <span class="ion-social-youtube"></span> 
                          </p>
                        </a></td>
                      <td><a class="vimeo" href="#">
                        <p><span class="ion-social-vimeo"></span>
                          </p>
                        </a></td>
                      <td><a class="googleplus" href="#">
                        <p> <span class="ion-social-googleplus"></span>
                          </p>
                        </a></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- activities start -->
            <div class="col-sm-16 bt-space wow fadeInUp animated" data-wow-delay="1s" data-wow-offset="130"> 
              <!-- Nav tabs -->
              <ul class="nav nav-tabs nav-justified " role="tablist">
                <li><a href="#recent" role="tab" data-toggle="tab">{{__('messages.recent')}}</a></li>
                
              </ul>
              
              <!-- Tab panes -->
              <div class="tab-content">
                <div class="tab-pane" id="recent">
                  <ul class="list-unstyled">

                  @foreach($recent_posts as $post)
                      

                    <li> <a href="{{route('post.show',$post->id)}}">
                      <div class="row">
                        <div class="col-sm-5  col-md-4 "> @if(count($post->media) > 0 ) <img class="img-thumbnail pull-left" src="{{$media_path.'/'.$post->media[0]->id.'/'.$post->media[0]->file_name}}" width="164" height="152" alt="" style="height:152px;width:164px" /> @endif </div>
                        <div class="col-sm-11  col-md-12 ">
                          <h4>{{$post->translate($locale)->title}}</h4>
                          <div class="text-danger sub-info">
                            <div class="time"><span class="ion-android-data icon"></span> {{$post->created_at->format('Y-m-d h:i:s A')}}</div>
                            <div class="comments"><span class="ion-chatbubbles icon"></span>{{$post->comments->count()}}</div>
                          </div>
                        </div>
                      </div>
                      </a> </li>
                    @endforeach
                  </ul>
                </div>
                
              </div>
            </div>
            <!-- activities end --> 
            <!-- radio start -->
            {{-- <div class="col-sm-16 bt-space wow fadeInUp animated" data-wow-delay="1s" data-wow-offset="100">
              <div class="main-title-outer pull-left">
                <div class="main-title">VestnikEgypt radio</div>
              </div>
              <iframe width="100%" height="166" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/172078992&amp;color=e74c3c&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false"></iframe>
            </div> --}}
            <!-- radio end --> 
            
            <!-- calendar start -->
            <div class="col-sm-16 bt-space wow fadeInUp animated" data-wow-delay="1s" data-wow-offset="50">
              <div class="single pull-left"></div>
            </div>
            <!-- calendar end --> 
            <!-- flicker imgs start -->
            
            <!-- flicker imgs end --> 
          </div>
        </div>
      </div>
      <!-- right sec end --> 
    </div>
  </div>
@endsection


@section('after')

@endsection