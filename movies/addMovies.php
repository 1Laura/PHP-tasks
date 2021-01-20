<?php
require "Class/Validation.php";
require "Class/DataBase.php";

$db = new DataBase();
$vld = new Validation();


if ($vld->checkFormSubmit('addMovie')) {

    $imgUrl = $vld->cleanAndReturnPostVar('imgUrl');
    $movieName = $vld->cleanAndReturnPostVar('movieName');
    $movieYear = $vld->cleanAndReturnPostVar('movieYear');
    $genreType = $vld->cleanAndReturnPostVar('genreType');

    if ($vld->thereAreNoErrors()) {
        $db->addMovie($imgUrl, $movieName, $movieYear, $genreType);
        var_dump('movies idetas i duombaze');
        //cia galetu nuredirectinti i index.php
    }
    //
}
//sukuriam nauja lentele
//$db->createDbTable();

//var_dump($_POST);
include_once "includes/head.php";
include_once "includes/navigation.php";
//echo $db->showStatus();
?>
    <main class="container">
        <h1>Add Movies</h1>
<!--        --><?php //$vld->showValidationErrors(); ?>

        <div>
            <form id="mainForm" class="mt-4" action="" method="post" id="addMovie">
                <div class="input-group input-group-sm mb-3">
                    <input type="text" class="form-control" aria-label="Sizing example input"
                           aria-describedby="inputGroup-sizing-sm" name="imgUrl" id="imgUrl"
                           placeholder="Provide Movie Image as URL" value="<?php echo $imgUrl ?? '' ?>">
                </div>
                <div class="input-group input-group-sm mb-3">
                    <input type="text" class="form-control" aria-label="Sizing example input"
                           aria-describedby="inputGroup-sizing-sm" name="movieName" id="movieName"
                           placeholder="Enter movie name" value="<?php echo $movieName ?? '' ?>">
                </div>
                <div class="input-group input-group-sm mb-3">
                    <input type="text" class="form-control" aria-label="Sizing example input"
                           aria-describedby="inputGroup-sizing-sm" name="movieYear" id="movieYear"
                           placeholder="Enter year movie was released" value="<?php echo $movieYear ?? '' ?>">
                </div>
                <div><span>Check one Genre:</span></div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="genreType" id="Drama" value="Drama">
                    <label class="form-check-label" for="genreType"> Drama </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="genreType" id="Comedy" value="Comedy">
                    <label class="form-check-label" for="genreType"> Comedy </label>
                </div>
                <div class="form-check ">
                    <input class="form-check-input" type="radio" name="genreType" id="Action" value="Action">
                    <label class="form-check-label" for="genreType"> Action </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="genreType" id="Fantasy" value="Fantasy">
                    <label class="form-check-label" for="genreType"> Fantasy </label>
                </div>

                <button type="submit" name="addMovie" class="btn btn-outline-secondary mt-4">Add Movie</button>
            </form>
        </div>
    </main>

    <script>
        const formElement = document.getElementById('mainForm');
        formElement.addEventListener('submit', handleForm)

        function handleForm(event) {
            //stabdom issiuntime per php
            event.preventDefault();
            console.log('siusti duomenis')

            // sudeti visi formos laukai
            const myFormData = new FormData(formElement);
            myFormData.append('addMovie', '');
            sendData(myFormData);

        }

        function sendData(data) {
            //fetch(kokiu adresu siunciam, option)
            const options = {
                method: 'post',
                body: data
            }
            //ar galiu siusti i ta pati addMovies.php?
            fetch('process/fetchProcess.php', options)
                .then(response => response.text())
                .then(data => {
                    console.log(data)
                })
        }

    </script>
<?php
include_once "includes/footer.php";
//uzdarom db susijungimas
$db->closeConn();
?>