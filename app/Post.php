<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;
class Post extends Model implements HasMedia
{
    use HasMediaTrait;
	use \Dimsav\Translatable\Translatable;
	protected $table = 'posts';
    public $translatedAttributes = ['title','body'];
    protected $fillable = ['slider','urgent','user_id','category_id','author_name','author_gender','seen'];

    public function author(){
    	return $this->belongsTo('App\User','user_id');
    }

    public function category(){
    	return $this->belongsTo('App\Category','category_id');
    }

    public function comments(){
        return $this->hasMany('App\Comment','post_id');
    }
}
