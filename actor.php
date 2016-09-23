<?php

include_once('ModelInterface.php');
include_once('Modelable.php');

class Actor implements ModelInterface {
    use Modelable {
        Modelable::__construct as private _modelConstruct;
    }

    function __construct()
    {
        $this->_modelConstruct();
        $this->setData('name');
        $this->setData('date of birth');
    }

    public function validate()
    {
        $allRulesPass = true;
        //In real life I would validate values against whether they have been set, whether lenght is in acceptable min and max range and against regex for things such as emails or telephone.

        foreach($this->getDataFields() as $field){
            $validationFunction = 'validate' . $field;
            if(! $this->$validationFunction()){//each of these functions would return boolean
                $allRulesPass = false;
            }
        }
        return $allRulesPass;
    }

    public function setName($value) {
        //TODO validate this field
        $this->setData('name', $value);
    }

    public function getName() {
        return $this->getData('name');
    }

    public function setDob($value) {
        //TODO validate this field
        $this->setData('date of birth', $value);
    }

    public function getDob() {
        $this->getData('date of birth');
    }

    public function age(){
        return date_diff(strtotime($this->getDob()), time());
    }

    public function getRolePlayed(){
        //There would likely be a link entity in the database to link movie and actor together.
        //It could be reasonable to assume or to design the database such that the role played by an actor in a film is stored in a field.
        //Using an orm to optimize mysql queries with lazy loading to resolve the N+1 issue you would return the 'role' field here.

        //something like
        //return $this->actor_movie->rolePlayed
        return '$this->actor_movie->rolePlayed';
    }

}