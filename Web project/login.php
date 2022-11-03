<!DOCTYPE html>
<html>

<head>
    <title>LOGIN</title>
    <link rel="stylesheet" href="css/style_menu.css">
    <link rel="stylesheet" href="css/style_login.css">
    <script src="https://kit.fontawesome.com/76bd7cf633.js" crossorigin="anonymous"></script>

</head>

<body>
        <?php
                require_once './menu.php';
                build_menu();
        ?>

<div class="content">
    <form action="./authentificator.php" method="post">
        <h2>LOGIN</h2>
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
        <input type="text" name="emailOrUsername" placeholder="User Name"><br>
        <label>Password</label>
        <input type="password" name="password" placeholder="Password"><br>
        <button type="submit" name="submit">Login</button>
        <a href="signin.php" class="button">Sign In</a>
    </form>
    </div>
</body>
</html>