<?php

class Children extends ChildrenAll
{
    protected $age;

//    private $childrenArray;


    public function __construct($childName, $childGender, $childAge)
    {
        parent::__construct($childName, $childGender, $childAge);// kas cia negerai
//        $this->childrenArray = $array;
    }

    /**
     * @return mixed
     */
//    public function getChildrenArray()
//    {
//        return $this->childrenArray;
//    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getGender()
    {
        return $this->gender;
    }


//    Implementuoti metodus iš tėvinės klasės (“į kokią mokyklą eis” ir “objektas į masyvą”)
//    darželį, pradinę, vidurinę, pagrindinę

    public function checkWhatChildAttends()
    {
//        foreach ($this->childrenArray as $childFromArray) {
        if ($this->getAge() <= 7) {
            echo "{$this->getName()} i darzeli <br>";
        } elseif ($this->getAge() > 7 && $this->getAge() <= 10) {
            echo "{$this->getName()} i pradine <br>";
        } elseif ($this->getAge() > 10 && $this->getAge() <= 15) {
            echo "{$this->getName()} i pagrindine <br>";
        } elseif ($this->getAge() > 15 && $this->getAge() <= 19) {
            echo "{$this->getName()} i vidurine <br>";
        } else {
            echo "kazkas negerai";
        }
//        }

    }

    public
    function convertObjectToArray()
    {
        $convertedArr = [
            'name' => $this->getName(),
            'gender' => $this->getGender(),
            'age' => $this->getAge(),

        ];
        return $convertedArr;
    }

}


?>