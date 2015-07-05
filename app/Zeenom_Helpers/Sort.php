<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 7/5/2015
 * Time: 1:09 AM
 */

namespace App\Zeenom_Helpers;


class Sort {

    protected $by;
    protected $order;
    protected $default_by;
    protected $default_order;
    protected $table;

    public function __construct($table = null)
    {
        $this->table = $table;
        $this->default_by = 'id';
        $this->default_order = 'asc';

        $this->setSortingInfo();
    }

    public function setSortingInfo()
    {
        if(isset($_GET['sort_by']) && $_GET['sort_by'] != '')
        {
            $this->by = $_GET['sort_by'];
        }
        if(isset($_GET['order']) && $_GET['order'] != '')
        {
            if($_GET['order'] == 'desc')
                $this->order = $_GET['order'];
            else
                $this->order = 'asc';
        }
    }

    /**
     * @return mixed
     */
    public function by()
    {
        return $this->by;
    }

    /**
     * @return string
     */
    public function defaultBy()
    {
        return $this->default_by;
    }

    /**
     * @return string
     */
    public function defaultOrder()
    {
        return $this->default_order;
    }

    /**
     * @return mixed
     */
    public function order()
    {
        return $this->order;
    }

    public function multi()
    {

    }

} 