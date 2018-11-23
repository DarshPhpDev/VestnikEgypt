<!DOCTYPE html>
<?php
$asset_path = URL::asset('public/assets');
$rtl = '';
$rtl_prefix = '';
if (config('app.locale') == 'ar') {
    $rtl = 'rtl';
    $rtl_prefix = '-rtl';
}
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>VestnikEgypt Admin Panel</title>
<link rel="shortcut icon" href="{{$asset_path}}/images/favicon.ico" type="image/x-icon">
<link rel="icon" href="{{$asset_path}}/images/favicon.ico" type="image/x-icon">
    <!-- Bootstrap core CSS -->
    <link href="{{$asset_path}}/admin/css/bootstrap.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="{{$asset_path}}/admin/css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="{{$asset_path}}/admin/font-awesome/css/font-awesome.min.css">
    <!-- Page Specific CSS -->
    <link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">
    <link href="{{$asset_path}}/admin/css/summernote.css" rel="stylesheet">
    
  </head>

  <body>

    <div id="wrapper">

      <!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="{{ route('admin.home') }}">VestnikEgypt Admin</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">
            <li class="{{Route::currentRouteName() == "admin.home" ? "active" : ""}}"><a href="{{route('admin.home')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            <li><a href="{{route('news.index')}}"><i class="fa fa-bars"></i> News</a></li>
            <li><a href="{{route('news.urgent')}}"><i class="fa fa-bars"></i> Urgent News</a></li>
            
            <?php
              $active_open = (Route::currentRouteName() == "users.index" || Route::currentRouteName() == "users.create" || Route::currentRouteName() == "users.edit") ? "open" : "";
              $style1 = (Route::currentRouteName() == "users.index") ? "color: #fff;background-color: #3a3939;" : "";
              $style2 = (Route::currentRouteName() == "users.create") ? "color: #fff;background-color: #3a3939;" : "";
              $style3 = (Route::currentRouteName() == "users.role") ? "color: #fff;background-color: #3a3939;" : "";
  
            ?>
            <li class="dropdown {{$active_open}}">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-users"></i> Roles & Users <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a style="{{$style1}}" href="{{route('users.index')}}"><i class="fa fa-eye"></i> Show/Edit Users</a></li>
                <li><a style="{{$style2}}" href="{{route('users.create')}}"><i class="fa fa-plus"></i> Add New User</a></li>
                <li><a style="{{$style3}}" href="{{route('users.role')}}"><i class="fa fa-key"></i> Change User Role</a></li>
              </ul>
            </li>
{{--             <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog"></i> Settings <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Dropdown Item</a></li>
                <li><a href="#">Another Item</a></li>
                <li><a href="#">Third Item</a></li>
                <li><a href="#">Last Item</a></li>
              </ul>
            </li> --}}
{{--             <li><a href="charts.html"><i class="fa fa-comment-o"></i> Admin  Updates</a></li> --}}
            <li><a href="{{route('homepage')}}"><i class="fa fa-arrow-left"></i> Go back to vestnikegypt</a></li>
          </ul>
          <?php
            $messages = \App\Message::where('seen',0)->get();
            $messages_count = $messages->count();
          ?>
          <ul class="nav navbar-nav navbar-right navbar-user">
            <li class="dropdown messages-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-envelope"></i> Messages <span class="badge">{{$messages_count}}</span> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li class="dropdown-header">{{$messages_count}} New Messages</li>

                @foreach($messages as $message)
                <li class="message-preview">
                  <a href="{{route('messages.show',$message->id)}}">
                    {{-- <span class="avatar"><img src="http://placehold.it/50x50"></span> --}}
                    <span class="name">{{$message->user_id ? $message->user->name : 'Visitor'}}</span>
                    <span class="message">{{$message->title}}</span>
                    <span class="time"><i class="fa fa-clock-o"></i> {{$message->created_at}}</span>
                  </a>
                </li>
                <li class="divider"></li>
                @endforeach
                <li><a href="{{route('messages.inbox')}}">View Inbox <span class="badge">{{$messages_count}}</span></a></li>
              </ul>
            </li>
{{--             <li class="dropdown alerts-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> Alerts <span class="badge">3</span> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="#">Default <span class="label label-default">Default</span></a></li>
                <li><a href="#">Primary <span class="label label-primary">Primary</span></a></li>
                <li><a href="#">Success <span class="label label-success">Success</span></a></li>
                <li><a href="#">Info <span class="label label-info">Info</span></a></li>
                <li><a href="#">Warning <span class="label label-warning">Warning</span></a></li>
                <li><a href="#">Danger <span class="label label-danger">Danger</span></a></li>
                <li class="divider"></li>
                <li><a href="#">View All</a></li>
              </ul>
            </li> --}}
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> {{Auth::user()->name}} <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="{{route('homepage')}}"><i class="fa fa-arrow-left"></i> Go back to vestnikegypt</a></li>
                <li class="divider"></li>
                <li><a href="{{route('logout')}}"><i class="fa fa-power-off"></i> Log Out</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>

      <div id="page-wrapper">

        @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
        @endif
        @if(Session::has('message-danger'))
        <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('message-danger') }}</p>
        @endif
        @if(Session::has('message-success'))
        <p class="alert {{ Session::get('alert-class', 'alert-success') }}">{{ Session::get('message-success') }}</p>
        @endif
        @yield('content')

      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

    <!-- JavaScript -->
    <script src="{{$asset_path}}/admin/js/jquery-1.10.2.js"></script>
    <script src="{{$asset_path}}/admin/js/bootstrap.js"></script>
    <script src="{{$asset_path}}/admin/js/summernote.js"></script>
    <!-- Page Specific Plugins -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>
    <script src="{{$asset_path}}/admin/js/morris/chart-data-morris.js"></script>
    <script src="{{$asset_path}}/admin/js/tablesorter/jquery.tablesorter.js"></script>
    <script src="{{$asset_path}}/admin/js/tablesorter/tables.js"></script>
{{--     <script src="../../../vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
     '/vendor'; --}}
    @yield('after')
  </body>
</html>
