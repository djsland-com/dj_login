<?php
    //Options//
    session_start();
    //Values//
    $id = rand(0,999999);
    $ip = $_SERVER['REMOTE_ADDR'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    //Username Length Check//
    if (strlen($username) > 32) {
        $_SESSION['error'] = "Username Over 32 Chars.";
        header("Location: ./");
    }
    //Mysqli Setup//
    $mysqli = new mysqli("localhost", "USER", "PASSWORD", "DATABASE");
    //Check Setup for User//
    $check = $mysqli->prepare("SELECT * FROM `dj_accounts` WHERE `username` = ?");
    $check->bind_param("s", $username);
    //Statement Setup for Registration//
    $register = $mysqli->prepare("INSERT INTO `dj_accounts` VALUES (?, ?, ?, ?)");
    $register->bind_param("ssss", $id, $ip, $username, $password);
    //Execution of Check//
    $check->execute();
    $check->store_result();
    //Make sure there is no matching username//
    if ($check->num_rows > 0) {
        $check->close();
        $_SESSION['error'] = "Username Taken.";
        header("Location: ./");
    } else if ($register->execute()) {
        //Finish Registration//
        $_SESSION['error'] = "Registration Successful!";
        header("Location: ./");
    }
    echo $register->error;
    //Close//
    $mysqli->close();
    $register->close();
?>
