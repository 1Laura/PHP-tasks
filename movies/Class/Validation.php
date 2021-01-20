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
        if (!empty($_POST[$var]) && isset($_POST[$var])) {
            // kintamasis nusatytas ir ne tuscias
            return true;
        }
    }

    public function cleanPostVar($var)
    {
        // nutrinti white space tuscius tarpus
        $trimmed = trim($_POST[$var]);
        $safeVar = htmlspecialchars($trimmed);
        return $safeVar;
    }

    public function showValidationErrors()
    {
        if (!empty($this->validErrors)) {
            var_dump($this->validErrors);
        }

    }

    public function thereAreNoErrors()
    {
        if (empty($this->validErrors)) {
            return true;
        }
    }


}