<nav class="navbar">
    <a href="index.php"><img src="data/images/Asset 2.svg"class="logo">
    <a href="profile.php"><img src="data/images/Asset 8.svg" class="profile"></a>
    <a href="index.php"><img src="data/images/Asset 4.svg"class="home"></a>
    <a href="logout.php" class="logout"><img src="data/images/Asset 5.svg"class="Out"></a>
    <p>Welcome <?php echo $_SESSION['firstname']." ".$_SESSION['lastname'];?>!</p>
</nav>