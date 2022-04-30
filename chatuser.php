<?php

  require 'config/database.php';

  $chatreciever = $_GET['user'];

  $query = "SELECT name,surname,username,picture FROM users where username = '$chatreciever'";
  $result = mysqli_query( $conn, $query );
  $reciever = mysqli_fetch_assoc( $result );

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/inc.css">
    <link rel="stylesheet" href="styles/chatuser.css">
    <script src="js/chatuser.js" defer></script>
    <title>Chat <?="user" ?></title>
</head>

<body>
    <?php

      require 'inc/navbar.php';

      if(!$user) {
        header("Location: index.php");
      }

      $chatquery = "SELECT * FROM chats 
                        WHERE 
                            (creatorid='$username' AND recieverid='$chatreciever') 
                        OR 
                            (creatorid='$chatreciever' AND recieverid='$username')";
      $chats = mysqli_query( $conn, $chatquery );
      $chats = mysqli_fetch_all( $chats, MYSQLI_ASSOC );
    ?>

    <div class="chat-box">
        <div class="chat-box-header">
            <div class="chat-box-header-img">
                <img src="userImages/<?=$reciever['picture'] ?>" alt="">
            </div>
            <div class="chat-box-header-info">
                <h4><?=$reciever['name'] ?> <?=$reciever['surname'] ?></h4>
                <p><?=$reciever['username'] ?></p>
            </div>
        </div>
        <div class="chat-content" id="chat-box-messages">
            <?php if ( $chats ): foreach ( $chats as $chat ): ?>

            
            <?php if($chat['creatorid'] == $username): ?>
                <div class="chat-single-message chat-creator">
                    <p class="chat-time"><?= $chat['created_at']?></p>
                    <p class="chat-body"><?= $chat['body']?></p>
                </div>
            <?php else: ?>
                <div class="chat-single-message chat-reciever">
                    <p class="chat-body"><?= $chat['body']?></p>
                    <p class="chat-time"><?= $chat['created_at']?></p>
                </div>
            <?php endif;?>
            <?php endforeach; ?>
            <?php else: ?>
            <p>No messages yet</p>
            <?php endif; ?>
        </div>
        <div class="chat-input">
            <form action="config/sendmessage.php" method="post">
                <textarea rows="1" class="body-input" required type="text" name="body"
                    placeholder="Type a message..."></textarea>
                <input type="hidden" name="creatorid" value="<?=$username ?>">
                <input type="hidden" name="chatreciever" value="<?=$chatreciever ?>">
                <input class="text-submit" type="submit" value="Send Message" name="submit">
            </form>
        </div>
    </div>

</body>

</html>