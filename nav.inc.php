<nav class="navbar">
    <a href="edit_profile.php">profiel aanpassen?   <img src="<?php echo $profile['image'] ?>" alt="profiel"style="width:50px;"></a>
    <a href="index.php">ga naar index</a>
    <a href="logout.php" class="logout">uitloggen?</a>
    <a href="search.php">zoeken</a>
    <p><?php echo $_SESSION['email'];?></p>
 

</nav>