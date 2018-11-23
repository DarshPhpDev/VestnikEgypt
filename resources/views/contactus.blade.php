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

<section>
    <div class="container ">
      <div class="row "> 
        <!-- left sec Start -->
        <div class="col-sm-16">
          <div class="row">
            <div class="col-sm-16">
              <div class="row">
                <div class="col-sm-11">
                <div class="main-title-outer">
                  <div class="main-title pull-{{$align}}">{{__('messages.Be in touch')}}</div>
                </div>
                  <form action="{{route('contactus_send')}}" method="post" class="comment-form">
                          {{ csrf_field() }}
                      <div class="row">
                        @if(!Auth::user())
                        <div class="form-group col-sm-16 name-field pull-{{$align}}">
                          <input type="text" name="author" placeholder="{{__('messages.Name')}}" required="" class="form-control" dir="{{$dir}}">
                        </div>
                        <div class="form-group col-sm-16 email-field pull-{{$align}}">
                          <input type="email" name="email" placeholder="{{__('messages.Email')}}" required="" class="form-control" dir="{{$dir}}">
                        </div>
                        @endif
                        <div class="form-group col-sm-16 name-field pull-{{$align}}">
                          <input type="text" name="title" placeholder="{{__('messages.Title')}}" required="" class="form-control" dir="{{$dir}}">
                        </div>
                        <div class="form-group col-sm-16">
                          <textarea placeholder="{{__('messages.Your Message')}}" rows="8" class="form-control" required="" id="message" name="body" dir="{{$dir}}"></textarea>
                        </div>
                      </div>
                      <div class="form-group">
                        <button class="btn btn-danger" type="submit">{{__('messages.Send Message')}}</button>
                      </div>
                    </form>
                </div>
                <div class="col-sm-4  adress">
{{--                   <address>
                  <strong>Adress</strong><br>
                  795 Folsom Ave, Suite 600<br>
                  San Francisco, CA 94107<br>
                  Phone: (123) 456-7890
                  </address> --}}
                  <address>
                  <strong>{{__('messages.Advertising mail')}}</strong><br>
                  <a href="mailto:vestniknewspaper@gmail.com">vestniknewspaper@gmail.com</a>
                  </address>
                  <strong>Social</strong><br>
                  <ul class="list-inline">
                    <li><a target="_blank" href="http://twitter.com/vestnikegypt"><span class="ion-social-twitter"></span></a></li>
                    <li><a target="_blank" href="http://facebook.com/vestnikegypt"><span class="ion-social-facebook"></span></a></li>
                    <li><a target="_blank" href="http://instagram.com/vestnikegypt"><span class="ion-social-instagram"></span></a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- left sec End --> 
        
      </div>
    </div>
  </section>

  @endsection