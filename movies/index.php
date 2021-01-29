<?php
session_start();
require_once "Class/Validation.php";
require "Class/DataBase.php";
$vld = new Validation();
$db = new DataBase();

//gausim visus irasus is movies lenteles
$moviesArr = $db->getMovies();

//delete
if (isset($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
    $db->deleteMovie($id);
    header('Location: index.php');
}


require "includes/head.php";
require "includes/navigation.php";

echo $db->showStatusArray();
?>
    <main class="container">
        <h1>All movies</h1>
        <div class="cards-container d-flex flex-wrap">
            <?php foreach ($moviesArr as $movie): ?>
                <div class="card m-2">
                    <div class="card-body">
                        <img src="<?php echo $movie['img'] ?>" alt="">
                        <h5 class="card-title"><?php echo $movie['title'] . "(id_{$movie['id']})" ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted">Created: <?php echo $movie['year'] ?></h6>
                        <p class="card-text">The movies genre is: <?php echo $movie['genre'] ?></p>
                    </div>
                    <div class="card-footer">
                        <!--                        <a class="d-block" href="singleMovie.php?id=-->
                        <?php //echo $movie['id']; ?><!--">View More</a>-->
                        <p class="text-muted">Movie added: <?php echo $movie['created'] ?></p>

                        <form action="" id="mainFormDelete" method="post" class="float-right">
                            <a href="editMovie.php?edit=1&id=<?php echo $movie['id']; ?>"
                               class="card-link btn-outline-secondary btn" name="edit">Edit Movie</a>

                            <a href="index.php?delete=1&id=<?php echo $movie['id']; ?>"
                               class="card-link btn-outline-secondary btn" name="delete">Delete Movie</a>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
<?php
include_once "includes/footer.php";
//uzdarom db susijungimas
$db->closeConn();
?>