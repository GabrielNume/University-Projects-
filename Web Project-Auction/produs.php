<!DOCTYPE html>
<html lang="en">
<?php session_start();
if (empty($_SESSION['id'])) :
    header('Location:./login.php');
endif; ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adauga produs la licitatie</title>
    <link rel="stylesheet" href="./app.css" />
</head>


<body>
    <?php
    require_once "./header.php"
    ?>
    <?php
    $errors = $_GET;
    if (!empty($errors)) {
        echo "<br><br>";
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
    } ?>

    <div class="content border-glow grid-container">
        <form action="./auction_adder.php" enctype="multipart/form-data" method="post">
            <input type="text" name="title" placeholder="Titlu" class="inp_prod produs_input">
            <input type="text" name="description" placeholder="Descriere" class="inp_prod produs_input" >
            <input type="file" name="picture"  class="inp_prod">
            <input type="number" name="price" placeholder="Pret de inceput" class="inp_prod produs_input">
            <input type="date" name="end_time" class="inp_prod">
            <input type="number" name="step" placeholder="Cu cat se pluseaza" class="inp_prod produs_input">
            <input type="submit" name="submit_auction" value="Adauga licitatie" class="inp_prod produs_submit produs_input">
        </form>
    </div>
    <?php
    require_once "./footer.php"
    ?>
</body>

</html>