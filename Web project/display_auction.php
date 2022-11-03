<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='/css/style_menu.css'>
    <link rel='stylesheet' href='/css/style_auctionpage.css'>
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
            $sql = "SELECT * FROM `auction` WHERE `ID` = '$_GET[auction_id]'";
            $result = $conn->query($sql);
            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()){
                    if($row['Status']==0&&$row['End_Time']>date("Y-m-d")){
                        echo "<div class='title'>";
                        echo "<h3>".$row['Name']."</h3>";
                        echo "</div>";
                        echo "<div class='auction'>";
                        echo "<div class='picture'>";
                        echo "<img src=".$row['Picture'].">";
                        echo "</div>";
                        echo "<div class='auction_info'>";
                        $sql_user="SELECT * FROM `user` WHERE `ID` = '$row[S_ID]'";
                        $user=$conn->query($sql_user);
                        $user_row=$user->fetch_assoc();
                        echo "<p>"."Seller: ".$user_row['Nume']."</p>";
                        echo "<p>"."Bid curent: ".$row['Max_Price']." RON"."</p>";
                        echo "<p>"."Ora de inchidere: ".$row['End_Time']."</p>";
                        echo "<p>"."Pret de inceput: ".$row['Min_Price']." RON"."</p>";
                        echo "<form action='../auction_bid.php' method='post'>";
                        echo "<input type=\"number\" name=\"bid\" placeholder=\"Bid-ul tau(>=".($row['Max_Price']+$row['Step'])."): \">";
                        echo "<input type='hidden' name='id_auction' value=".$row['ID'].">";
                        echo "<input type=\"submit\" name=\"bid_auction\" value=\"Adauga bid\">";
                        echo "</form>";
                        echo "</div>";
                        echo "</div>";
                        echo "<div class='auction_description'>";
                        echo "<h3>"."Description"."</h3>";
                        echo "<p>".$row['Description']."</p>";
                        echo "</div>";
                        
                    }
                }
            }
            ?>
        </div>
</body>
</html>