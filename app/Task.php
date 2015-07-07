<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Task extends ParentModel
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tasks';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['user_id','task','start_date','end_date'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * this function get the view able columns for the html table
     * @return mixed
     */
    public function getViewables()
    {
        return array();
    }

    public function getDates()
    {
        return ['created_at','updated_at','start_date','end_date'];
    }

    /**
     * this function returns those properties which are
     * addable and there sums will be shown
     * in the footer of the table.
     **/

    public function get_addable_properties()
    {
        return array();
    }

    /**
     * this function returns those properties which
     * are money and will be displayed in money formats
     **/
    public function get_money_properties()
    {
        return array();
    }

    /**
     * this function returns those properties
     * which are hidden from viewers
     **/
    public function getHiddenProperties()
    {
        return array('user_id');
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
     * this function returns array of formatted text of headers
     **/
    public function getEditDelete()
    {
        return true;
    }

    /**
     * below function returns the formatted value of a property
     **/
    public function getId_VIEW()
    {
        return $this->id;
    }
}
