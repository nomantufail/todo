<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends ParentModel
{
    //

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tasks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * this property knows the money format you gonna use for your
     * monetry attributes
     **/
    public $money_format = 'rupee';

    /**
     * this function returns date properties of this model
     **/
    public function getDates()
    {
        return ['created_at','updated_at'];
    }

    /**
     * this function returns properties which will
     * be shown in the view table
     **/
    public function getViewables()
    {
        return array();
    }

    /**
     * this function returns properties which must
     * not be shown in the view table
     **/
    public function getHiddenFromViewers()
    {
        return array('created_at','updated_at');
    }

    /**
     * this function returns array of formatted text of headers
     **/
    public function getFormattedHeaders()
    {
        return array(
            'id'=>'Id'
        );
    }

    /**
     * this function returns those properties which are
     * addable and there sums will be shown
     * in the footer of the table.
     **/
    /*public function get_addable_properties()
    {
        return array();
    }*/

    /**
     * this function returns those properties which
     * are money and will be displayed in money formats
     **/
    /*public function get_money_properties()
    {
        return array();
    }*/

    /**
     * below function returns the formatted value of a property
     **/
    public function getId_VIEW()
    {
        return ucfirst($this->id);
    }
}
