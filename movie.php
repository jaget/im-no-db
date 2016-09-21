<?php

include_once('ModelInterface.php');
include_once('Modelable.php');

class Movie implements ModelInterface {
    use Modelable{
        Modelable::__construct as private _modelConstruct;
    }

    function __construct()
    {
        $this->_modelConstruct();
        $this->setData('title');
        $this->setData('runtime');
        $this->setData('release');
    }

    public function validate()
    {
        $allRulesPass = true;
        //In real life I would validate values against whether they have been set, whether lenght is in acceptable min and max range and against regex for things such as emails or telephone.

        foreach($this->getDataFields() as $field){
            $validationFunction = 'validate' . $field;
            if(method_exists($this, $validationFunction)){
                if(!$this->$validationFunction())//each of these functions would return boolean
                {
                    $allRulesPass = false;
                }
            }else{
                $allRulesPass = false;//I assume we would want to validate every field.
            }
        }
        return $allRulesPass;
    }

    public function starringActors(){
        //MYSQL or DB function
        //pseudo code would be
        //SELECT * FROM actor_movie where movie.id = $this->ID, join actors on actor.id = actor_movie.id
        //return result.
    }

    public function actorsByAge(){
        $starringActors = $this->starringActors();
        return usort($starringActors, function($a, $b){
            return strtotime($a->age() > $b->age());
        });
    }

}

$actor  = new Movie();
echo $actor->validate();
echo $actor->toJson();