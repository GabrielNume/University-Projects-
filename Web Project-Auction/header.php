<header>
    <nav>

        <ul>

            <?php
            // session_start();
            if (!isset($_SESSION["logged_in"])) {
                echo "<li>
                <a href=\"./home.php\">Homepage</a>
            </li>
                <li>
                <a href=\"./login.php\">Login</a>
            </li>
           ";
            } else {
                echo "<li>
                <a href=\"./home.php\">Homepage</a>
            </li>";
                echo "<li>
            <a href=\"./produs.php\">Adauga Produs</a>
            </li>";
            }
            if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 1) {
                echo "
                
            <li>
                <a href=\"./admin.php\">Admin</a>
            </li>";
            }
            if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == true)
                echo " <li>
          
            <a href=\"./logout.php\">Logout</a>
            </li>";

            ?>
        </ul>
    </nav>
</header>