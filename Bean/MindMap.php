<?php
/**
 * Created by PhpStorm.
 * User: yybutter
 * Date: 7/5/15
 * Time: 12:01 上午
 */


class MindMap {

    public $id;
    public $title;
    public $mindmap;
    public $dates;
    public $dimensions;
    public $autosave;

    public function __get($property_name)
    {
        if(isset($this->$property_name))
        {
            return($this->$property_name);
        }
        else
        {
            return(NULL);
        }
    }

    public function __set($property_name, $value)
    {
        $this->$property_name = $value;
    }

}