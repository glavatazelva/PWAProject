<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berlin - Sport</title>
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
                <li  class = "currently_active"><a href="#">BERLIN-SPORT</a></li>
                <li><a href="culture.php">CULTURE & SHOW</a></li>
                <li><a href="login.php">ADMINISTRATION</a></li>
            </ul>
        </nav>
    </header>

    <section class = "berlin-sport">

        <div class = "berlin-sport-header">
            <a href = "#">
            <h2>BERLIN-SPORT ></h2>
            </a> 
        </div>

        <div class = "articles-sport">

        <?php
        include 'connect.php';
        $query = 'SELECT * FROM clanci WHERE kategorija = "sport"';
        $result = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_array($result)) {
            $img_src = $row["path"];
            $short_title = $row["podnaslov"];
            $long_title = $row["naslov"];
    
            echo '<div class="sport-article">';
            echo '<a href="article.php?id=' . $row["id"] . '">';
            echo '        <div class="article-img">';
            echo '            <img src="' . $img_src . '">';
            echo '        </div>';
            echo '        <div class="article-txt">';
            echo '            <p>' . $short_title . '</p>';
            echo '            <h3>' . $long_title . '</h3>';
            echo '        </div>';
            echo '    </a>';
            echo '</div>';
        }
        ?>
            
            
        </div>
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
