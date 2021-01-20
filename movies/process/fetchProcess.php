<?php
require_once "../Class/DataBase.php";
require_once "../Class/Validation.php";

$db = new DataBase();
$vld = new Validation();


if ($vld->checkFormSubmit('addMovie')) {
    $imgUrl = $vld->cleanAndReturnPostVar('imgUrl');
    $movieName = $vld->cleanAndReturnPostVar('movieName');
    $movieYear = $vld->cleanAndReturnPostVar('movieYear');
    $genreType = $vld->cleanAndReturnPostVar('genreType');
    if ($vld->thereAreNoErrors()) {
        $db->addMovie($imgUrl, $movieName, $movieYear, $genreType);
        echo 'movies idetas i db';
    } else {
        echo 'kazkas negerai';
    }

}







