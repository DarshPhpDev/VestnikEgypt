<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['title','body','seen','user_id','author','email'];



    public function user(){
    	return $this->belongsTo('App\User','user_id');
    }
}
