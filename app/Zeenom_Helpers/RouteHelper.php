<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 7/12/2015
 * Time: 5:53 AM
 */

namespace App\Zeenom_Helpers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

class RouteHelper {

    public static function site()
    {
        return URL::to('/')."/";
    }

    public static function currentController()
    {

    }

    public static function currentAction()
    {

    }

    public function getCurrentRouteInfo()
    {

        return Route::getCurrentRoute()->getAction();
    }
} 