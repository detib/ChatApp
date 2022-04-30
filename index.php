<?php 

require 'config/database.php';

$query = "SELECT name,surname,username,picture FROM users";

$result = mysqli_query( $conn, $query );
$result = mysqli_fetch_all( $result, MYSQLI_ASSOC );

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/inc.css">
    <link rel="stylesheet" href="styles/index.css">
    <title>Chat App</title>
</head>
<body>
    <?php require 'inc/navbar.php'; ?>

    <div class="users-box">
        <?php foreach($result as $user): ?>
        <div class="single-user-box">
            <!-- <a href="chatuser.php?user=<?= $user['username']?>"> -->
                <div class="user-box-img">
                    <img src="userImages/<?= $user['picture'] ?>" alt="">
                </div>
                <div class="user-box-info">
                    <h4><?= $user['name'] ?> <?= $user['surname'] ?></h4>
                    <p><?= $user['username'] ?></p>
                </div>
            <!-- </a> -->
        </div>
        <?php endforeach; ?>
    </div>

    <?php // require 'inc/footer.php'; ?>
</body>
</html>