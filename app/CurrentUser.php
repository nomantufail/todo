<?php
/**
 * Created by PhpStorm.
 * User: zeenomlabs
 * Date: 7/7/2015
 * Time: 3:46 AM
 */

namespace App;
use Illuminate\Database\Eloquent\Model;

class CurrentUser extends Model{

    public function __construct(User $user)
    {
        
    }

}