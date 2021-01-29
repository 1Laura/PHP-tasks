<?php
session_start();
require_once "Class/Validation.php";
require "Class/DataBase.php";
$vld = new Validation();
$db = new DataBase();

$currentPage = 'Edit Movie';
$currentPageTitle = 'Edit movie';
$submitBtnName = 'editMovie';

$idFromGet = htmlspecialchars($_GET['id']);
$movie = $db->getMovie($idFromGet);
var_dump($movie);

$id = $movie['id'];
$img = $movie['img'];
$name = $movie['title'];
$year = $movie['year'];
$genre = $movie['genre'];


if ($vld->checkFormSubmit($submitBtnName)) {
    //gaunam reiksme jei ivesta
    $imgUrl = $vld->cleanAndReturnPostVar('img');
    $movieName = $vld->cleanAndReturnPostVar('title');
    $movieYear = $vld->cleanAndReturnPostVar('year');
    $genreType = $_POST['genre'];
    var_dump($genreType);

    //jei nera klaidu tai addinsim movie
    if ($vld->thereAreNoErrors()) {
        $db->editMovie(htmlspecialchars($_GET['id']), $imgUrl, $movieName, $movieYear, $genreType);
        //cia galetu nuredirectinti i index.php
        header("Location: index.php");
    }
}


require "includes/head.php";
require "includes/navigation.php";

echo $db->showStatusArray();

?>
    <main class="container">
        <h1><?php echo $currentPageTitle ?></h1>
        <?php $vld->showValidationErrors(); ?>
        <div id="fetchReturn"></div>
        <div>
            <form id="mainForm" class="mt-4" action="" method="post">
                <div class="form-group input-group-sm mb-3">
                    <input type="text" class="form-control" aria-label="Sizing example input"
                           aria-describedby="inputGroup-sizing-sm" name="img" id="img"
                           placeholder="Provide Movie Image as URL" value="<?php echo $img ?? '' ?>">
                    <p class="error-msg"></p>
                </div>
                <div class="form-group input-group-sm mb-3">
                    <input type="text" class="form-control" aria-label="Sizing example input"
                           aria-describedby="inputGroup-sizing-sm" name="title" id="title"
                           placeholder="Enter movie name" value="<?php echo $name ?? '' ?>">
                    <p class="error-msg"></p>
                </div>
                <div class="form-group input-group-sm mb-3">
                    <input type="text" class="form-control" aria-label="Sizing example input"
                           aria-describedby="inputGroup-sizing-sm" name="year" id="year"
                           placeholder="Enter year movie was released" value="<?php echo $year ?? '' ?>">
                    <p class="error-msg"></p>
                </div>

                <div id="genres">Check one Genre:</div>
                <p class="error-msg"></p>
                <div class="form-check">
                    <input class="form-check-input" type="radio" checked name="genre" id="Drama" value="Drama"
                        <?php echo $movie['genre'] === 'Drama' ? 'checked' : ''; ?> />
                    <label class="form-check-label" for="genre"> Drama </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="genre" id="Comedy" value="Comedy"
                        <?php echo $movie['genre'] === 'Comedy' ? 'checked' : ''; ?> />
                    <label class="form-check-label" for="genre"> Comedy </label>
                </div>
                <div class="form-check ">
                    <input class="form-check-input" type="radio" name="genre" id="Action" value="Action"
                        <?php echo $movie['genre'] === 'Action' ? 'checked' : '' ?> />
                    <label class="form-check-label" for="genre"> Action </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="genre" id="Fantasy" value="Fantasy"
                        <?php echo $movie['genre'] === 'Fantasy' ? 'checked' : '' ?> />
                    <label class="form-check-label" for="genre"> Fantasy </label>
                </div>

                <button type="submit" name="<?php echo $submitBtnName; ?>"
                        class="btn btn-outline-secondary mt-4">  <?php echo $currentPageTitle ?></button>
            </form>
        </div>
    </main>


<?php
include_once "includes/footer.php";
//uzdarom db susijungimas
$db->closeConn();
?>