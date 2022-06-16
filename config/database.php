<?php

    define( "DB_HOST", "remotemysql.com" );
    define( "DB_USER", "xx9tjDv0Fg" );
    define( "DB_PASS", "MuzHmV4ZdO" );
    define( "DB_NAME", "xx9tjDv0Fg" );

    $host = "remotemysql.com";
    $user = "xx9tjDv0Fg";
    $pass = "MuzHmV4ZdO";
    $db = "xx9tjDv0Fg";

    // $conn = mysqli_connect( DB_HOST, DB_USER, DB_PASS, DB_NAME );
    $conn = mysqli_connect($host, $user, $pass, $db);

    if ( !$conn ) {
      echo ( "Connection failed: " . mysqli_connect_error() );
    }
?>