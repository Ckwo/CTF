<?php
 
if(!isset($_SESSION)){
    session_start();
}
echo '
    <a href="index.php" class="p-3 text-decoration-none text-light bold">Home</a>
    <a href="hackerboard.php" class="p-3 text-decoration-none text-light bold">Hackerboard</a>';
    if(!isset($_SESSION["username"])){
        echo '<a href="login.php" class="p-3 text-decoration-none text-light bold">Login</a>
                        <a href="register.php" class="p-3 text-decoration-none text-light bold">Register</a>';
    }else{
        
        echo '
        <a href="quests.php" class="p-3 text-decoration-none text-light bold">Challenges</a>
        <a href="team.php" class="p-3 text-decoration-none text-light bold">Teams</a>

        <a href="logout.php" class="p-3 text-decoration-none text-light bold">Logout</a>';

    
    }
    
?>