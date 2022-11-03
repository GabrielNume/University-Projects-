<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php 
        if (!empty($_GET)) {
            $errors_matrix = $_GET;
            foreach ($errors_matrix as $line) {
                foreach ($line as $value) {
                    echo "<p>$value</p>";
                }
            }
        }    
    ?>
    <form action="./login_script.php" method="post">
        <label for="">Email</label>
        <input type="email" name="email" autocomplete="off">
        <label for="">Password</label>
        <input type="password" name="password">
        <input type="submit" name="submit" value="Login">
    </form>


</body>

</html>