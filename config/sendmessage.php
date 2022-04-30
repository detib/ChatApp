<?php 

require 'database.php';
require 'session.php';

if(!isset($_POST['submit']) || !$user) {
    header("Location: ../index.php");
    die();
}

$textbody = $_POST['body'];
$creator = $_POST['creatorid'];
$reciever = $_POST['chatreciever'];

$query = "INSERT INTO chats(creatorid, recieverid, body) VALUES ( '$creator', '$reciever', '$textbody')";

if(mysqli_query($conn, $query)) {
    header("Location: ../chatuser.php?user=$reciever");
} else {
    echo "Error: " . $query . "<br>" . mysqli_error($conn);
}

?>