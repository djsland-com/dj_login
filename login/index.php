<center>
    <?php 
        session_start();
        if (isset($_SESSION['error'])) {
            echo '<p style="color: red;">' .  $_SESSION['error'] . '</p>';
            unset($_SESSION['error']);
        }
    ?>

    <form method="post" action="login.php">
        <label for="username">Username</label>
        <input type="text" id="username" name="username"  />
        <br>
        <label for="password">Current Password</label>
        <input type="password" id="password" name="password" />
        <br>
        <input type="submit" value="Login" />
    </form>
