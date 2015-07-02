<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
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
    protected $fillable = ['task', 'start_date', 'end_date', 'user_id'];

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
        return ['created_at','updated_at', 'start_date','end_date'];
    }

    /**
     * this function returns properties which will
     * be shown in the view table
     **/
    public function getViewables()
    {
        return array(
            'id',
            'task',
            'start_date',
            'end_date',
        );
    }

    /**
     * this function returns formatted text of headers
     **/
    public function getFormattedHeaders()
    {
        return array(
            'id'=>'Task#',
            'task'=>'Task',
            'start_date'=>'Start Date',
            'end_date'=>'End Date',
        );
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
     * below function returns the formatted value of a property
     **/
    public function getTask_VIEW()
    {
        return ucfirst($this->task);
    }
}
