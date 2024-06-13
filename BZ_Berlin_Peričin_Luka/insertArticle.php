<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $long_title = $_POST['long_title'];
    $short_title = $_POST['short_title'];
    $text = $_POST['text'];
    $kategorija = $_POST['category'];
    $slika = $_FILES['img']['name'];
    $target = "images/" . $slika;

    if (move_uploaded_file($_FILES['img']['tmp_name'], $target)) {
        $sql = "INSERT INTO clanci (`path`, `podnaslov`, `naslov`, `text`, `kategorija`) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($connection);

        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, 'sssss', $target, $short_title, $long_title, $text, $kategorija);

            if (mysqli_stmt_execute($stmt)) {
                echo "<script type='text/javascript'>
                    alert('Article added successfully!');
                    window.location.href = 'newArticle.php';
                  </script>";
            } else {
                echo "Error executing query: " . mysqli_stmt_error($stmt);
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Error preparing statement: " . mysqli_error($connection);
        }
    } else {
        echo "<script type='text/javascript'>
                    alert('Image not uploaded correctly!');
                    window.location.href = 'newArticle.php';
                  </script>";
    }

    mysqli_close($connection);
}
?>