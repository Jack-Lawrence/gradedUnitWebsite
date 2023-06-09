<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <script src="java.js"></script>
    <script src="https://kit.fontawesome.com/1a831f6d78.js" crossorigin="anonymous"></script>
    <title>Port</title>
</head>
<body>
    <div class="feed__container">
        <header class="website__nav"> 
            <div class="nav__split">
				<a href="feed.html"><i class="fa-solid fa-fw fa-rss selected"></i></a>
                <a href="feed.php"><i class="fa-regular fa-fw fa-compass"></i></a>
                <a href="feed.php"><i class="fa-solid fa-fw fa-arrow-up-from-bracket"></i></a>
            </div>
            <div class="nav__split">
                <h1>PORT</h1>
            </div>
            <div class="nav__split">
                <a href="profile.html"><i class="fa-regular fa-fw fa-user"></i></a>
                <a href="messages.html"><i class="fa-regular fa-fw fa-message"></i></a>
                <a href="logout.php"><i class="fa-solid fa-fw fa-arrow-right-from-bracket"></i></a>
                <button class="dropdown" onclick="openMenu()">Menu</button>
            </div>
        </header>
    </div>
    <div id="mobile__menu" class="overlay">
        <a class="close" onclick="closeMenu()">&times;</a>
        <div class="overlay__content">
            <a href="feed.html" onclick="closeMenu()"><i class="fa-solid fa-fw fa-rss nav__icon"></i>Feed</a>
            <a href="#" onclick="closeMenu()"><i class="fa-regular fa-fw fa-compass nav__icon"></i>Explore</a>
            <a href="#" onclick="closeMenu()"><i class="fa-solid fa-fw fa-arrow-up-from-bracket nav__icon"></i>Upload</a>
            <a href="profile.html" onclick="closeMenu()"><i class="fa-regular fa-fw fa-user selected nav__icon"></i>Profile</a>
            <a href="messages.html" onclick="closeMenu()"><i class="fa-regular fa-fw fa-message nav__icon"></i>Messages</a>
            <a href="#" onclick="closeMenu()"><i class="fa-solid fa-fw fa-arrow-right-from-bracket nav__icon"></i>Sign Out</a>
        </div>
    </div>
</body>
</html>