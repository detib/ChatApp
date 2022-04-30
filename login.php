<?php

  require 'config/database.php';
  require 'config/enc.php';

  
  $accountError = false;
  $accountActiveError = false;

  if ( isset( $_POST['submit'] ) ) { 
    $username = mysqli_real_escape_string( $conn, $_POST['username'] ); 
    $password = mysqli_real_escape_string( $conn, $_POST['password'] );

    $query = "SELECT * FROM users WHERE username = '$username'"; 
    $result = mysqli_query( $conn, $query );
    $result = mysqli_fetch_assoc( $result ); 
    if ( $result ) {
      if ( openssl_decrypt( $result['password'], ENCRYPT_METHOD, HASH ) == $password ) {
          session_start();
          $_SESSION['user'] = $result;
          header( 'Location: index.php' );
          die();
      } else {
        $accountError = "Wrong password.";
      }
    } else {
      $accountError = "Invalid username.";
    }

  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/login.css">
    <link rel="stylesheet" href="styles/inc.css">
    <script src="https://kit.fontawesome.com/a1f1e2f8b3.js" crossorigin="anonymous"></script>
    <title>CHATTER | Login</title>
</head>

<body>
    <?php require 'inc/navbar.php' ?>
    <div class='login-box'>
        <div class='form-title'>
            <h6>Log In</h6>
            <p>Log in using the information you registered with</p>
        </div>
        <?php if ( !$accountActiveError ): ?>
        <form method="post" action='<?= $_SERVER['PHP_SELF'] ?>' class='login-form'>
            <div class='form-field'>
                <label for='login-email'>Username</label>
                <div class='login-input-field'>
                    <input name="username" type='text' placeholder='Type Username Here' id='login-email' 
                        value="<?= $accountError== "Wrong password." ? $_POST['username'] : NULL?>"/>
                </div>
            </div>
            <div class='form-field'>
                <label for='login-password'>Password</label>
                <div class='login-input-field'>
                    <input name="password" type='password' placeholder='Type Password Here' id='login-password' />
                </div>
            </div>
            <?php if($accountError):?>
                <div class="form-field not-active">
                    <p><?= $accountError ?></p>
                </div>
            <?php endif; ?>
            <input name="submit" type='submit' value='Log In' />
            <p>Don't have an account? <a href="register.php">Sign Up</a></p>
        </form>
        <?php else: ?>
        <div class='form-field not-active'>
            <p><?= $accountActiveError; ?></p>
        </div>
        <div class="login-with-another-acc" style="padding-bottom: 100px;">
            <a href="login.php">Login with another account</a>
        </div>
        <?php endif; ?>
    </div>
</body>

</html>