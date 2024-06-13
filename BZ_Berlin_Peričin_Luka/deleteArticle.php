<?php
    include 'connect.php';

    if(isset($_GET["id"])) {
        $id = $_GET["id"];
    } else {
        echo "<script type='text/javascript'>
        alert('Error while deleting article!');
        window.location.href = 'index.php';
      </script>";
    }

    $query = "DELETE FROM clanci WHERE id = $id";

    if (mysqli_query($connection, $query)) {
        echo "<script type='text/javascript'>
        alert('Article with id $id successfully removed from database!');
        window.location.href = 'editArticles.php';
      </script>";
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($connection);
    }

?>