<?php
session_start();
require_once "../Class/Validation.php";
require_once "../Class/DataBase.php";

$vld = new Validation();

$jsonResponse = [];

$btnName = htmlspecialchars($_POST['btnName']);

$id = htmlspecialchars($_POST['id']);

if ($vld->checkFormSubmit('addMovie')) {
    $img = $vld->cleanAndReturnPostVar('img');
    $title = $vld->cleanAndReturnPostVar('title');
    $year = $vld->cleanAndReturnPostVar('year');
    $genre = 'genre';

    if ($vld->thereAreNoErrors()) {
        $jsonResponse['success']['img'] = $img;
        $jsonResponse['success']['title'] = $title;
        $jsonResponse['success']['year'] = $year;
        $jsonResponse['success']['genre'] = $genre;

        $db = new DataBase();
        $db->addMovie($img, $title, $year, $genre);
        $jsonResponse['movieCreated'] = 'added movie';
//        header('Location: index.php');
    } else {
        $jsonResponse['errors'] = $vld->getValidationErrors();
    }
    // nustatysim headeri kad butu jsno
    header('Content-Type: application/json');
    // grazinti atsakyma json pavidalu i index faila
    echo json_encode($jsonResponse);
}

