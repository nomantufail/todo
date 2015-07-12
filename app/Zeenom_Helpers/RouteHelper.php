<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 7/12/2015
 * Time: 5:53 AM
 */

namespace App\Zeenom_Helpers;

use Illuminate\Support\Facades\Route;

class RouteHelper {

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