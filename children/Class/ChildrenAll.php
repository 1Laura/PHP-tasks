<?php

abstract class ChildrenAll
{
    protected $name;
    protected $gender;



    //konstruktorius
    public function __construct($childName, $childGender, $childAge)
    {
        $this->name = $childName;
        $this->gender = $childGender;
        $this->age = $childAge;
    }

    //Metodas, kuris patikrins į kurią mokyklą (darželį, pradinę, vidurinę, pagrindinę ir t.t.) mažylis eina;
    abstract public function checkWhatChildAttends();

    //Bonus metodas, kuris pavers objektą į masyvą
    abstract public function convertObjectToArray();
}

?>