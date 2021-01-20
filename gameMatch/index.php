<?php
require "const/constants.php";
include_once "Class/Player.php";
include_once "Class/Team.php";
include_once "Class/GameMatch.php";
include_once "process/functions.php";


$player1 = new Player();
//var_dump($player1);

//$team1 = new Team();
//$team2 = new Team();
////$team1->getTeamPlayers();
//var_dump($team1);
//var_dump($team2);

$gameTeams = [new Team(), new Team()];
var_dump($gameTeams);

//var_dump($team1->getTeamLogo());

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
<div>
    <h1>Game Match</h1>
</div>
<!--<img src="--><?php //echo $team1->getTeamLogo() ?><!--" alt="">-->


<div>


</div>
</body>
</html>
