<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	public function __construct()
    {
        $locale = session()->has('locale') ? session()->get('locale') : auth()->user()['language'];
        if(empty($locale)){
          $locale = 'ar';
        }
        app()->setLocale($locale);
	}

	public static function getYouTubeId($url)
    {
        parse_str(parse_url($url, PHP_URL_QUERY), $my_array_of_vars);
        if (isset($my_array_of_vars['v'])) {
            return $my_array_of_vars['v'];
        } else {
            return '';
        }
    }

}
