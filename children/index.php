<?php
include_once "Class/ChildrenAll.php";
include_once "Class/Children.php";

//Tikslas: panaudoti Abstrakčią klasę, bei paveldimumą (extends).
//>> Pritaikyti foreach ciklą objektui, arba konvertuoti objektą į masyvą.


$array = [
    new Children('Matas', 'male', 17),
    new Children('Juste', 'female', 9),
    new Children('Domas', 'male', 15),
    new Children('Ula', 'female', 3),
];


foreach ($array as $item) {
    $item->checkWhatChildAttends();

}

foreach ($array as $item) {
    $childrenArray[] = $item->convertObjectToArray();
}
var_dump($childrenArray);

//$childrenArray[0]->checkWhatChildAttends();

//$childrenArray= new Children($mName, $mGender, $mAge)

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

</body>
</html>
