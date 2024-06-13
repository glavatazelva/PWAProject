<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class = "logo">
        <img src = "images/bz-logo.png">
        </div>

        <?php
            session_start();

            if(isset($_SESSION["user"]) && isset($_SESSION["access"])){
                echo "<div class = 'active_user'>";

                if($_SESSION["access"] == 2){
                    echo "<p>Welcome ADMIN, <strong>{$_SESSION['user']}</strong></p>";

                }
                else{
                echo "<p>Welcome, <strong>{$_SESSION['user']}</strong></p>";
                }
                echo "<a href = 'logout.php'>logout</a>";
                echo "</div>";

            }
        ?>

        <nav>
            <ul>
                <li><a href="index.php">HOME</a></li>
                <li><a href="sport.php">BERLIN-SPORT</a></li>
                <li><a href="culture.php">CULTURE & SHOW</a></li>
                <li><a href="login.php">ADMINISTRATION</a></li>
            </ul>
        </nav>
    </header>

    <section>

       

        <?php

       if(isset($_GET["id"]))
        $id = $_GET["id"];


        echo "<script>console.log($id);</script>";

        include 'connect.php';
        $query = "SELECT * FROM clanci WHERE id = $id";

        $result = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_array($result)) {

            $img_src = $row["path"];
            $short_title = $row["podnaslov"];
            $long_title = $row["naslov"];
            $text = $row["text"];
    
 
            echo "    <h1>$long_title</h1>";
            echo '        <div class="article-img">';
            echo '            <img src="' . $img_src . '">';
            echo '        </div>';
            echo '        <div class="long-text">';
            echo '            <p>' . $text . '</p>';
            echo '        </div>';
        }
        ?>
            
            
    </section>




    <footer>
        <div class = "student-combo-div">
        <div class = "student">
            <p>Luka Peričin smjer redovno računarstvo 0246108219</p>
        </div>
        <div class = "under-student">

        </div>
        </div>
    </footer>

</body>
</html>
