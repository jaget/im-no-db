<?php
trait Modelable {
    protected $data = array();

    public function __construct()
    {
        $this->setData('id');//likely data mapping would come from a database model. Including ID.
    }

    function toJson()
    {
        return json_encode($this->data);
    }

    function setData($field, $value = null)
    {
        $this->data[$field] = ($value) ? $value : '' ;
    }

    function getData($field)
    {
        //could instead use magic methods such as __get
        if(isset($this->data[$field])){
            return $this->data[$field];
        }else{
            return null;
        }
    }

    function getDataFields(){
        return array_keys($this->data);
    }
}