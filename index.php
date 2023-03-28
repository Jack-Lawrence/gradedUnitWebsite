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
  } else {
    $display_block = <<<EOD
    <div class="login__box">
    <h1>Sign In</h1>
    <form action="index.php" method="POST">
        <div class="user__box">
            <input type="email" name="emailAddress" pattern="[A-Za-z0-9@.]{0,255}" required/>
            <label>Email</label>
        </div>
        <div class="user__box">
            <input type="password" name="password" pattern="[A-Za-z0-9@.]{0,255}" required/>
            <label>Password</label>
        </div>
        <div class="login__submit">
            <input type="submit" name="logSubmit" value="Login">
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
    <title>Port</title>
</head>
<body>
    <div class="login__container">
    <?php echo $display_block; ?>
        <?php echo $error_block; ?>
            <a href="register.php" class="register__submit"><button>Register</button></a>
        </div>    
        <!-- <div class="dev__buttons">
            <a href="index.php"><button>Sign in</button></a>
            <a href="register.php"><button>Register</button></a>
            <a href="feed.html"><button>Feed</button></a>
            <a href="profile.html"><button>Profile</button></a>
        </div> -->
    </div>
    
</body>
</html>