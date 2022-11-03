<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css//style_mainpage.css">
    <link rel='stylesheet' href='./css/style_menu.css'>
    <script src="https://kit.fontawesome.com/76bd7cf633.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <?php
    require_once './menu.php';
    build_menu();
    ?>
    <div class="content">
    <?php
    require_once './database_connector.php';
    $conn = DatabaseConnector::getInstance()->getConnection();
    $sql = "SELECT * FROM `auction`";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            if($row['Status']==0&&$row['End_Time']>date("Y-m-d")){
            echo "<a class=\"nohover\" href=\"display_auction.php/?auction_id=".$row['ID']."\">";
            echo "<div class='auction'>";
            echo "<img src=".$row['Picture']." alt=\"Imagine licitatie\">";
            echo "<h3>".$row['Name']."</h3>";
            echo "<p>"."Bid curent: ".$row['Max_Price']." RON"."</p>";
            echo "<form action='./functions.php' method='post'>";
            echo "<input type='hidden' name='auction_id' value=".$row['ID'].">";
            echo "</form>";
            echo "</div>";
            echo "</a>";
            }
        }
    }
    ?>
    </div>

    
</body>
</html>