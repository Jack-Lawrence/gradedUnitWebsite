<?php
include_once "connect.php";

$page_refresh = "";

if (isset($_POST["regSubmit"])) {
    //Transfer of inputted data to the database
    $userName = $_POST["userName"];
    $emailAddress = $_POST["emailAddress"];
    $password = $_POST["password"];
    $passwordConfirm = $_POST["passwordConfirm"];

    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $avatar = $_POST["avatar"];

    //Check confirmation of both passwords being equal to each other
    if ($password != $passwordConfirm) {
        $display_block = "Your given passwords do not match.";
        $page_refresh = <<<REF
  <script>
    var url= "register.php";
    window.location = url;
  </script>
REF;
    } else {
        //Check for the given email address in the database
        $sql = "SELECT userID FROM user WHERE emailAddress = \"$emailAddress\"";
        $results = mysqli_query($conn, $sql);
        $rowCount = mysqli_num_rows($results);

        $sql = "SELECT userID FROM user WHERE userName = \"$userName\"";
        $results = mysqli_query($conn, $sql);
        $rowCountTwo = mysqli_num_rows($results);

        //If the database check reveals the email is already taken
        if ($rowCount > 0 || $rowCountTwo > 0) {
            if ($rowCount > 0) {
                $display_block = "That email has already been used!";
            } else {
                $display_block = "That username has already been used!";
            }

            $page_refresh = <<<REF
<script>
var url= "register.php";
window.location = url;
</script>
REF;
        } else {
            //Password encryption
            $passwordEnc = password_hash($password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO user VALUES(NULL,'$userName','$emailAddress','$passwordEnc','$firstName','$lastName','$avatar')";
            mysqli_query($conn, $sql);
            $display_block = "Your Account has been created!";
            $display_block .= <<<EOD
              <br>
              <a href="index.php" class="back__to__login">Back To Login</a>
            EOD;
            //Endif
        }
    }
} else {
    $display_block = <<<EOD
  <form action="register.php" method="post">
  <div class="register__form">
    <div class="register__left">
      <h1>Register</h1>
      <div class="user__box">
        <input type="email" name="emailAddress" pattern="[A-Za-z0-9@.]{0,255}" required/>
        <label>Email</label>
      </div>
      <div class="user__box">
          <input type="password" name="password" id="myInput" pattern="[A-Za-z0-9@.]{0,255}" required/>
          <label>Password</label>
      </div>
      <div class="user__box">
        <input type="password" name="passwordConfirm" pattern="[A-Za-z0-9@.]{0,255}" required/>
        <label>Password Confirm</label>
      </div>
    </div>
    <div class="register__divider">
      <p>────────────────────────────────────────────</p>
    </div>
    <div class="register__right">
      <div class="avatar__container">
        <img src="images\avatarPlaceholder.png" id="preview__image">
        <input type="file" id="file" accept=".png, .jpg, .jpeg" name="avatar" onchange="previewImage(event);  required" >
        <label for="file" id="avatar__upload"></label>
      </div>
      <div class="user__box">
        <input type="text" name="userName" pattern="[A-Za-z0-9@.]{0,255}" required/>
        <label>Username</label>
      </div>
      <div class="user__box">
        <input type="text" name="firstName" pattern="[A-Za-z0-9@.]{0,255}" required/>
        <label>First Name</label>
      </div>
      <div class="user__box">
        <input type="text" name="lastName" pattern="[A-Za-z0-9@.]{0,255}" required/>
        <label>Last Name</label>
      </div>
      <div class="login__submit">
        <a href="profile.html"><button>Login</button></a>
        <input type="submit" name="regSubmit" value="Create">
      </div>  
    </div>  
</div>  
</form>
EOD;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <script src="https://kit.fontawesome.com/1a831f6d78.js" crossorigin="anonymous"></script>
    <script src="java.js"></script>
    <title>Port</title>
</head>
<body>
    <div class="login__container">
        <div class="register__box">
          <?php echo $display_block;?>
          <?php echo $page_refresh; ?>
        </div>  
    </div>
</body>
</html>