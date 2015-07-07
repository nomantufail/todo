<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Zeenom_Helpers\Sort;

class ParentModel extends Model
{
    protected $viewables;
    protected $mustBeHidden = ['deleted_at'];
    protected $defaultHiddenProperties = ['updated_at','created_at'];
    protected $hiddenFromViewers;
    protected $dates = ['created_at','updated_at'];
    protected $addableProperties = [];
    protected $moneyAttributes = [];
    protected $sortableColumns = [];
    public $editDelete = true;

    /**
     * this property knows the money format you gonna use for your
     * monetry attributes
     **/
    public $money_format = 'rupee';

    /**
     * this function gives us all the the column names in
     * the table.
     *
     * ******************* IMPORTANT ****************************
     * We recommend you to define an array of viewables in your
     * model and explicitly list all your column names in that array.
     * it will increase your system speed.
     * **************************************************************
     **/
    public function getProperties()
    {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
    /* ------------------------------------------------------------------------- */

    /**
     * this function returns date properties of this model
     **/
    public function getDates()
    {
        return $this->dates;
    }
    public function setDates($dates)
    {
        $this->dates = array_merge($this->dates, $dates);
    }

    /**
     * this function get the view able columns for the html table
     * @return mixed
     */
    public function getViewables()
    {
        if($this->viewables == null)
        {
            return array();
        }

        return $this->viewables;
    }

    /**
     * @param mixed $viewables
     */
    public function setViewables($viewables)
    {
        $this->viewables = $viewables;
    }

    /**
     * this function returns properties which must
     * not be shown in the view table
     **/
    public function getHiddenFromViewers()
    {
        if($this->getHiddenProperties() == null)
        {
            return array_merge($this->getMustBeHidden(), $this->getDefaultHiddenProperties());
        }
        return array_merge(array_merge($this->getMustBeHidden(), $this->getHiddenProperties()), $this->getDefaultHiddenProperties());
    }

    /**
     * this function returns properties which must
     * not be shown in the view table
     **/
    public function setHiddenFromViewers($hidden)
    {
        $this->hiddenFromViewers = $hidden;
    }

    /**
     * @return mixed
     */
    public function getDefaultHiddenProperties()
    {
        return $this->defaultHiddenProperties;
    }

    /**
     * @param mixed $defaultHiddenProperties
     */
    public function setDefaultHiddenProperties($defaultHiddenProperties)
    {
        $this->defaultHiddenProperties = $defaultHiddenProperties;
    }

    /**
     * @return array
     */
    public function getMustBeHidden()
    {
        return $this->mustBeHidden;
    }

    /**
     * @param array $mustBeHidden
     */
    public function setMustBeHidden($mustBeHidden)
    {
        $this->mustBeHidden = $mustBeHidden;
    }

    /**
     * this function returns those properties which are
     * addable and there sums will be shown
     * in the footer of the table.
     **/

    public function get_addable_properties()
    {
        return $this->addableProperties;
    }

    public function set_addable_properties($addable_properties)
    {
        $this->addableProperties = $addable_properties;
    }

    /**
     * this function returns those properties which
     * are money and will be displayed in money formats
     **/
    public function get_money_properties()
    {
        return $this->moneyAttributes;
    }
    public function set_money_properties($money_properties)
    {
        $this->moneyAttributes = $money_properties;
    }

    /**
     * @return array
     */
    public function getSortableColumns()
    {
        if(sizeof($this->sortableColumns) == 0)
        {
            if(sizeof($this->getViewables())  == 0)
            {
                $sortable_columns = $this->getProperties();
                $this->setSortableColumns($sortable_columns);
                return $sortable_columns;
            }
            $sortable_columns = $this->getViewables();
            $this->setSortableColumns($sortable_columns);
            return $sortable_columns;
        }
        return $this->sortableColumns;
    }

    /**
     * @param array $sortableColumns
     */
    public function setSortableColumns($sortableColumns)
    {
        $this->sortableColumns = $sortableColumns;
    }

    public function scopeSort($query)
    {
        $sort = new Sort($this->table);
        $sortable_columns = $this->getSortableColumns();
        if($sort->by() != '')
        {
            if(in_array($sort->by(), $sortable_columns))
                return $query->orderBy($sort->by(), $sort->order());
        }

        $sort_model = new SortModel();
        $columns = $sort_model->where('view','=',$this->table)->get(['id','view','sort_by','order_by']);
        if(sizeof($columns) > 0)
        {
            foreach($columns as $column)
            {
                $query = $query->orderBy($column->sort_by,$column->order_by);
            }
            return $query;
        }
        return $query->orderBy($sort->defaultBy(),$sort->defaultOrder());
    }

}
