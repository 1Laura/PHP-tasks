<?php

class Validation
{
    private $validErrors = [];

    public function checkFormSubmit($btnName)
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST[$btnName])) {
            return true;
        }
    }

//    public function cleanAndReturnRadioBox($var)
//    {
//        if (isset($_POST[$var])) {
//            return $_POST[$var];
//        } else {
//            $this->validErrors[$var] = 'not set genre';
//        }
//    }

    public function cleanAndReturnPostVar($var)
    {
        if ($this->isSetAndNotEmptyPostVar($var)) {
            return $this->cleanPostVar($var);
        } else {
            // var is not set or empty
            $this->validErrors[$var] = 'not set or empty';
        }

    }

    public function isSetAndNotEmptyPostVar($var)
    {
        if (isset($_POST[$var]) && !empty($_POST[$var])) {
            if (trim($_POST[$var]) !== '') {
                // kintamasis nusatytas ir ne tuscias
                return true;
            }
        }
    }

    public function cleanPostVar($var)
    {
        // nutrinti white space tuscius tarpus
        $trimmed = trim($_POST[$var]);
        $safe = htmlspecialchars($trimmed);
        return $safe;
    }

    public function showValidationErrors()
    {
        if (!empty($this->validErrors)) {
            print_r($this->validErrors);
        }

    }

    public function getValidationErrors()
    {
        if (!empty($this->validErrors)) {
            return $this->validErrors;
        }
    }


    public function thereAreNoErrors()
    {
        if (empty($this->validErrors)) {
            return true;
        }
    }


}