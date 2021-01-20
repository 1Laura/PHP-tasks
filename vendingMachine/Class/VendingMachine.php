<?php

class VendingMachine
{
    private $items;

    public function __construct($itemsArr)
    {
        $this->items = $itemsArr;
    }

       public function getItems()
    {
        return $this->items;
    }

    //Sukurti *viešą metodą, kuris pagal paduotą produkto kodą, patikrins ar toks produktas egzistuoja:
    //jei taip >> grąžinamas produktas,
    //jei ne >> grąžinama false.
    //* viešas metodas tik šiai užduočiai, vėliau pasidaryti private.

    private function ifItemExists($itemCode)
    {
        foreach ($this->items as $itemFromArray) {
            if ($itemFromArray->getId() === $itemCode) {
                return $itemFromArray;
            }
        }
        return false;
    }

    //Sukurti metodą vend()*, kuriam paduodamas argumentas - produkto kodas.
    //* Metode vend() panaudojamas kitas metodas, kuris patikrina ar produktas egzistuoja.
    //Jeigu egzistuoja - grąžinamas item name;
    //Jeigu neegzistuoja - grąžinama žinutė - ‘Invalid Selection’!

    //Pakoreguoti metodą vend(), kuriam paduodami argumentai yra:
    // produkto kodas, pinigų suma.

    public function vend($itemCode, $myMoney)
    {
        $item = $this->ifItemExists($itemCode);

        if ($item) {
            echo $item->getTitle() . '<br> ';
            //ar kiekio uztenka
            if ($item->getQuantity() >= 1) {
                if ($item->getPrice() < $myMoney) {
                    $change = $myMoney - $item->getPrice();
                    $item->minusOneQuantity();
                    echo "{$item->getTitle()} Vending: your change is $change<br>";
                } elseif ($item->getPrice() == $myMoney) {
                    $item->minusOneQuantity();
                    echo "{$item->getTitle()} Vending <br>";
                } else {
                    echo "Not enough Money <br>";
                }
            } else {
                echo "{$item->getTitle()} is Out of Stock! <br>";
            }
        } else {
            echo 'Invalid Selection';
        }
    }
}

?>