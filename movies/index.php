<?php
require "Class/DataBase.php";
$db = new DataBase();

//gausim visus irasus is movies lenteles
$moviesArr = $db->getMovies();
//var_dump($moviesArr);

include_once "includes/head.php";
include_once "includes/navigation.php";

echo $db->status;


?>
    <main class="container">
        <h1>Get Movies</h1>
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
                        <!--                        <a class="d-block" href="post.php?id=-->
                        <?php //echo $movie['id']; ?><!--">View More</a>-->
                        <p class="text-muted">Movie added: <?php echo $movie['created'] ?></p>
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