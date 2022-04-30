<?php

    session_start();
    if ( isset( $_SESSION['user'] ) ) {
        $user = $_SESSION['user'];
        $name = $user['name'];
        $surname = $user['surname'];
        $username = $user['username'];
        $password = $user['password'];
        $picture = $user['picture'];
    } else {
        $user = NULL;
    }
?>