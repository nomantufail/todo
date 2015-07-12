<?php

namespace App;

use App\Zeenom_Helpers\RouteHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class Customer extends ParentModel
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customers';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [];

    public function getDates()
    {
        return ['created_at','updated_at'];
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    /* -----------------------------------------------------------------------------------\
     *              OPTIONAL CUSTOMIZABLE AREA STARTS
     * ----------------------------------------------------------------------------------*/
    
    /**
     * this function get the view able columns for the html table
     * @return mixed
     */
    public function getViewables()
    {
        return array();
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

    /** ------------------------------- ACTIONS AREA STARTS HERE ----------------------------- **/
    /* ---------- All your actions markup e.g(delete, edit) resides here) ------------*/
    public function getActions()
    {
        $markup = '';

        $markup.= $this->getEdit();
        $markup.= " | ";
        $markup.= $this->getDelete();

        return $markup;
    }

    /**
     * this function returns array of formatted text of headers
     **/
    public function getEdit()
    {
        return $this->_getEdit($this->getEditRoute(), $this->getEditText());
    }
    public function getDelete()
    {
        return $this->_getDelete($this->getDeleteRoute(), $this->getDeleteText());
    }

    public function getEditRoute()
    {
        return RouteHelper::site()."customers/edit/".$this->id;
    }
    public function getDeleteRoute()
    {
        return RouteHelper::site()."customers/delete/".$this->id;
    }
    public function getEditText()
    {
        return 'Edit';
    }
    public function getDeleteText()
    {
        return 'Del';
    }
    /*------------------------------- Actions Markup Ends -------------------------------------------*/

    /**
     * below function returns the formatted value of a property
     **/
    /*public function getId_VIEW()
    {
        return $this->id;
    }*/
}