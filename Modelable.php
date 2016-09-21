<?php
trait Modelable {
    protected $data = array();

    public function __construct()
    {
        $this->setData('id');
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