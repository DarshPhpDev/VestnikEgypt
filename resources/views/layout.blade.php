<!DOCTYPE html>
<?php
$asset_path = URL::asset('public/assets');
$media_path = URL::asset('public/uploads/media');
$dir = ''; $lng ='';
$locale = session()->has('locale') ? session()->get('locale') : auth()->user()['language'];
if(empty($locale)){
  $locale = 'ar';
}
app()->setLocale($locale);
if (app()->getLocale() == 'ar') {
    $dir = 'rtl';
    $lng = 'ar';
}else{
    $dir = 'ltr';
    $lng = 'ru';
}
?>
<html lang="{{$lng}}">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>VestnikEgypt - Home</title>
<link rel="shortcut icon" href="{{$asset_path}}/images/favicon.ico" type="image/x-icon">
<link rel="icon" href="{{$asset_path}}/images/favicon.ico" type="image/x-icon">
<!-- bootstrap styles-->
<link href="{{$asset_path}}/css/bootstrap.min.css" rel="stylesheet">
<!-- google font -->
<link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
{{-- <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,600,800' rel='stylesheet' type='text/css'> --}}
<!-- ionicons font -->
<link href="{{$asset_path}}/css/ionicons.min.css" rel="stylesheet">
<!-- animation styles -->
<link rel="stylesheet" href="{{$asset_path}}/css/animate.css" />
<!-- custom styles -->
<link href="{{$asset_path}}/css/custom-red.css" rel="stylesheet" id="style">
<!-- owl carousel styles-->
<link rel="stylesheet" href="{{$asset_path}}/css/owl.carousel.css">
<link rel="stylesheet" href="{{$asset_path}}/css/owl.transitions.css">
{{-- image slider --}}
<link rel="stylesheet" href="{{$asset_path}}/css/slider.css">
<!-- magnific popup styles -->
<link rel="stylesheet" href="{{$asset_path}}/css/magnific-popup.css">
<link href="{{$asset_path}}/admin/css/summernote.css" rel="stylesheet">



<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    @if($dir == "rtl")
      <link rel="stylesheet" href="{{$asset_path}}/css/rtl.css">    
    @endif
    <style>

      body{
        font-family: 'Cairo', sans-serif;
      }
     
    </style>
    @if($locale == "ru")
    <style>
        ul.main-nav {
            -moz-transform: rotate(180deg);
            -webkit-transform: rotate(180deg);
            transform: rotate(180deg);
        }
        ul.main-nav > li {
            -moz-transform: rotate(-180deg);
            -webkit-transform: rotate(-180deg);
            transform: rotate(-180deg);
        }
    </style>
    @endif
</head>
<body>

<script type="text/javascript">
        jssor_1_slider_init = function() {

            var jssor_1_SlideshowTransitions = [
              {$Duration:800,x:-0.3,$During:{$Left:[0.3,0.7]},$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2},
              {$Duration:800,x:0.3,$SlideOut:true,$Easing:{$Left:$Jease$.$InCubic,$Opacity:$Jease$.$Linear},$Opacity:2}
            ];

            var jssor_1_options = {
              $AutoPlay: 1,
              $SlideshowOptions: {
                $Class: $JssorSlideshowRunner$,
                $Transitions: jssor_1_SlideshowTransitions,
                $TransitionsOrder: 1
              },
              $ArrowNavigatorOptions: {
                $Class: $JssorArrowNavigator$
              },
              $ThumbnailNavigatorOptions: {
                $Class: $JssorThumbnailNavigator$,
                $Orientation: 2,
                $NoDrag: true
              }
            };

            var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

            /*#region responsive code begin*/

            var MAX_WIDTH = 980;

            function ScaleSlider() {
                var containerElement = jssor_1_slider.$Elmt.parentNode;
                var containerWidth = containerElement.clientWidth;

                if (containerWidth) {

                    var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);

                    jssor_1_slider.$ScaleWidth(expectedWidth);
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }

            ScaleSlider();

            $Jssor$.$AddEvent(window, "load", ScaleSlider);
            $Jssor$.$AddEvent(window, "resize", ScaleSlider);
            $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
            /*#endregion responsive code end*/
        };
    </script>
<!-- preloader start -->
{{-- <div id="preloader">
  <div id="status"></div>
</div> --}}
<!-- preloader end --> 

<!-- Switcher -->
<div class="switcher" style="left: -50px;"> <a id="switch-panel" class="hide-panel"> <i class="ion-gear-a"></i> </a>
  <div id="switcher" style="">
    <ul class="colors-list">
      <li><a href="#" class="red" id="custom-red"></a></li>
      <li><a href="#" class="green" id="custom-green"></a></li>
      <li><a href="#" class="purple" id="custom-purple"></a></li>
      <li><a href="#" class="blue" id="custom-blue"></a></li>
    </ul>
  </div>
</div>
<!-- wrapper start -->
<div class="wrapper"> 
  <!-- header toolbar start -->
  <div class="header-toolbar">
    <div class="container">
      <div class="row">
        <div class="col-md-16 text-uppercase">
          <div class="row">
            <div class="col-sm-8 col-xs-16 section1">
              <ul id="inline-popups" class="list-inline">
                  @if(!auth()->user())
                  <a class="open-popup-link" href="#log-in" data-effect="mfp-zoom-in">{{__('messages.login')}}</a>
                  @else
                  <a href="{{route('logout')}}"><i class="fa fa-power-off"></i> {{__('messages.logout')}}</a>
                  @endif
                </li>
                <li class="list-line dropdown flags">
                  <a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                      <span>{{__('messages.language')}}</span>
                      <i class="fa fa-angle-down"></i>
                  </a>
                  <ul class="dropdown-menu sfmenuffect">

                    @if($locale == "ar")
                    <li>
                        <a href="{{ route('changelang','ar') }}">
                            <span style="color: #000">{{__('العربية')}}</span>
                          <span class="flag-icon" style="background-image: url('{{$asset_path}}/eg.png')">
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('changelang','ru') }}">
                            <span style="color: #000">{{__('الروسية')}}</span>
                            <span class="flag-icon" style="background-image: url('{{$asset_path}}/ru.png')">
                            </span>
                        </a>
                    </li>
                    @else
                      <li>
                          <a href="{{ route('changelang','ar') }}">
                            <span class="flag-icon" style="background-image: url('{{$asset_path}}/eg.png')">
                              </span>
                              <span style="color: #000">{{__('арабский')}}</span>
                          </a>
                      </li>
                      <li>
                          <a href="{{ route('changelang','ru') }}">
                              <span class="flag-icon" style="background-image: url('{{$asset_path}}/ru.png')">
                              </span>
                              <span style="color: #000">{{__('русский')}}</span>
                          </a>
                      </li>
                      @endif
                      
                  </ul>
              </li>
              @if(Auth::user() && Auth::user()->gender == "female")
                    @if($locale == "ar")
                        <li>{{__('مرحبا بكِ')}}  {{Auth::user()->name}}</li>
                    @else
                        <li>{{__('Здравствуйте')}}  {{Auth::user()->name}}</li>
                    @endif
                      
              @elseif(Auth::user() && Auth::user()->gender == "male")
                      @if($locale == "ar")
                        <li>{{__('مرحبا بك')}}  {{Auth::user()->name}}</li>
                    @else
                        <li>{{__('Здравствуйте')}}  {{Auth::user()->name}}</li>
                    @endif
              @endif
              </ul>
            </div>
            <div class="col-xs-16 col-sm-8 section2">
              <div class="row">
                @if($locale == "ar")
                  <div id="time-date" class="col-xs-16 col-sm-6 col-lg-5" style="text-align: center;"></div>
                  <div id="weather" class="col-xs-16 col-sm-8 col-lg-9"></div>
                @else
                  <div id="weather" class="col-xs-14 col-sm-7 col-lg-8"></div>
                  <div id="time-date" locale="" class="col-xs-16 col-sm-9 col-lg-8"></div>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- header toolbar end --> 
  
  <!-- sticky header start -->
  <div class="sticky-header"> 
    <!-- header start -->
    <div class="container header">
      <div class="row">
        <div class="col-sm-5 col-md-5 wow fadeInUpLeft animated section3"><a class="navbar-brand" href="{{route('homepage')}}">VestnikEgypt</a></div>
        <div class="col-sm-11 col-md-11 hidden-xs text-right section4"><img src="{{$asset_path}}/images/ads/468-60-ad.gif" width="468" height="60" alt=""/></div>
      </div>
    </div>
    <!-- header end --> 
    <!-- nav and search start -->
    <div class="nav-search-outer"> 
      <!-- nav start -->
      
      <nav class="navbar navbar-inverse" role="navigation">
        <div class="container">
          <div class="row">
            <div class="col-sm-16"> <a href="javascript:;" class="toggle-search {{$locale == "ar" ? "" : "pull-right"}}"><span class="ion-ios7-search"></span></a>
              <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
              </div>
              <div class="collapse navbar-collapse section5" id="navbar-collapse">
                <ul class="nav navbar-nav text-uppercase main-nav" style="{{$locale == "ru" ? 'font-size: 11px;' : ''}}">
                    <?php
                        $categories = \App\Category::orderBy('id','DESC')->get();
                    ?>
                    
                  
                  
                        @if(!auth()->user() || $locale=="ar")
                        <li><a href="{{route('contactus')}}">{{__('messages.Contact US')}}</a></li>
                        @endif
                        @if(auth()->user())
                          <li><a href="{{route('post.create')}}">{{__('messages.addnews')}}</a></li>
                        @endif
                        <li><a href="{{route('about')}}">{{__('messages.about us')}}</a></li>
                        <li><a href="{{route('videos')}}">{{__('messages.videos')}}</a></li>
                        <li><a href="{{route('images')}}">{{__('messages.images')}}</a></li>
                  
                  @foreach($categories as $cat)
                    <li> <a href="{{route('post.category',$cat->id)}}" style="font-family: 'Cairo', sans-serif;">{{$cat->translateOrNew($locale)->name}}</a></li>
                  @endforeach
                    <li><a href="{{route('homepage')}}" style="font-family: 'Cairo', sans-serif;">{{__('messages.home')}}</a></li>    
                    
                        
                        
                        
                  
                </ul>
              </div>
            </div>
          </div>
        </div>
        <!-- nav end --> 
        <!-- search start -->
        
        <div class="search-container ">
          <div class="container">
            <form id="search-form" action="{{ route('search') }}" method="post">
              {{csrf_field()}}
              <input id="search-bar" name="search" placeholder="{{__('messages.search')}}" autocomplete="off" style="direction:{{$locale=='ar' ? 'rtl':'ltr'}}">
            </form>
          </div>
        </div>
        <!-- search end --> 
      </nav>
      <!--nav end--> 
    </div>
    <!-- nav and search end--> 
  </div>
  <!-- sticky header end --> 
  <!-- top sec start -->
  
  

  <!-- data end --> 
  @if(Session::has('message'))
    <p class="text-center alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
  @endif
  @if(Session::has('message-danger'))
    <p class="text-center alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('message-danger') }}</p>
  @endif
  @if(Session::has('message-success'))
    <p class="text-center alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message-success') }}</p>
  @endif
  <!-- Footer start -->
  @yield('content')
  <footer>
    <div class="top-sec">
      <div class="container ">
        <div class="row match-height-container">
          <div class="col-sm-6 subscribe-info wow fadeInDown animated" data-wow-delay="1s" data-wow-offset="40">
            <div class="row">
              <div class="col-sm-16">
                <div class="f-title">VestnikEgypt News Website</div>
                <p>Founded on August 1, 2018</p>
              </div>
              
            </div>
          </div>
          <div class="col-sm-5 popular-tags  wow fadeInDown animated" data-wow-delay="1s" data-wow-offset="40">
            <div class="f-title">{{__('messages.popular tags')}}</div>
            <ul class="tags list-unstyled pull-left">
              @foreach($categories as $cat)
                <li> <a href="{{route('post.category',$cat->id)}}" style="font-family: 'Cairo', sans-serif;">{{$cat->translateOrNew($locale)->name}}</a></li>
              @endforeach
            </ul>
          </div>
          <div class="col-sm-5 recent-posts  wow fadeInDown animated" data-wow-delay="1s" data-wow-offset="40">
            <div class="f-title">{{__('messages.recent news')}}</div>
            
            <ul class="list-unstyled">
                <?php $i=0; ?>
              @foreach($recent_posts as $recent)

              
              <li> <a href="#">
                <div class="row">
                  <div class="col-sm-4">
                    @if(count($recent->media)>0)
                    <img class="img-thumbnail pull-left" src="{{$media_path.'/'.$recent->media[0]->id.'/'.$recent->media[0]->file_name}}" width="70" height="70" alt=""/>
                    @endif 
                  </div>
                  <div class="col-sm-12">
                    <a href="{{route('post.show',$recent->id)}}"> <h4>  {{$recent->translate($locale)->title}}</h4></a>
                    <div class="f-sub-info">
                      <div class="time"><span class="ion-android-data icon"></span>{{$recent->created_at->format('Y-m-d H:i A')}}</div>
                      <div class="comments"><span class="ion-chatbubbles icon"></span>{{$recent->comments->count()}}</div>
                    </div>
                  </div>
                </div>
                </a> 
              </li>
              <?php $i++; ?>
              @endforeach
            </ul>
          </div>

            {{-- end recent posts --}}
        </div>
      </div>
    </div>
    <div class="btm-sec">
      <div class="container">
        <div class="row">
          <div class="col-sm-16">
            <div class="row">
              <div class="col-sm-10 col-xs-16 f-nav wow fadeInDown animated" data-wow-delay="0.5s" data-wow-offset="10">
                <ul class="list-inline ">
                  @foreach($categories as $cat)
                    <li> <a href="{{route('post.category',$cat->id)}}" style="font-family: 'Cairo', sans-serif;">{{$cat->translateOrNew($locale)->name}}</a></li>
                  @endforeach
                  <li class="active"><a href="{{route('homepage')}}" style="font-family: 'Cairo', sans-serif;">{{__('messages.home')}}</a></li>
                </ul>
              </div>
              <div class="col-sm-6 col-xs-16 copyrights text-right wow fadeInDown animated" data-wow-delay="0.5s" data-wow-offset="10">© 2018 VestnikEgypt - By: <a class="alert-link" href="https://www.facebook.com/freera4bia" target="_blank">MUSTAFA AHMED</a> - Tested By: <a class="alert-link" href="https://www.facebook.com/profile.php?id=100007811535933" target="_blank">Esraa Osama </a></div>
            </div>
          </div>
          <div class="col-sm-16 f-social  wow fadeInDown animated" data-wow-delay="1s" data-wow-offset="10">
            <ul class="list-inline">
              <li> <a href="http://twitter.com/vestnikegypt" target="_blank"><span class="ion-social-twitter"></span></a> </li>
              <li> <a href="http://facebook.com/vestnikegypt" target="_blank"><span class="ion-social-facebook"></span></a> </li>
              <li> <a href="http://instagram.com/vestnikegypt" target="_blank"><span class="ion-social-instagram"></span></a> </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- Footer end -->
  <div id="log-in" class="white-popup mfp-with-anim mfp-hide">
    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
      {{ csrf_field() }}
      <h3 style="    text-align:{{ $locale == 'ar' ? 'right' : 'left'}};">{{__('messages.logintoyouraccount')}}</h3>
      <div class="form-group">
        <input type="text" name="email" id="access_name" class="form-control" placeholder="{{__('messages.Email')}}" tabindex="3">
      </div>
      <div class="form-group">
        <input type="password" name="password" id="password" class="form-control " placeholder="{{__('messages.Password')}}" tabindex="4">
      </div>
      <div class="form-group">
          <div class="col-md-6 col-md-offset-4">
              <div class="checkbox">
                  <label>
                      <input type="checkbox" name="remember"> {{__('messages.rememberme')}}
                  </label>
              </div>
          </div>
      </div>
      <hr>
      <div class="row">
        <div class="col-sm-16">
          <input type="submit" value="{{ __('messages.login') }}" class="btn btn-danger btn-block btn-lg" tabindex="7">
        </div>
      </div>
    </form>
  </div>
</div>
<!-- wrapper end --> 

<!-- jQuery --> 
<script src="{{$asset_path}}/js/jquery.min.js"></script> 
<!--jQuery easing--> 
<script src="{{$asset_path}}/js/jquery.easing.1.3.js"></script> 
<!-- bootstrab js --> 
<script src="{{$asset_path}}/js/bootstrap.js"></script> 
<!--style switcher--> 
<script>
  

 //THE CALLING OF PANEL ON CLICKING THE BUTTON 

            jQuery('#switch-panel').click(function () {
                if (jQuery(this).hasClass('show-panel')) {
                    jQuery('.switcher').css({ 'left': '-50px' });
                    jQuery('#switch-panel').removeClass('show-panel');
                    jQuery('#switch-panel').addClass('hide-panel');
                } else if (jQuery(this).hasClass('hide-panel')) {
                    jQuery('.switcher').css({ 'left': 0 });
                    jQuery('#switch-panel').removeClass('hide-panel');
                    jQuery('#switch-panel').addClass('show-panel');
                }
            });

/*
 * jQuery styleSwitcher Plugin
 * Examples and documentation at: 
 * http://www.immortalwolf.com/demo/jquery-style-switcher/
 * Copyright (c) 2011 immortal wolf
 * Version: 1.4 (27-JAN-2011)
 * Dual licensed under the MIT and GPL licenses.
 * http://en.wikipedia.org/wiki/Gpl
 * http://en.wikipedia.org/wiki/MIT_License
 * Requires: jQuery v1.2.6 or later
 * 
 * @version 1.4 changelog:
 *    - added cookie support
 *    - allow usage of either JavaScript or PHP for
 *      cookie management via jQuery config options 
 */
 
(function($) {
  $.fn.styleSwitcher = function(options){   
    var defaults = {  
      slidein: true, preview: false, container: this.selector, directory: "{{$asset_path}}/css/", useCookie: true, cookieExpires: 30, manageCookieLoad:true 
    };
    var opts = $.extend(defaults, options);
    // if using cookies and using JavaScript to load css
    if (opts.useCookie && opts.manageCookieLoad) {
      // check if css is set in cookie
      var isCookie = readCookie("style_selected")
      if(isCookie){
        var newStyle = opts.directory + isCookie + ".css";
        $("link[id=style]").attr("href",newStyle);
        baseStyle = newStyle;
      }
      else{
        
      }
    }   
    // if using slidein
    if(opts.slidein){
      $(opts.container).slideDown("slow");
    }
    else{
      $(opts.container).show();
    }
    var baseStyle = $("link[id=style]").attr("href");
    if(opts.preview){
      $(opts.container + " a").hover(
        function () {
          var newStyle = opts.directory + this.id + ".css";
          $("link[id=style]").attr("href",newStyle);
        }, 
        function () {
          $("link[id=style]").attr("href",baseStyle);
        }
      );
    }
    
    $(opts.container + " a").click(
      function () {
        var newStyle = opts.directory + this.id + ".css";
        $("link[id=style]").attr("href",newStyle);
        baseStyle = newStyle;
        if(opts.useCookie){
          createCookie("style_selected",this.id,opts.cookieExpires)
        }
      }
    );
    
  };
  function createCookie(name,value,days) {
    if (days) {
      var date = new Date();
      date.setTime(date.getTime()+(days*24*60*60*1000));
      var expires = "; expires="+date.toGMTString();
    }
    else var expires = "";
    document.cookie = name+"="+value+expires+"; path=/";
  } 
  function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
      var c = ca[i];
      while (c.charAt(0)==' ') c = c.substring(1,c.length);
      if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
  } 
  function eraseCookie(name) {
    createCookie(name,"",-1);
  }
})(jQuery);
</script> 
<!--wow animation--> 
<script src="{{$asset_path}}/js/wow.min.js"></script> 
<!-- time and date --> 
<script src="{{$asset_path}}/js/moment.min.js"></script> 
<!--news ticker--> 
@if($locale == "ar")
  <script src="{{$asset_path}}/js/jquery.ticker-rtl.js"></script> 
@else
  <script src="{{$asset_path}}/js/jquery.ticker.js"></script> 
@endif
<!-- owl carousel --> 
<script src="{{$asset_path}}/js/owl.carousel.js"></script> 
<!-- magnific popup --> 
<script src="{{$asset_path}}/js/jquery.magnific-popup.js"></script> 
<!-- weather --> 
<script src="{{$asset_path}}/js/jquery.simpleWeather.min.js"></script> 
<script>
   $(document).ready(function() {
   "use strict";
     var html = '';
     // cairo 1521894 , moscow 2122265
     var loc_code = {{ $locale == "ar" ? '1521894' : '2122265' }};
     $.simpleWeather({
     location: '',
     woeid: loc_code,
     unit: 'c',
     success: function(weather) {
       if(weather.city == "Moscow")
          weather.city = "Москва";
       html = '<i class="icon-' + weather.code + '"></i> ' + weather.city +
         ', ' + ' ' + weather.temp + '&deg;' +
         weather.units.temp + ' ';
       $("#weather").html(html);
     },
     error: function(error) {
       $("#weather").html('<p>' + error + '</p>');
     }
   });
 });
</script>
<script>
  $(document).ready(function(){
    $('#search-bar').keypress(function (e) {
     var key = e.which;
     if(key == 13)  // the enter key code
      {
        $('search-form').submit();
      }
    });
    // get current URL path and assign 'active' class
    var pathname = 'http://vestnikegypt.com'+ window.location.pathname;
    console.log(pathname);
    if(pathname == 'http://vestnikegypt.com/')
      pathname = 'http://vestnikegypt.com';  
    $('.nav li').removeClass('active');
    $('.nav > li > a[href="'+pathname+'"]').parent().addClass('active');
  });
</script>
<!-- calendar--> 
<script src="{{$asset_path}}/js/jquery.pickmeup.js"></script> 
<!-- go to top --> 
<script src="{{$asset_path}}/js/jquery.scrollUp.js"></script> 
<!-- scroll bar --> 
<script src="{{$asset_path}}/js/jquery.nicescroll.js"></script> 
<script src="{{$asset_path}}/js/jquery.nicescroll.plus.js"></script> 
<!--masonry--> 
<script src="{{$asset_path}}/js/masonry.pkgd.js"></script> 
<!--media queries to js--> 
<script src="{{$asset_path}}/js/enquire.js"></script> 
<!--custom functions--> 
<script src="{{$asset_path}}/js/custom-fun.js"></script>

@yield('after')

</body>
</html>