<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $password = $_POST['password'];

        include 'connect.php';


        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = mysqli_stmt_init($connection);


        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, 's', $email);

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            if ($user = mysqli_fetch_assoc($result)) {
                if (password_verify($password, $user['password'])) {
                    session_start();
                    $_SESSION['user'] = $user['firstName'] . " " . $user['lastName'];
                    $_SESSION['access'] = $user['access'];

                    header("Location: index.php");
                    exit();
                } else {
                    echo "<script type='text/javascript'>
                            alert('Login details are wrong!');
                            window.location.href = 'login.php';
                          </script>";
                    exit();
                }
            } else {
                echo "<script type='text/javascript'>
                        alert('No user found with that email!');
                        window.location.href = 'login.php';
                      </script>";
                exit();
            }
        } else {
            echo "Error executing query.";
            echo "<a href='login.php'>Return to login</a>";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "Error preparing statement.";
        echo "<a href='login.php'>Return to login</a>";
    }

    mysqli_close($connection);
}
?>