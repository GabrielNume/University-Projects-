<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="./app.css" />
    <link rel="stylesheet" href="./style_mainpage.css">
</head>

<body>
    <?php
    session_start();

    require_once "./header.php"
    ?>
    <div class="content">
        <?php
        require_once './database_connector.php';
        $conn = DatabaseConnector::getInstance()->getConnection();
        $sql = "SELECT * FROM `auction`";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                if ($row['status'] == 0 && $row['end_time'] > date("Y-m-d")) {
                    echo "<a class=\"nohover\" href=\"display_auction.php?auction_id=" . $row['id'] . "\">";
                    // echo "<a class=\"nohover\" href=\"display_auction.php\">";
                    //  $_SESSION['auction_id']=$row['id'];
                    echo "<div class='auction'>";
                    echo "<img src=" . $row['picture'] . " alt=\"Imagine licitatie\">";
                    echo "<h3>Is bidding:  " . $row['name'] . "</h3>";
                    echo "<p>" . "Bid curent: " . $row['max_price'] . " RON" . "</p>";
                    echo "<form action='./functions.php' method='post'>";
                    echo "<input type='hidden' name='auction_id' value=" . $row['id'] . ">";
                    echo "</form>";
                    echo "</div>";
                    echo "</a>";
                }
            }
        }
        ?>
    </div>
    <?php
    require_once "./footer.php"
    ?>

</body>

</html>