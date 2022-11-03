<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style_login.css">
    <link rel="stylesheet" href="./css/style_menu.css">
    <script src="https://kit.fontawesome.com/76bd7cf633.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <?php
    require_once './menu.php';
    build_menu();
    ?>
    <div class="content">
    <form action="./auction_adder.php" enctype="multipart/form-data" method="post">
        <input type="text" name="title" placeholder="Titlu">
        <input type="textarea" name="description" placeholder="Descriere">
        <input type="file" name="picture" placeholder="Poza">
        <input type="number" name="price" placeholder="Pret de inceput">
        <input type="date" name="end_time" placeholder="Data inchiderii">
        <input type="number" name="step" placeholder="Cu cat se pluseaza">
        <input type="submit" name="submit_auction" value="Adauga licitatie">
    </form>   
    </div>
</body>
</html>