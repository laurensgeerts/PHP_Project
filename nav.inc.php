<nav class="navbar">
    <img src="data/images/Asset 2.svg">
    <a href="edit_profile.php"><img src="data/images/Asset 8.svg"></a>
    <a href="index.php"><img src="data/images/Asset 4.svg"></a>
    <a href="logout.php" class="logout"><img src="data/images/Asset 5.svg"></a>
    <p>Welcome <?php echo $_SESSION['firstname']." ".$_SESSION['lastname'];?>!</p>
</nav>