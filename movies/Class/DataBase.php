<?php


class DataBase
{
    //prisijungimo kintamieji
    private $serverName = 'localhost';
    private $userName = 'root';
    private $password = '';
    private $dataBaseName = 'movies';

    //prisijungima saugantis kintamasis
    public $status;
    public $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->serverName, $this->userName, $this->password, $this->dataBaseName);
        if ($this->conn->connect_error) {
            die('kazkas neveikia: ' . $this->conn->connect_error);
        }
        $this->status = "Prisijungem";
    }

    //Pagal turimas žinias phpmyadmin susikurti naują duombazę, ir joje lentelę su 6 stulpeliais:
    //id (int) - autoincrement;  //img (varchar) - simbolių 255; //title(varchar) - simbolių 255;
    //year (year);  //genre (varchar) - simbolių 255;  //created (timestamp) - current timestamp;

    public function createDbTable()
    {
        $sql = "CREATE TABLE movies(`id` INT(3) UNSIGNED AUTO_INCREMENT primary  key ,
     `img` VARCHAR(255),
      `title` VARCHAR(255),
       `year` YEAR,
        `genre` VARCHAR(255),
         `created` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)";
        $this->makeQuery($sql, 'Movies lentele sukurta sekmingai');
    }

    //Add Movie to DB===============================================================================================
    //>> Paspaudus mygtuką ‘Add Movie’ PHP & JS pagalba įdedate įrašą į duombazę.
    //>> Sėkmingo įtraukimo į DB atveju, stilizuota žinutė, kad pavyko.
    //>> Bonus task* - Validacija ar laukeliai nėra tušti (t.y. turi būti supildyti), jei tušti - žinutė;

    //funkcija, kad pridetu viena posta
    public function addMovie($img, $title, $year, $genre)
    {
        $sql = "INSERT INTO `movies`(`img`, `title`, `year`, `genre`) VALUES ('$img', '$title', '$year', '$genre')";
        $this->makeQuery($sql, 'Movie pridetas sekmingai');
    }

    //metodas gauti visus movies is musu Post lenteles
    public function getMovies()
    {
        // $sql = "SELECT * FROM Posts";
        $sql = "SELECT * FROM `movies` ORDER BY `movies`.`created` DESC";
        // $mysqliResultObj turi savybe num_rows
        $mysqliResultObj = $this->conn->query($sql);
        if ($mysqliResultObj->num_rows > 0) {
            //gauta daugiau nei nulis eiluciu
            return $mysqliResultObj->fetch_all(MYSQLI_ASSOC);
        } else {
            $this->status = "Klaida: radom 0 eiluciu";
        }
    }


    //pagalbines funkcijos==========================================================================================
    private function makeQuery($sql, $msg)
    {
        if ($this->conn->query($sql) === true) {
            $this->status = $msg;
        } else {
            $this->status = "Klaida:  {$this->conn->error}";
        }
    }

    // helper klase atvaizduoti feedback taip kaip mes norim
    public function showStatus()
    {
        ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo $this->status ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php
    }

    // duomenu bazes susijungimu uzdarymas
    public function closeConn()
    {
        $this->conn->close();
    }


}