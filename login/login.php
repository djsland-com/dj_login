<?php
    //Options//
    session_start();
    //Values//
    $username = $_POST['username'];
    $password = $_POST['password'];
    //Mysqli Setup//
    $mysqli = new mysqli("localhost", "USER", "PASSWORD", "DATABASE");
    $stmt = $mysqli->prepare("SELECT * FROM `dj_accounts` WHERE `username` = ?");
    $stmt->bind_param("s", $username);
    //Execute//
    if ($stmt->execute()) {
        $error = $stmt->error;
        if (isset($error)) {
            $_SESSION['error'] = "Incorrect Username/Password.";
            header("Location: ./");
        }
        $result = $stmt->get_result();
        while ($row = $result->fetch_array(MYSQLI_NUM)) {
                if (password_verify($password, $row[3])) {
                    $_SESSION['dj_logged_in'] = 1;
                    $_SESSION['dj_userid'] = $row[0];
                    $_SESSION['dj_username'] = $row[2];
                    $_SESSION['error'] = "Thanks for logging in.";
                    header("Location: ./");
                } else {
                    $_SESSION['error'] = "Incorrect Username/Password.";
                    header("Location: ./");
                }
        }
    }
?>
