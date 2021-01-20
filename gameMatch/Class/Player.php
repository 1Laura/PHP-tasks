<?php

class Player
{
    private $name;
    private $lastName;
    private $height;
    private $position;
    private $shirtNumber;

    public function __construct()
    {
        $this->name = NAMES[array_rand(NAMES)];
        $this->lastName = SURNAMES[array_rand(SURNAMES)];
        $this->height = rand(170, 230);
        $this->position = POSITION_TYPES[array_rand(POSITION_TYPES)];
        $this->shirtNumber = rand(1, 999);
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
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @return mixed
     */
    public function getHeigth()
    {
        return $this->height;
    }

    /**
     * @return mixed
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @return mixed
     */
    public function getShirtNumber()
    {
        return $this->shirtNumber;
    }


}


?>