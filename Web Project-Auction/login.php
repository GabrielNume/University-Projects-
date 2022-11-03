<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./app.css" />
    <link rel="stylesheet" href="./sigin.css" />
</head>
<?php
require_once "./header.php"
?>
<?php
$errors = $_GET;
if (!empty($errors)) {
    echo "<br><br><br>";
    foreach ($errors as $error) {
        echo "<p style=color:white;>$error</p>";
    }
}
?>
<div class="box">
    <form action="./login_process.php" method="post">
        <span class="text-center">login</span>
        <div class="input-container">
            <input type="text " name="username" autocomplete="off">
            <label class="control-label">Email</label>
        </div>
        <div class="input-container">
            <input type="Password" name="password" autocomplete="off">
            <label>Password</label>
        </div>
        <div>
            <input type="submit" class="btn" name="login" value="Log-in">
        </div>
        <br><br><br><br><br>
        <div class="input-container2">
           <label class="lb-cent">You don't have an account?</label>
            <br>
            <input type="submit" class="btn" name="submit_sig" value="Sign-in">
        </div>
    </form>
</div>
<?php
require_once "./footer.php"
?>

</html>