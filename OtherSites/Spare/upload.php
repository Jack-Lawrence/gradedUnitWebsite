<?php
  include_once("connect.php");

  session_start();

  //If not logged in move to login page
  if(!isset($_SESSION["userID"])){
    header("location: index.php?error=You are not logged in");
    die;
  }

  //Sending uploaded file to display block
  if(isset($_GET["upload"])){
    $display_block = $_GET["upload"];
  }
  else
  {
    $display_block = "";
  }

  //Check if admin
  $userID = $_SESSION["userID"];

  $adminDisplay = "";

  //Checking if specifically logged into the only admin account on the page
  if($_SESSION["userID"] == 4){
    $adminDisplay = <<<EOD
    <a href="admin.php"><img src="images\icons\admin.png" alt="admin logo" class="nav-icon"></a>
    EOD;
  } else {
    $adminDisplay = <<<EOD
    <a href="profile.php"><img src="images\icons\profile.png" alt="profile logo" class="nav-icon"></a>
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
    <link rel="icon" type="image/x-icon" href="images\logo.ico" />
    <title>Upload</title>
  </head>
  <body>
    <container class="upload">
    <header class="header-nav">
      <div class="header-split">
            <a href="feed.php"><img src="images\icons\home.png" alt="home logo" class="nav-icon"></a>
            <a href="upload.php"><img src="images\icons\upload.png" alt="upload logo" class="nav-icon selected"></a>
          </div>
      <div class="header-split">
      <a href="feed.php"><img src="images\logoSmall.png" alt="Website Logo" class="header-nav-logo"/></a>
        </div>
          <div class="header-split">
            <?php echo $adminDisplay; ?>
            <a href="logout.php"><img src="images\icons\logout.png" alt="logout logo" class="nav-icon"></a>
        </div>
      </header>
    <form action="uploadfile.php" enctype="multipart/form-data" method="POST">
        <div class="upload-content">
          <div class="image-preview-container">
            <div class="preview">
              <img id="preview-selected-image" alt="Image Upload Preview"/>
            </div>
          <label for="file-upload">Choose Image</label>
          <input type="file" class="hidden" id="file-upload" name="post" accept=".png, .jpg, .jpeg" onchange="previewImage(event);  required"/>
          </div>
          <div class="upload-description">
           <p>Description:</p>
            <label for="desc" hidden>DescriptionBox</label>
            <input type="text" id="desc" name="postDesc" pattern="[A-Z a-z0-9@!.#,]{0,40}" oninvalid="alert('Only A-z, 0-9, and @!.,# Allowed | 40 CHARACTER LIMIT')">
            <input type="submit" class="hidden" id="file-submit" value="Upload your Post!"/>   
            <script src="java.js"></script>
            <p class="post-success"><?php echo $display_block;?></p>
          </div>
        </div>
      </form>
    </container>
  </body>
</html>
