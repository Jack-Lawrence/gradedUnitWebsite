<?php
  include_once("connect.php");

  session_start();

  //If logged in already forward to feed
  if(isset($_SESSION["userID"])){
    header("location: feed.php");
    die;
  }

  //Display error for not being logged in
  if(isset($_GET["error"])){
    $error_block = $_GET["error"];
  }
  else
  {
    $error_block = "";
  }

  if(isset($_POST["logSubmit"])){
    //Data to process
    $emailAddress = $_POST["emailAddress"];
    $password = $_POST["password"];

    //Ask the database for the password associated with the given email address
    $sql = "SELECT userID, password FROM user WHERE emailAddress=\"$emailAddress\"";
    $results = mysqli_query($conn, $sql);

    //If nothing comes back
    if(mysqli_num_rows($results) == 0){
      //Display a user not found error message
      header("location: index.php?error=That email is not registered.");
    }
    else
    {
      //Extract the row from the results;
      $row = mysqli_fetch_array($results);
      
      //Compare the password vs the encrypted one
      $passwordOK = password_verify($password, $row["password"]);

      //Check pass
      if($passwordOK){
        //Log them in 
        $_SESSION["userID"] = $row["userID"];
        header("location: feed.php");
      }
      else 
      {
        //Display password incorrect error msg
        header("location: index.php?error=That password is incorrect.");

      }
    }
  }
  else
  {
    //Form to display log in
    $display_block = <<<EOD
    <form action="index.php" method="POST">
    <div class="user-box">
      <input type="email" name="emailAddress" pattern="[A-Za-z0-9@.]{0,255}" required/>
      <label>Email</label>
    </div>
    <div class="user-box">
      <input type="password" name="password" pattern="[A-Za-z0-9@.]{0,255}" required/>
      <label>Password</label>
    </div>
    <div class="submit-box">
      <input type="submit" name="logSubmit" value="Login">
      <p>—————  OR  —————</p>
      <a href="register.php">Register</a>
    </div>
  </form>
  EOD;
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <script src="java.js"></script>
    <link rel="icon" type="image/x-icon" href="images\logo.ico" />
    <title>Login</title>
  </head>
  <body class="align">
    <div class="login-box">
        <img src="images\loginLogo.png" alt="logo" class="logo"/>
        <h2>Login</h2>
        <?php echo $display_block; ?>
        <?php echo $error_block; ?>
      </div>
    <div class="popup" onclick="popUp()" ><h5>Contact Us</h5>
      <span class="popuptext" id="myPopup">jacklawrence5225@gmail.com</span>
    </div>  

    </div>
  </body>
</html>
