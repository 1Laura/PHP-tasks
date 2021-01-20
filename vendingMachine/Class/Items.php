<?php

class Items
{
    private $title;
    private $id;
    private $quantity;
    private $price;

    //konstruktorius
    public function __construct($whatId, $whatTitle, $whatIsQuantity, $whatIsPrice)
    {
        $this->title = $whatTitle;
        $this->quantity = $whatIsQuantity;
        $this->price = $whatIsPrice;
        $this->id = $whatId; //'item_' . rand();
    }

    //geteriai, kad gauti info
    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    //sumazinam kieki
    public function minusOneQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

}


?>