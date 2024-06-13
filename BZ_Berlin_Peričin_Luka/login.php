<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="administration_styles.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="images/bz-logo.png" alt="Logo">
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
                <li class="currently_active"><a href="#">ADMINISTRATION</a></li>
            </ul>
        </nav>
    </header>

    <div class="selection">
        <div class="login-register">
            <a class="btn login-btn currently_active">LOGIN</a>
            <a class="btn register-btn can-be-selected" href="register.php">REGISTER</a>
        </div>

        <div class="login-form">
            <form method="post" action="loginNewUser.php" id="loginForm">
                <label for="email">e-mail:</label>
                <br />
                <input name="email" id="email" type="email" />
                <br /><br />
                <label for="password">password:</label>
                <br />
                <input name="password" id="password" type="password" />
                <br /><br /><br />
                <input name="submit" type="submit" value="login" />
            </form>
        </div>
    </div>

    <?php

         if(isset($_SESSION["access"])){

            if($_SESSION["access"] == 2){
                echo "<div class = 'edit_articles'>";
                echo "<a href = 'editArticles.php'>Edit all articles</a>";
                echo "</div>";
            }

        }
    ?>

    <footer>
        <div class="student-combo-div">
            <div class="student">
                <p>Luka Peričin smjer redovno računarstvo 0246108219</p>
            </div>
            <div class="under-student"></div>
        </div>
    </footer>

    <script type="text/javascript">
        document.getElementById("loginForm").onsubmit = function(event) {
            let wrongInputs = [];
            let slanjeForme = true;

            let poljeEmail = document.getElementById("email");
            let email = document.getElementById("email").value;

            if (email.length == 0 || !(email.includes("@"))) {
                slanjeForme = false;
                wrongInputs.push("email");
                poljeEmail.style.border = "2px dashed red";
            } else {
                poljeEmail.style.border = "2px solid green";
            }

            let poljePass = document.getElementById("password");
            let pass = document.getElementById("password").value;

            if (pass.length == 0) {
                slanjeForme = false;
                wrongInputs.push("password");
                poljePass.style.border = "2px dashed red";
            } else {
                poljePass.style.border = "2px solid green";
            }

            if (!slanjeForme) {
                event.preventDefault();

                let message = "Fields ";

                for (let i = 0; i < wrongInputs.length; i++) {
                    if (i == wrongInputs.length - 1) {
                        message = message + " " + wrongInputs[i];
                    } else {
                        message = message + wrongInputs[i] + ", ";
                    }
                }
                message += " are inputted wrong!";

                alert(message); // Display error message using alert
            }
            else {
                document.getElementById('forma').submit();
            }
        };
    </script>
</body>
</html>
