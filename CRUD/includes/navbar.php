<nav>
    <div>
        <label class="logo">CRUD APP</label>
    </div>

    <div class="link-container">
        <a href="index.php" class="menu-link">Menu</a>

        <?php if (isset($_SESSION["is_logged_in"]) && $_SESSION["is_logged_in"] == true): ?>
            <a href="logout.php">Logout</a>
        <?php else: ?>
            <a href="login.php">Login</a>
        <?php endif; ?>
        
    </div>  
</nav>