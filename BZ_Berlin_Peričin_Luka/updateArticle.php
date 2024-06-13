<?php
    include 'connect.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        if (isset($_GET["id"])) {
            $id = $_GET["id"];
        }

        $long_title = $_POST['long_title'];
        $short_title = $_POST['short_title'];
        $text = $_POST['text'];
        $kategorija = $_POST['category'];
        $slika = $_FILES['img']['name'];
        $target = "images/". $slika;
        move_uploaded_file($_FILES['img']['tmp_name'], $target);

        

            $sql = "UPDATE clanci
                    SET podnaslov = ?, naslov = ?, text = ?, kategorija = ?, path = ?
                    WHERE id = ?;";
            $stmt = mysqli_stmt_init($connection);

            if (mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param($stmt, "sssssi", $short_title, $long_title, $text, $kategorija,$target, $id);

                if (mysqli_stmt_execute($stmt)) {
                    echo "<script type='text/javascript'>
                        alert('Successfull article update');
                        window.location.href = 'editArticles.php';
                      </script>";
                } else {
                    echo "Error updating record: " . mysqli_stmt_error($stmt);
                }
            } else {
                echo "Error preparing statement: " . mysqli_error($connection);
            }

            mysqli_stmt_close($stmt);


        mysqli_close($connection);
    }
?>
