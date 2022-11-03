<!DOCTYPE html>
<html>

<head>
    <title>SIGN IN</title>
    <link rel="stylesheet" href="css/style_login.css">
    <link rel="stylesheet" href="css/style_menu.css">
    <script src="https://kit.fontawesome.com/76bd7cf633.js" crossorigin="anonymous"></script>


</head>

<body>
    <?php
    require_once './menu.php';
    build_menu();
    ?>
<div class="content">
    <form action="./signinator.php" method="post">
        <h2>SIGN IN</h2>
        <?php 
        $errors = $_GET;
        foreach ($errors as $key => $error) {
            echo "<ul class='error' style='list-style-type:none'>";
            foreach ($error as $value) {
                echo "<li>$value</li>";
            }
            echo "</ul>";
        }
        ?>
        <label>User Name</label>
        <input type="text" name="Username" placeholder="User Name"><br>
        <label>Email</label>
        <input type="text" name="Email" placeholder="Email"><br>
        <label>Password</label>
        <input type="password" name="password" placeholder="Password"><br>
        <button type="submit" name="submit">Sign In</button>
        <a href="login.php" class="button">Log In</a>
    </form>
    </div>
</body>
</html> 