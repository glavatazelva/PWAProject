<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
    <title>Create Article</title>
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
     

    <form method="post" action="insertArticle.php" enctype="multipart/form-data">

            <input type="hidden" name="article_id"">
            <label for="long_title">long title:</label><br>
            <input class = "inputs" type="text" id="long_title" name="long_title" value="" required><br><br>

            <label for="short_title">short title:</label><br>
            <input class = "inputs" type="text" id="short_title" name="short_title" value="" required><br><br>

            <label for="text">text:</label><br>
            <textarea class = "inputs" id="text" name="text" required></textarea><br><br>

            <label for="img">image:</label><br>
            <input type="file" accept="image/png, image/gif, image/jpeg" id="img" name="img" required><br><br>


            <label for="cars">category</label>
            <select name="category" id="category" required>
                <option value='kultura' selected>kultura</option>
                <option value='sport' >sport</option>

            </select>
        <div class = "form_buttons">
            <a href = "editArticles.php">back</a>

            <div>
                <input type="submit" value="create">
                <input type="reset" value="undo">
            <div>
        </div>
        </form>
    </section>

    <footer>
        <div class="student-combo-div">
            <div class="student">
                <p>Luka Peričin smjer redovno računarstvo 0246108219</p>
            </div>
            <div class="under-student"></div>
        </div>
    </footer>

    <script>
    </script>
</body>
</html>
