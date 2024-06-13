<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="administration_styles.css">
</head>
<body>
    
    <header>
        <div class="logo">
            <img src="images/bz-logo.png">
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
            <a class="btn can-be-selected" href="login.php">LOGIN</a>
            <a class="btn currently_active">REGISTER</a>
        </div>

        <div class="login-form">
            <form enctype="multipart/form-data" action="registerNewUser.php" name="forma" method="POST">
                <label for="name">name:</label>
                <br />
                <input id="name" name="name" type="text"/>
                <br />
                <label for="lastname">last name:</label>
                <br />
                <input id="lastname" name="lastname" type="text"/>
                <br />
                <label for="email">e-mail:</label>
                <br />
                <input id="email" name="email" type="email"/>
                <br />
                <label for="pass">password:</label>
                <br />
                <input id="pass" name="pass" type="password"/>
                <br />
                <label for="confPass">confirm password:</label>
                <br />
                <input id="confPass" name="confPass" type="password"/>
                <br />
                <label for="access">access level:</label>
                <br />
                <input id="access" name="access" type="number" min="1" max="2" required/>
                <br /><br /><br />
                <input type="submit" id="register" value="Register"/> 
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
        document.getElementById("register").onclick = function(event) {

            let wrongInputs = [];
            var slanjeForme = true;

            var poljeIme = document.getElementById("name");
            var ime = document.getElementById("name").value;

            if (ime.length == 0) {
                slanjeForme = false;
                wrongInputs.push("name");
                poljeIme.style.border="2px dashed red";
            } else {
                poljeIme.style.border="2px solid green";
            }

            var poljePrezime = document.getElementById("lastname");
            var prezime = document.getElementById("lastname").value;

            if (prezime.length == 0) {
                slanjeForme = false;
                wrongInputs.push("last name");
                poljePrezime.style.border="2px dashed red";
            } else {
                poljePrezime.style.border="2px solid green";
            }

            var poljeEmail = document.getElementById("email");
            var email = document.getElementById("email").value;

            if (email.length == 0 || !(email.includes("@"))) {
                slanjeForme = false;
                wrongInputs.push("email");
                poljeEmail.style.border="2px dashed red";
            } else {
                poljeEmail.style.border="2px solid green";
            }

            var poljePass = document.getElementById("pass");
            var pass = document.getElementById("pass").value;

            var poljePassRep = document.getElementById("confPass");
            var passRep = document.getElementById("confPass").value;

            if (pass.length == 0 || passRep.length == 0 || pass != passRep) {
                slanjeForme = false;
                wrongInputs.push("passwords");
                poljePass.style.border="2px dashed red";
                poljePassRep.style.border="2px dashed red";
            } else {
                poljePass.style.border="2px solid green";
                poljePassRep.style.border="2px solid green";
            }

            var poljeAccess = document.getElementById("access");
            var access = document.getElementById("access").value;


            if (access === "") {
                slanjeForme = false;
                wrongInputs.push("access");
                poljeAccess.style.border="1px dashed red";
            } else {
                poljeAccess.style.border="1px solid green";
            }

            if (!slanjeForme) {
                event.preventDefault();

                var message = "Fields ";

                for (let i = 0; i < wrongInputs.length; i++) {
                    if(i == wrongInputs.length - 1){
                        message = message + " " + wrongInputs[i];
                    }
                    else{
                        message = message + wrongInputs[i] + ", ";
                    } 
                }
                message += " are inputed wrong!";

                alert(message);

            } else {
                document.getElementById('forma').submit();
            }
        };
    </script>
</body>
</html>
