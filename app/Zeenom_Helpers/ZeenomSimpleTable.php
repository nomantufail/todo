<?php
/**
 * Created by Zeenomlabs.
 * User: ZeenomLabs
 * Date: 4/29/15
 * Time: 9:18 PM
 */

namespace App\Zeenom_Helpers;


class ZeenomSimpleTable {
    public $objects;
    public $viewables;
    public $hiddenFromViewers;
    public $formattedHeaders;
    public $classes;

    public $money_attributes;
    public $numeric_attributes;
    public $date_attributes;
    public $addable_numeric_attributes;
    public $addable_money_attributes;

    public function __construct($objects, $viewables = null)
    {
        $this->objects = $objects;
        $this->setHiddenFromViewers();
        $this->setViewables($viewables);
        $this->setFormattedHeaders();
        $this->classes ="table";

        $this->money_attributes = array();
        $this->numeric_attributes = array();
        $this->date_attributes = array();
        $this->addable_numeric_attributes = array();
        $this->addable_money_attributes = array();
    }

    public function setViewables($viewables)
    {
        if($viewables != null)
        {
            $this->viewables = $viewables;
        }
        else
        {
            if(sizeof($this->objects) > 0)
            {
                $viewables = array();
                if(method_exists($this->objects[0], 'getViewables') && sizeof($this->objects[0]->getViewables()) > 0)
                {
                    foreach($this->objects[0]->getViewables() as $v)
                    {
                        if(!in_array($v, $this->get_hiddenFromViewers_properties()))
                            array_push($viewables, $v);
                    }
                    $viewables = $this->objects[0]->getViewables();
                }
                else
                {
                    $arr = $this->objects[0]->toArray();

                    foreach($arr as $key => $value)
                    {
                        if(!in_array($key, $this->get_hiddenFromViewers_properties()))
                            array_push($viewables, $key);
                    }
                }

                $this->viewables = $viewables;
            }
            else
            {
                $this->viewables = null;
            }
        }
    }
    public function setHiddenFromViewers($hidden = null)
    {
        if($hidden != null)
        {
            $this->hiddenFromViewers = $hidden;
        }
        else
        {
            if(sizeof($this->objects) > 0)
            {
                $hidden = array();
                if(method_exists($this->objects[0], 'getHiddenFromViewers') && sizeof($this->objects[0]->getHiddenFromViewers()) > 0)
                {
                    $hidden = $this->objects[0]->getHiddenFromViewers();
                }

                $this->hiddenFromViewers = $hidden;
            }
            else
            {
                $this->hiddenFromViewers = null;
            }
        }
    }

    public function setFormattedHeaders($formattedHeaders = null)
    {
        if($formattedHeaders != null)
        {
            $this->formattedHeaders = $formattedHeaders;
        }
        else
        {
            if(sizeof($this->objects) > 0)
            {
                $model_defined_formatted_headers = array();
                if(method_exists($this->objects[0], 'getFormattedHeaders'))
                    $model_defined_formatted_headers = $this->objects[0]->getFormattedHeaders();

                $formattedHeaders = array();
                foreach($this->viewables as $viewable)
                {
                    $formattedHeaders[$viewable] = (isset($model_defined_formatted_headers[$viewable]))?$model_defined_formatted_headers[$viewable]: $this->beautify_property($viewable);
                }
                $this->formattedHeaders = $formattedHeaders;
            }
            else
            {
                $this->formattedHeaders = null;
            }
        }
    }

    public function get_viewable_properties()
    {
        return $this->viewables;
    }
    public function get_hiddenFromViewers_properties()
    {
        return $this->hiddenFromViewers;
    }
    public function get_formatted_version($property)
    {
        $formatted = $property;
        $formattedProperties = $this->formattedHeaders;
        if(array_key_exists($property, $formattedProperties))
        {
            $formatted = $formattedProperties[$property];
        }
        else{
            $formatted = ucwords(explode_camelCase($property));
        }
        return $formatted;
    }
    /**
     * @param mixed $date_attributes
     */
    public function setDateAttributes($date_attributes)
    {
        $this->date_attributes = $date_attributes;
    }

    /**
     * @param mixed $money_attributes
     */
    public function setMoneyAttributes($money_attributes)
    {
        $this->money_attributes = $money_attributes;
    }

    /**
     * @param mixed $numeric_attributes
     */
    public function setNumericAttributes($numeric_attributes)
    {
        $this->numeric_attributes = $numeric_attributes;
    }

    /**
     * @param mixed $addable_numeric_attributes
     */
    public function setAddableNumericAttributes($addable_numeric_attributes)
    {
        $this->addable_numeric_attributes = $addable_numeric_attributes;
    }
    /**
     * @param mixed $addable_money_attributes
     */
    public function setAddableMoneyAttributes($addable_money_attributes)
    {
        $this->addable_money_attributes = $addable_money_attributes;
    }


    /**
     * First we check if there exists a helper function
     * to display this property in the model class
     * if exists such function
     *          we call that function
     * if not exists
     *          we simply display the property
     **/
    public function get_viewable_value(&$object, $property)
    {
        $viewable_value = '';
        $property_getter = $this->property_getter_name($property);
        if(method_exists($object,$property_getter)){
            $viewable_value = $object->$property_getter();
        }
        else{
            $viewable_value = $object->$property;
        }
        return $viewable_value;
    }

    public function process_property($object, $property)
    {
        $viewable_value = $this->get_viewable_value($object, $property);
        if(in_array($property, $this->get_money_properties()))
        {
            $viewable_value = rupee_format($viewable_value);
        }
        if(in_array($property, $this->get_addable_properties()))
        {
            $total_property_name = "total_".$property;
            $this->$total_property_name = (isset($this->$total_property_name))?$this->$total_property_name + $viewable_value:0 + $viewable_value;
            $viewable_value = rupee_format($viewable_value);
        }
        if(gettype($viewable_value) == 'object' && get_class($viewable_value) == 'Carbon\Carbon')
        {
            $viewable_value = $viewable_value->toFormattedDateString();
        }

        return $viewable_value;
    }

    public function get_footer_value_of($property)
    {
        $viewable_value = "";
        $total_property_name = "total_".$property;
        if(in_array($property, $this->money_attributes))
        {
            //$viewable_value = rupee_format($this->$total_property_name);
        }
        else if(in_array($property, $this->addable_money_attributes))
        {
            $viewable_value = rupee_format($this->$total_property_name);
        }
        else if(in_array($property, $this->addable_numeric_attributes))
        {
            $viewable_value = $this->$total_property_name;
        }
        else if(in_array($property, $this->numeric_attributes))
        {

        }
        else if(in_array($property, $this->date_attributes))
        {

        }
        else
        {
            $viewable_value = "";
        }
        return $viewable_value;
    }
    public function property_getter_name($property)
    {
        $property = ucfirst($property);
        $property_getter = "get".$property."_VIEW";
        return $property_getter;
    }
    public function get_addable_properties()
    {
        $properties = null;
        $objects = $this->objects;
        if(sizeof($objects) > 0)
        {
            $object = $objects[0];
            if(method_exists($object, 'get_addable_properties'))
                $properties = $object->get_addable_properties();
            else
                $properties = array();
        }
        return $properties;
    }

    public function get_money_properties()
    {
        $properties = null;
        $objects = $this->objects;
        if(sizeof($objects) > 0)
        {
            $object = $objects[0];
            if(method_exists($object, 'get_money_properties'))
                $properties = $object->get_money_properties();
            else
                $properties = array();
        }
        return $properties;
    }

    public  function beautify_property($property)
    {
        $p_parts = explode('_',$property);
        $property = join(' ',$p_parts);
        $property = ucwords($property);
        return $property;
    }

    public function noRecordFound()
    {
        echo"No Record Found";
    }
    public function header()
    {
        $header = "";
        $header.="<thead class='table_header'>";
        $header.= "<tr class='table_row table_header_row'>";
        foreach($this->get_viewable_properties() as $property)
        {
            $header.= sortable_header($property,'string',$this->get_formatted_version($property));
        }
        $header.= "</tr>";
        $header.= "</thead>";
        return $header;
    }
    public function body()
    {
        $body = "";
        $body.="<tbody class='table_body'>";
            foreach($this->objects as $object)
            {
                $body.= "<tr>";
                foreach($this->get_viewable_properties() as $property)
                {
                    $property_getter = $this->property_getter_name($property);
                    $body.= "<td>";
                    $body.= $this->process_property($object, $property);
                    $body.= "</td>";

                }
                $body.= "</tr>";
            }

        $body.= "</tbody>";
        return $body;
    }
    public function footer()
    {
        $footer = "";
        $footer.="<tfoot class='table_footer'>";

        if(sizeof($this->get_addable_properties())>0)
        {
            $footer.= "<tr class='table_footer_row table_footer_row_totals'>";
            foreach($this->get_viewable_properties() as $property)
            {
                $footer.= "<th>";
                $footer.= $this->get_footer_value_of($property);
                $footer.= "</th>";
            }
            $footer.= "</tr>";
        }

        $footer.= "</tfoot>";
        return $footer;
    }
    public function draw()
    {
        if(sizeof($this->objects) > 0)
        {
            echo "<table class='".$this->classes." my_table list_table table-bordered'>";
            echo $this->header();
            echo $this->body();
            echo $this->footer();
            echo "</table>";
        }
        else
        {
            $this->noRecordFound();
        }
    }
} 