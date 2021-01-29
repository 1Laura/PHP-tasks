<?php
session_start();
require "Class/Validation.php";
require "Class/DataBase.php";

$db = new DataBase();
$vld = new Validation();

$currentPage = 'add movie';
$currentPageTitle = 'Add New movie';
$submitBtnName = 'addMovie';

if ($vld->checkFormSubmit($submitBtnName)) {
    //gaunam reiksme jei ivesta
    $imgUrl = $vld->cleanAndReturnPostVar('img');
    $movieName = $vld->cleanAndReturnPostVar('title');
    $movieYear = $vld->cleanAndReturnPostVar('year');
    $genreType = $_POST['genre'];

    //jei nera klaidu tai addinsim movie
    if ($vld->thereAreNoErrors()) {
        $db->addMovie($imgUrl, $movieName, $movieYear, $genreType);
        //cia galetu nuredirectinti i index.php
        header("Location: index.php");
    }
}
//gausim visus movies is Movies lenteles
$moviesDataArray = $db->getMovies();


require_once "includes/head.php";
require_once "includes/navigation.php";
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
                    <input class="form-check-input" type="radio" checked name="genre" id="Drama"
                           value="<?php echo $year ?? '' ?>">
                    <label class="form-check-label" for="genre"> Drama </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="genre" id="Comedy"
                           value="Comedy">
                    <label class="form-check-label" for="genre"> Comedy </label>
                </div>
                <div class="form-check ">
                    <input class="form-check-input" type="radio" name="genre" id="Action"
                           value="Action">
                    <label class="form-check-label" for="genre"> Action </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="genre" id="Fantasy"
                           value="Fantasy">
                    <label class="form-check-label" for="genre"> Fantasy </label>
                </div>
                <button type="submit" name="<?php echo $submitBtnName; ?>"
                        class="btn btn-outline-secondary mt-4">  <?php echo $currentPageTitle ?></button>
            </form>
        </div>
    </main>

    <script>
        //======================================JAVA SCRIPT=============================================================
        //validuoju forma be refresh
        const formElement = document.getElementById('mainForm');
        const outputEl = document.getElementById('fetchReturn');

        formElement.addEventListener('submit', handleForm);

        function handleForm(event) {
            //stabdom issiuntima per php
            event.preventDefault();
            console.log('siusti duomenis')
            //istrinu klaidas
            clearErrors();
            // sudeti visi formos laukai
            const myFormData = new FormData(formElement);
            // pridedam papildomu duomenu i posta tiek kiek reikia
            // console.log(myFormData)
            myFormData.append('btnName', "<?php echo $submitBtnName; ?>");
            myFormData.append("<?php echo $submitBtnName; ?>", '');
            myFormData.append('id', "<?php echo $id ?? ''; ?>");

            sendDataUsingFetch(myFormData);
        }

        function sendDataUsingFetch(data) {
            //fetch(kokiu adresu siunciam, option)
            const options = {
                method: 'post',
                body: data
            }
            fetch('process/fetchProcess.php', options)
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                    outputEl.innerHTML = JSON.stringify(data);
                    if (data.errors) {
                        //jei gavau klaidu is fetchProcess.php apdorojimo failo tai noriu jas atvaizduoti
                        displayErrorsJs(data.errors)
                    }
                    if (data.movieCreated) {
                        console.log('galima redirectinti i index.php')

                        location.href = 'index.php'
                    }
                }).catch(error => console.error(error.message));
        }

        // neaisku su errorais radio box ypac
        function displayErrorsJs(errors) {
            const entries = Object.entries(errors);
            console.log(entries);
            entries.map(entry => outputJsErrorField(entry[0], entry[1]))
        }

        function outputJsErrorField(field, msg) {
            const fieldElement = document.getElementById(field);
            fieldElement.classList.add('error-input');
            fieldElement.nextElementSibling.innerHTML = msg;

        }

        function clearErrors() {
            // pasalina raudona borderi
            const foundErrors = document.querySelectorAll('.error-input');
            console.log('foundErrors');
            console.log(foundErrors);
            if (foundErrors.length > 0) {
                foundErrors.forEach(errorEl => errorEl.classList.remove('error-input'))
            }
            // pasalinti zinutes po input
            clearErrorMessages();
        }

        function clearErrorMessages() {
            const foundErrors = document.querySelectorAll('.error-msg');
            if (foundErrors.length > 0) {
                foundErrors.forEach(errorEl => errorEl.innerHTML = '');
            }
        }
    </script>
<?php
//uzdarom db susijungimas
$db->closeConn();
require "includes/footer.php";
?>