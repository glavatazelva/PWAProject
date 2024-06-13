<?php
include 'connect.php';


$query = 'SELECT MAX(id) AS max_id FROM clanci';
            $result = mysqli_query($connection, $query);

            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $max_id = $row['max_id'];
            }

?>