<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;
class Media extends Model implements HasMedia
{
    use HasMediaTrait;

    protected $table = 'images_videos';

    protected $fillable = ['type','title_ar','title_ru','body_ar','body_ru'];
    
}
