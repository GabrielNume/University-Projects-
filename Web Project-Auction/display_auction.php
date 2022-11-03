<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./app.css" />

    <title>Document</title>
</head>

<body>
    <?php
    session_start();
   require_once './header.php';

    ?>
    <?php
       
     
   
       $errors = implode(" ",$_GET);
       $errors = substr($errors, 4);  
       if (!empty($errors)) {
           echo "<br><br>";
               echo "<p>$errors</p>";
       }
    ?>
    <div class="content  grid-container2  ">
        <?php
        require_once './database_connector.php';
        $conn = DatabaseConnector::getInstance()->getConnection();
      
       
     
      
       
        $sql = "SELECT * FROM `auction` WHERE `id` = ' $_GET[auction_id]'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row['status'] == 0 && $row['end_time'] > date("Y-m-d")) {
                    
                    echo "<div class='title'> ";
                    echo "<h3> " . $row['name'] . "</h3>";
                    echo "</div>";
                    echo "<div class='auction'>";
                    echo "<div class='picture'>";   
                    echo "<img src=".$row['picture']." width=\"500px\" >";
                    echo "</div>";
                    echo "<div class='auction_info'>";
                    $sql_user = "SELECT * FROM `user` WHERE `id` = '$row[s_id]'";
                    $user = $conn->query($sql_user);
                    $user_row = $user->fetch_assoc();
                    echo "<p>" . "Seller: " . $user_row['name'] . "</p>";
                    echo "<p>" . "Bid curent: " . $row['max_price'] . " RON" . "</p>";
                    echo "<p>" . "Ora de inchidere: " . $row['end_time'] . "</p>";
                    echo "<p>" . "Pret de inceput: " . $row['min_price'] . " RON" . "</p>";
                    echo "<div class='auction_description'>";
                    echo "<h3>" . "Description" . "</h3>";
                    echo "<p>" . $row['description'] . "</p>";
                    echo "<form action='./auction_bid.php' method='post'>";
                    echo "<input type=\"number\" name=\"bid\" placeholder=\"Bid-ul tau(>=" . ($row['max_price'] + $row['step']) . "): \">";
                    echo "<input type='hidden' name='id_auction' value=" . $row['id'] . ">";
                    echo "<input type=\"submit\" name=\"bid_auction\" value=\"Adauga bid\">";
                    echo "</form>";
                    echo "</div>";
                    echo "</div>";
                
                    echo "</div>";
                  
                }
            }
        }
        ?>
    </div>
</body>

</html>