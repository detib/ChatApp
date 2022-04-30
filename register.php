<?php

  require 'config/database.php';
  require 'config/enc.php';

  if ( isset( $_POST['submit'] ) ) {
    $name = htmlentities( mysqli_real_escape_string( $conn, $_POST['name'] ) );
    $surname = htmlentities( mysqli_real_escape_string( $conn, $_POST['surname'] ) );
    $username = htmlentities( mysqli_real_escape_string( $conn, $_POST['username'] ) );
    $password = htmlentities( mysqli_real_escape_string( $conn, $_POST['password'] ) );

    if ( $_FILES['profile']['error'] == 0 ) {
      $file_name = $_FILES['profile']['name'];
      $file_tmp = $_FILES['profile']['tmp_name'];
      $file_ext = explode( '.', $file_name );
      $file_ext = strtolower( end( $file_ext ) );

      $file_name = "profile-pic-" . substr( base64_encode( sha1( mt_rand() ) ), 0, 20 );
      $target_dir = "userImages/$file_name.$file_ext";
      move_uploaded_file( $file_tmp, $target_dir );
    } else { 
      $file_name = "default";
      $file_ext = "png";
    }

    $password = openssl_encrypt( $password, ENCRYPT_METHOD, HASH );

    $query = "INSERT INTO
        users(name, surname, username, password, picture)
            VALUES('$name', '$surname', '$username', '$password', '$file_name.$file_ext')";

    if ( mysqli_query( $conn, $query ) ) {
      header( "Location: login.php" );
    } else {
      echo "<h1 style='color:red; font-weight: 900'>Error: " . $query . "<br>" . mysqli_error( $conn ) . "</h1>";
    }

  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/register.css">
    <link rel="stylesheet" href="styles/inc.css">
    <script src="js/register.js" defer></script>
    <script src="https://kit.fontawesome.com/a1f1e2f8b3.js" crossorigin="anonymous"></script>
    <title>CHATTER | Register</title>
</head>

<body>
    <?php require 'inc/navbar.php'; ?>
    <div class='signup-box'>
        <div class='form-title'>
            <h6>Sign Up</h6>
            <p>Fill in with your information down below</p>
        </div>
        <form action="register.php" method="post" class='signup-form' id="register-form" autocomplete="off"
            enctype="multipart/form-data">
            <div class="two-item-field">
                <div class='form-field'>
                    <label for='name'>Name</label>
                    <div class='signup-input-field'>
                        <input required type='text' placeholder='Type Your Name Here' id='name' name="name" />
                    </div>
                </div>
                <div class='form-field'>
                    <label for='surname'>Surname</label>
                    <div class='signup-input-field'>
                        <input required type='text' placeholder='Type Your Surname Here' id='surname' name="surname"/>
                    </div>
                </div>
            </div>
            <div class="two-item-field">
                <div class='form-field'>
                    <label for='username'>Username</label>
                    <div class='signup-input-field'>
                        <input required type='text' placeholder='Type Your Username Here' id='username' name="username"/>
                    </div>
                </div>
                <div class='form-field'>
                    <label for='password'>Password</label>
                    <div class='signup-input-field'>
                        <input required type='password' placeholder='Type Password Here' id='password' name="password"/>
                    </div>
                </div>
            </div>
            <div style="display: none;" id="username-exists">
                <p style="color: red; font-weight: 600;">Username already exists.</p>
            </div>
            <div style="display: none;" id="password-error">
                <p style="color: red; font-weight: 600;">Password should be 8 characters long, 1 uppercase letter, 1
                    number.</p>
            </div>
            <div class='form-field'>
                <label for='profile'>Add Profile Picture</label>
                <div class='signup-input-field'>
                    <input id="profile-image" name="profile" type='file' placeholder='Type Your Profile Here'
                        id='profile' />
                </div>
                <p id="register-error-box">Invalid file type.</p>
            </div>
            <input name="submit" type='submit' value='Sign Up' id="submit" />
        </form>
    </div>
</body>

</html>