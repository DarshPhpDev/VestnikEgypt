<?php


Route::get('/', 'NewsController@Home')->name('homepage');

Route::get('/changelang/{lang}', function($lang){
            // store the locale into current session
        Session::put('locale', $lang);
        // if user is authenticated store the locale into the users table
        if(Auth::user()){
            \App\User::where('id', Auth::id())->update(['language'=>$lang]);
        }
        app()->setLocale($lang);

        return redirect()->to(route('homepage'));
})->name('changelang');

Route::get('/add_news', ['uses' => 'PostController@create' , 'as' => 'post.create','middleware'=>'auth']);
Route::post('/add_news', ['uses' => 'PostController@store' , 'as' => 'post.store','middleware'=>'auth']);

//**************
Route::get('/edit_news/{id}', ['uses' => 'PostController@edit' , 'as' => 'post.edit','middleware'=>'auth']);
Route::post('/update/{id}', ['uses' => 'PostController@update' , 'as' => 'post.update','middleware'=>'auth']);
Route::get('/destroy/{id}', ['uses' => 'PostController@destroy' , 'as' => 'post.destroy','middleware'=>'auth']);
//**************
Route::get('/show/{id}', ['uses' => 'PostController@show' , 'as' => 'post.show']);
Route::get('/cat/{id}', ['uses' => 'PostController@show_by_category' , 'as' => 'post.category']);

Route::post('/comment/{post_id}', ['uses' => 'PostController@comment' , 'as' => 'post.comment']);
Route::get('/comment/delete/{id}', ['uses' => 'PostController@commentDelete' , 'as' => 'comment.destroy']);
Route::get('/category/{id}', ['uses' => 'PostController@post_by_category' , 'as' => 'post.category']);

//contact
Route::get('/contactus', ['uses' => 'PostController@contactus' , 'as' => 'contactus']);
Route::post('/contact', ['uses' => 'PostController@contactus_send' , 'as' => 'contactus_send']);

//other routes
Route::get('/images', ['uses' => 'PostController@images' , 'as' => 'images']);
Route::post('/images/post', ['uses' => 'PostController@images' , 'as' => 'images.post']);
Route::get('/images/delete/{id}', ['uses' => 'PostController@delete_images' , 'as' => 'slider_image_delete']);

Route::get('/videos', ['uses' => 'PostController@videos' , 'as' => 'videos']);
Route::post('/videos/post', ['uses' => 'PostController@videos' , 'as' => 'videos.post']);

Route::get('/about', ['uses' => 'PostController@about' , 'as' => 'about']);
Route::any('/search', ['uses' => 'PostController@search' , 'as' => 'search']);

Auth::routes();
// Route::get('/admin', 
// 	['uses'=>'HomeController@index', 'as'=>'home', 'middleware'=>['role:admin']]
// );

Route::group(['prefix' => 'admin', 'middleware' => ['role:admin']], function() {
    Route::get('/', ['uses' => 'AdminController@index' , 'as' => 'admin.home']);
    Route::get('/admin/updates', ['uses' => 'AdminController@updates' , 'as' => 'admin.updates']);
    Route::get('/admin/inbox', ['uses' => 'AdminController@inbox' , 'as' => 'messages.inbox']);
    Route::any('/admin/inbox/reply/{id}', ['uses' => 'AdminController@replyMessage' , 'as' => 'messages.reply']);
    Route::get('/admin/inbox/{id}', ['uses' => 'AdminController@show' , 'as' => 'messages.show']);
    Route::get('/admin/inbox/delete/{id}', ['uses' => 'AdminController@destroy' , 'as' => 'messages.destroy']);


    Route::get('/users', ['uses' => 'UsersController@index' , 'as' => 'users.index']);
    Route::get('/users/create', ['uses' => 'UsersController@create' , 'as' => 'users.create']);
    Route::post('/users/store', ['uses' => 'UsersController@store' , 'as' => 'users.store']);
    Route::get('/users/edit/{id}', ['uses' => 'UsersController@edit' , 'as' => 'users.edit']);
    Route::post('/users/update/{id}', ['uses' => 'UsersController@update' , 'as' => 'users.update']);
    Route::get('/users/destroy/{id}', ['uses' => 'UsersController@destroy' , 'as' => 'users.destroy']);
    Route::get('/users/block/{id}', ['uses' => 'UsersController@block' , 'as' => 'users.block']);
    Route::get('/users/role', ['uses' => 'UsersController@role' , 'as' => 'users.role']);
    Route::get('/users/changerole/{userId}/{roleId}', ['uses' => 'UsersController@changerole' , 'as' => 'users.changerole']);


    Route::get('/news', ['uses' => 'NewsController@index' , 'as' => 'news.index']);
    
    Route::get('/news/urgent', ['uses' => 'NewsController@urgent' , 'as' => 'news.urgent']);
    Route::get('/news/changeurgent', ['uses' => 'NewsController@change_urgent' , 'as' => 'news.urgent.change']);
    
    Route::get('/news/edit/{id}', ['uses' => 'NewsController@edit' , 'as' => 'news.edit']);
    Route::post('/news/update/{id}', ['uses' => 'NewsController@update' , 'as' => 'news.update']);
    Route::get('/news/destroy', ['uses' => 'NewsController@destroy' , 'as' => 'news.destroy']);
});
