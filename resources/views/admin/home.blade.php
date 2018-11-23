@extends('admin.app')


@section('content')

<div class="row">
          <div class="col-lg-12">
            <h1>Dashboard</h1>

            <div class="alert alert-success alert-dismissable">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              Welcome to VestnikEgypt Admin Panel by <a class="alert-link" href="https://www.facebook.com/freera4bia" target="_blank">MUSTAFA AHMED</a> and <a class="alert-link" href="" target="_blank">Tester Esraa Osama </a> .. Feel free to ask me if you have any questions.
            </div>
          </div>
        </div><!-- /.row -->

        <div class="row">
        <a href="{{route('users.index')}}">

          <div class="col-lg-3">
            <div class="panel panel-info">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-6">
                    <i class="fa fa-users fa-5x"></i>
                  </div>
                  <div class="col-xs-6 text-right">
                    <p class="announcement-heading">{{$users_count-1}}</p>
                    <p class="announcement-text">Users!</p>
                  </div>
                </div>
              </div>
            </div>
            </a>
          </div>
          <a href="{{route('news.index')}}">
          <div class="col-lg-3">
            <div class="panel panel-danger">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-6">
                    <i class="fa fa-tasks fa-5x"></i>
                  </div>
                  <div class="col-xs-6 text-right">
                    <p class="announcement-heading">{{$news_count}}</p>
                    <p class="announcement-text">News!</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          </a>
          <div class="col-lg-3">
            <div class="panel panel-success">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-6">
                    <i class="fa fa-comments fa-5x"></i>
                  </div>
                  <div class="col-xs-6 text-right">
                    <p class="announcement-heading">{{$comments_count}}</p>
                    <p class="announcement-text">Comments!</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <a href="{{route('messages.inbox')}}">
          <div class="col-lg-3">
            <div class="panel panel-default">
              <div class="panel-heading">
                <div class="row">
                  <div class="col-xs-6">
                    <i class="fa fa-envelope fa-5x"></i>
                  </div>
                  <div class="col-xs-6 text-right">
                    <p class="announcement-heading">{{$messages_count}}</p>
                    <p class="announcement-text">Messages!</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          </a>
        </div><!-- /.row -->

@endsection