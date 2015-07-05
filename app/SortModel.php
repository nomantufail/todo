<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SortModel extends ParentModel
{
    //

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sort';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['view','by','order'];

    /**
     * below function returns the formatted value of a property
     **/
    public function getId_VIEW()
    {
        return $this->id;
    }
}
