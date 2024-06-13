<?php
include 'connect.php';


$query = 'SELECT MIN(id) AS min_id FROM clanci';
            $result = mysqli_query($connection, $query);

            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $min_id = $row['min_id'];
            }

?>