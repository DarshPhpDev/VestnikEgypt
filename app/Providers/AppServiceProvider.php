<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;
use App;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layout', function( $view ){
            $locale = App::getLocale();
            $recent_posts = \App\Post::whereHas('translations',function($q) use($locale){$q->where('locale',$locale);})->orderBy('id','DESC')->take(3)->get();
            $view->with( 'recent_posts', $recent_posts );
        } );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
