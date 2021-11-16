<?php
    //Options//
    session_start();
    //Values//
    $username = $_POST['username'];
    $password = $_POST['password'];
    $newpassword = password_hash($_POST['newpassword'], PASSWORD_DEFAULT);
    //Mysqli Setup//
    include("../mysql.php");
    $stmt = $mysqli->prepare("SELECT * FROM `dj_accounts` WHERE `username` = ?");
    $stmt->bind_param("s", $username);
    $stmt2 = $mysqli->prepare("UPDATE `dj_accounts` SET `password` = ? WHERE `username` = ?");
    $stmt2->bind_param("ss", $newpassword, $username);
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
                    $stmt->store_result();
                    if ($stmt2->execute()) {
                        $error2 = $stmt2->error;
                        if (isset($error2)) {
                            $_SESSION['error'] = "Incorrect Username/Password.";
                            header("Location: ./");
                        }
                        $_SESSION['error'] = "Your password has been changed!";
                        header("Location: ./");
                    }
                } else {
                    $_SESSION['error'] = "Incorrect Username/Password.";
                    header("Location: ./");
                }
        }
    }
?>