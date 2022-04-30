<?php 


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/inc.css">
    <link rel="stylesheet" href="styles/index.css">
    <script src="https://kit.fontawesome.com/a1f1e2f8b3.js" crossorigin="anonymous"></script>
    <title>Chat App</title>
</head>
<body>
    <?php 
        require 'inc/navbar.php'; 
        require 'config/database.php';
        
        $query = "SELECT name,surname,username,picture FROM users WHERE username!='$username'";
        $result = mysqli_query( $conn, $query );
        $result = mysqli_fetch_all( $result, MYSQLI_ASSOC );
    ?>

    <div class="users-box">
        <?php if($user): foreach($result as $user): ?>
        <div class="single-user-box">
            <a href="chatuser.php?user=<?= $user['username']?>">
                <div class="user-box-img">
                    <img src="userImages/<?= $user['picture'] ?>" alt="">
                </div>
                <div class="user-box-info">
                    <h4><?= $user['name'] ?> <?= $user['surname'] ?></h4>
                    <p><?= $user['username'] ?></p>
                </div>
            </a>
        </div>
        <?php endforeach; ?>
        <?php else: ?>
        <p>You are not logged in!</p>
        <?php endif; ?>
    </div>
</body>
</html>