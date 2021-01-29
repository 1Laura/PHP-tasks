<?php


class DataBase
{
    //prisijungimo kintamieji
    private $serverName = 'localhost';
    private $userName = 'root';
    private $password = '';
    private $dataBaseName = 'movies';

    //prisijungima saugantis kintamasis
    public $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->serverName, $this->userName, $this->password, $this->dataBaseName);

        if ($this->conn->connect_error) {
            die('kazkas atsitiko: ' . $this->conn->connect_error);
        }

        if (!isset($_SESSION['statusArr'])) {
            $_SESSION['statusArr'] = [];
        }
        $_SESSION['statusArr'][] = 'Pavyko prisijungti prrie DATABASE';
    }

    //Pagal turimas žinias phpmyadmin susikurti naują duombazę, ir joje lentelę su 6 stulpeliais:
    //id (int) - autoincrement;  //img (varchar) - simbolių 255; //title(varchar) - simbolių 255;
    //year (year);  //genre (varchar) - simbolių 255;  //created (timestamp) - current timestamp;
    // LENTELE SUSIKURIAI PHP MY ADMINE

    //Add Movie to DB===============================================================================================
    //>> Paspaudus mygtuką ‘Add Movie’ PHP & JS pagalba įdedate įrašą į duombazę.
    //>> Sėkmingo įtraukimo į DB atveju, stilizuota žinutė, kad pavyko.
    //>> Bonus task* - Validacija ar laukeliai nėra tušti (t.y. turi būti supildyti), jei tušti - žinutė;

    //funkcija, kad ADD viena posta=====================================================================================
    public function addMovie($img, $title, $year, $genre)
    {
        $sql = "INSERT INTO `movies`(`img`, `title`, `year`, `genre`) VALUES ('$img', '$title', '$year', '$genre')";
        $this->makeQuery($sql, 'Movie added sekmingai');
    }

    //funkcija, kad EDIT posta==========================================================================================
    public function editMovie($id, $img, $title, $year, $genre)
    {
        $sql = "UPDATE `movies` SET `img`='$img',`title`='$title',`year`='$year',`genre`='$genre' WHERE `id`='$id' limit 1";
        $this->makeQuery($sql, 'Movie update pavyko');
    }

    //funkcija, kad DELETE posta========================================================================================
    public function deleteMovie($id)
    {
        $sql = "DELETE FROM movies WHERE `id`='$id' LIMIT 1";
        $this->makeQuery($sql, 'Movie delete sekmingai');
    }

    //pagalbinis metodas atlikti uzklausa ir gauti feedback=============================================================
    private function makeQuery($sql, $msg)
    {
        if ($this->conn->query($sql) === true) {
            $_SESSION['statusArr'][] = $msg;
        } else {
            $_SESSION['statusArr'][] = "Klaida:  {$this->conn->error}";
        }
    }

    //metodas gauti visus movies is musu movies lenteles==================================================================
    public function getMovies()
    {
        $sql = "SELECT * FROM `movies` ORDER BY `movies`.`created` DESC";
        $mysqliResultObj = $this->conn->query($sql);
        if ($mysqliResultObj->num_rows > 0) {
            $_SESSION['statusArr'][] = "Gaunam {$mysqliResultObj->num_rows} movies";
            return $mysqliResultObj->fetch_all(MYSQLI_ASSOC);
        } else {
            $_SESSION['statusArr'][] = "Klaida: radom 0 movies";
        }
    }

    //metodas gauti viena movie is musu movies lenteles==================================================================
    public function getMovie($id)
    {
        $sql = "SELECT * FROM `movies` WHERE `id`='$id'";
        $mysqliResultObj = $this->conn->query($sql);
        if ($mysqliResultObj->num_rows > 0) {
//            $_SESSION['statusArr'][] = "Gaunam {$mysqliResultObj->num_rows} movies";
            return $mysqliResultObj->fetch_assoc();
        } else {
            $_SESSION['statusArr'][] = "Klaida: radom 0 movies";
        }
    }


    // helper f-ja atvaizduoti feedback taip kaip mes norim=============================================================
    public function showStatus($status)
    {
        ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $status ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php
    }

    public function showStatusArray()
    {
        $reverseArr = array_reverse($_SESSION['statusArr']);
        foreach ($reverseArr as $index => $statusMsg) {
            if ($index < 3) {
                $this->showStatus($statusMsg);
            } else {
                break;
            }
        }
        if (count($_SESSION['statusArr']) > 10) {
            $count = count($_SESSION['statusArr']);
            array_splice($_SESSION['statusArr'], 0, $count - 10);
        }

    }

    // duomenu bazes susijungimu uzdarymas
    public function closeConn()
    {
        $this->conn->close();
    }
}