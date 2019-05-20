<nav class="navbar">
    <a href="index.php"><img src="data/images/Asset 2.svg"class="logo">
    <a  href="profile.php?id=<?php echo $_SESSION['user_id']; ?>"> <img src="data/images/Asset 8.svg" class="profile"></a>
    <a href="search.php"><img src="data/images/asset_search_vector.png"class="search"></a>
    <a href="index.php"><img src="data/images/Asset 4.svg"class="home"></a>

    <a href="logout.php" class="logout"><img src="data/images/Asset 5.svg"class="Out"></a>
    <p>Welcome <?php echo $_SESSION['firstname']." ".$_SESSION['lastname'];?>!</p>
</nav>