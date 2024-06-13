<?php
include 'connect.php';

$ime = $_POST['name'];
$prezime = $_POST['lastname'];
$email = $_POST['email'];
$pass = $_POST['pass'];
$access = $_POST['access'];

$hashed_password = password_hash($pass, PASSWORD_BCRYPT);

$sql = "INSERT INTO users (`firstName`, `lastName`, `email`, `password`, `access`) VALUES (?, ?, ?, ?, ?)";

$findSameEmailQuery = "SELECT * FROM users where email = ?";


$stmt = mysqli_stmt_init($connection);

if (mysqli_stmt_prepare($stmt, $findSameEmailQuery)) {
    mysqli_stmt_bind_param($stmt, 's', $email);

    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) > 0) {

            echo "<script type='text/javascript'>
            alert('Account with same email already exists!');
            window.location.href = 'register.php';
          </script>";
            mysqli_stmt_close($stmt);
            mysqli_close($connection);
            exit();

        }
    }
} 




$stmt = mysqli_stmt_init($connection);

if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, 'ssssi', $ime, $prezime, $email, $hashed_password, $access);

    if (mysqli_stmt_execute($stmt)) {

        session_start();

        $_SESSION["user"] = $ime . " " .$prezime;
        $_SESSION["access"] = $access;

        echo "<script type='text/javascript'>
        alert('Successfull account creation!');
        window.location.href = 'index.php';
      </script>";



    } else {
        echo "<p>Error while inserting into database</p>";
        echo "<a href = 'register.php'>Return to registration</a> ";

    }
} else {
    echo "<p>Error while loading statement</p>";
    echo "<a href = 'register.php'>Return to registration</a> ";

}

mysqli_stmt_close($stmt);
mysqli_close($connection);
?>
