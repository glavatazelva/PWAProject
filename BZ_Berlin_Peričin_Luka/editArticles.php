<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <title>Edit Article</title>
    <link rel="stylesheet" href="edit_styles.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="images/bz-logo.png" alt="Logo">
        </div>
        
        <?php
        session_start();

        if(isset($_SESSION["user"]) && isset($_SESSION["access"])) {
            echo "<div class='active_user'>";
            if($_SESSION["access"] == 2) {
                echo "<p>Welcome ADMIN, <strong>{$_SESSION['user']}</strong></p>";
            } else {
                echo "<p>Welcome, <strong>{$_SESSION['user']}</strong></p>";
            }
            echo "<a href='logout.php'>logout</a>";
            echo "</div>";
        }
        ?>
        
        <nav>
            <ul>
                <li><a href="#">HOME</a></li>
                <li><a href="sport.php">BERLIN-SPORT</a></li>
                <li><a href="culture.php">CULTURE & SHOW</a></li>
                <li class="currently_active"><a href="login.php">ADMINISTRATION</a></li>
            </ul>
        </nav>
    </header>

    <section>
        <?php
        include 'connect.php';
        include 'findMinArticleID.php';
        include 'findMaxArticleID.php';

        if(isset($_GET["id"])) {
            $id = $_GET["id"];
        } else {
            $id = $min_id;
        }


        $query = "SELECT * FROM clanci WHERE id = $id";
        $result = mysqli_query($connection, $query);

        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $img_src = $row["path"];
            $short_title = $row["podnaslov"];
            $long_title = $row["naslov"];
            $text = $row["text"];
            $kategorija = $row["kategorija"];
        } else {
            echo "No article found with ID: $id";
            exit();
        }
        ?>

    <form method="post" action="updateArticle.php?id=<?php echo $id; ?>" enctype="multipart/form-data">

            <input type="hidden" name="article_id" value="<?php echo $id; ?>" required>
            <label for="long_title">long title:</label><br>
            <input class = "inputs" type="text" id="long_title" name="long_title" value="<?php echo $long_title; ?>" required><br><br>

            <label for="short_title">short title:</label><br>
            <input class = "inputs" type="text" id="short_title" name="short_title" value="<?php echo $short_title; ?>" required><br><br>

            <label for="text">text:</label><br>
            <textarea class = "inputs" id="text" name="text" required><?php echo $text; ?></textarea><br><br>

            <label for="img">image:</label><br>
            <input type="file" accept="image/png, image/gif, image/jpeg" id="img" name="img" required><br><br>

            <img src="<?php echo $img_src; ?>" alt="Current Image" style="max-width: 300px;" required><br><br>

            <label for="cars">category</label>
            <select name="category" id="category" required>
                <option value="<?php echo $kategorija ?>" selected><?php echo $kategorija ?></option>

                <?php
                if($kategorija === "sport")
                    echo "<option value='kultura' >kultura</option>";
                else    echo "<option value='sport' >sport</option>";

                ?>
            </select>
        <div class = "form_buttons">
            <a href = "newArticle.php">create new article</a>



            <?php
                if($id != $min_id){

                $query = "SELECT id AS smaller FROM clanci WHERE id < $id ORDER BY smaller DESC LIMIT 1";
                $result = mysqli_query($connection, $query);
        
                if ($result) {
                    $row = mysqli_fetch_assoc($result);
                    $previous = $row['smaller'];

                }

                echo "<a href='editArticles.php?id=$previous'>< previous </a>";
                }
                    
            ?>
            <div>
                <input type="submit" value="update">
                <input type="reset" value="undo">
            </div>
            <?php
            if($id != $max_id){
                $query = "SELECT id AS bigger FROM clanci WHERE id > $id ORDER BY bigger ASC LIMIT 1";
                $result = mysqli_query($connection, $query);
        
                if ($result) {
                    $row = mysqli_fetch_assoc($result);
                    $next = $row['bigger'];

                }
                echo "<a href='editArticles.php?id=$next'>next ></a>";
            }
            ?>
        <a href="deleteArticle.php?id=<?php echo $id; ?>">delete this article</a>


            
        </div>
        </form>
    </section>

    <footer>
        <div class="student-combo-div">
            <div class="student">
                <p>Luka Peričin smjer redovno računarstvo</p>
            </div>
            <div class="under-student"></div>
        </div>
    </footer>

    <script>
    </script>
</body>
</html>
