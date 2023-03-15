<?php
include_once "connect.php";

session_start();

//If not logged in move to login page
if (!isset($_SESSION["userID"])) {
    header("location: index.php?error=You are not logged in");
    die();
}

//Check if admin
$userID = $_SESSION["userID"];

$adminDisplay = "";

if ($_SESSION["userID"] == 4) {
    $adminDisplay = <<<EOD
<a href="admin.php"><img src="images\icons\admin.png" alt="admin logo" class="nav-icon"></a>
EOD;
} else {
    $adminDisplay = <<<EOD
<a href="profile.php"><img src="images\icons\profile.png" alt="profile logo" class="nav-icon"></a>
EOD;
}

//Display post's from database
$sql =
    "SELECT * from post, user where post.userID=user.userID ORDER BY postID desc LIMIT 10";
$results = mysqli_query($conn, $sql);
$sectionCounter = 0;
$display_block = "";

while ($row = mysqli_fetch_array($results)) {
    $postNo = $row["postID"];
    parse_url($postNo);

    $display_block .= <<<EOD
  <div class="feed-container" id="section-$sectionCounter">
  <div class="feed-post">
    <div class="feed-post-username">
      <p>
        @$row[userName]
      </p>
    </div>
    <div class="feed-post-image">
      <img src="uploads/$row[userID]/$row[fileName]" alt="User Upload" width="500"
      height="600" />
    </div>
    <div class="feed-post-interaction">
      <p class="feed-post-description">
        $row[description]
      </p>
      <p class="break">
        ——————————————————————————————
      </p>
      <form action="load.php?jump=$sectionCounter" method="POST">
        <div class="feed-post-interact">
          <input type="hidden" value="$postNo" name="postNum">
          <button type="submit" value="like" name='like' style="all: unset;">
            <img src="images/icons/rating.png" alt="rating icon" />
          </button>
          <p class="feed-likes">
            $row[likes]
          </p>
          <label for="comment" hidden>Comment</label>
          <input type="text" name="comment" id="comment" pattern="[A-Z a-z0-9@.!]{0,255}">
          <input type="hidden" value="$postNo" name="postNum">
          <button type="submit" style="all: unset;">
            <img src="images/icons/comment.png" alt="comment icon"  />
          </button>
        </div>
      </form>
      <script> 
          function refreshPage(){
            window.location.reload();
        } 
      </script>
      <div class="feed-post-comment-box">
EOD;

    $sectionCounter++;

    $sql = "SELECT * from comment, user where comment.userID=user.userID and postID=\"$postNo\" ORDER BY commentID desc";
    //echo($sql);
    //die;

    $commentInfo = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_array($commentInfo)) {
        $display_block .= <<<EOD
<div class="feed-post-comments">
        <p><b>$row[userName]:</b> $row[commentDesc]</p>
      </div>
EOD;
    }
    $display_block .= <<<EOD
      </div>
    </div>
  </div>
</div>
EOD;
}
?>
<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta name="author" content="Jack Lawrence" />
		<link rel="stylesheet" href="style.css" />
		<link rel="icon" type="image/x-icon" href="images\logo.ico" />
		<title>Rait</title>
	</head>

	<body>
		<container class="feed">
			<header class="header-nav">
				<div class="header-split">
					<a href="feed.php"><img src="images\icons\home.png" alt="home logo" class="nav-icon selected"></a>
					<a href="upload.php"><img src="images\icons\upload.png" alt="upload logo" class="nav-icon"></a>
				</div>
				<div class="header-split">
					<a href="feed.php"> <img src="images\logoSmall.png" alt="Website Logo" class="header-nav-logo" /></a>
				</div>
				<div class="header-split">
					<?php echo $adminDisplay; ?>
					<a href="logout.php"><img src="images\icons\logout.png" alt="logout logo" class="nav-icon"></a>
				</div>
			</header>
			<div class="feed-wrapper">
				<?php echo $display_block; ?>
			</div>
		</container>
	</body>

</html>