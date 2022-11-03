

<?php
session_start();
function throwError($message, $code)
{
    throw new Exception($message, $code);
}
if (isset($_SESSION['id']) && $_SESSION['logged_in'] == 1) {
    if (isset($_POST['bid_auction'])) {
        require_once './database_connector.php';
        if (isset($_POST['bid'])) {
            $sql2 = "SELECT * FROM auction  WHERE `id` = '$_POST[id_auction]'";
            $conn = DatabaseConnector::getInstance()->getConnection();
            $data = $conn->query($sql2);
            $row = $data->fetch_assoc();
            $b_u = $_SESSION['id'];
            $u = $row['b_id'];
            $errors = [];
            if ($_POST['bid'] >= $row['max_price'] + $row['step']) {
                $sql = "UPDATE `auction` SET `max_price` = '$_POST[bid]',`b_id` = '$_SESSION[id]' WHERE `id` = '$_POST[id_auction]' AND`b_id` != '$_SESSION[id]' ";
                if ($b_u == $u)
                    $errors["a"] = "Nu pueti licita peste dumneavoastra!";
                if (count($errors) != 0) {
                    header("Location: ./display_auction.php?auction_id=" . $_POST['id_auction'] . http_build_query($errors));
                    exit;
                }
                if (!$conn->query($sql))
                    throwError("4Oops! Something went wrong. Please try again later.", 502);
            }
            if ($_POST['bid'] < $row['max_price'] + $row['step'] & $_POST['bid'] >= 0) {
                $errors["c"] = "Ati licitat sub minim. Licitati mai mult!";
                // header('location: ./display_auction.php?auction_id='.$_POST['id_auction']);
                header("Location: ./display_auction.php?auction_id=" . $_POST['id_auction'] . http_build_query($errors));
                exit;
            }
            if ($_POST['bid'] == "") {
                $errors["c"] = "Nu ati introdus nicio suma de bani!";
                // header('location: ./display_auction.php?auction_id='.$_POST['id_auction']);
                header("Location: ./display_auction.php?auction_id=" . $_POST['id_auction'] . http_build_query($errors));
                exit;
            }
            $errors["c"] = "Tranzactie acceptata! Dumneavoasta ati licitat cel mai mult !";
            // header('location: ./display_auction.php?auction_id='.$_POST['id_auction']);
            header("Location: ./display_auction.php?auction_id=" . $_POST['id_auction'] . http_build_query($errors));
            exit;
        }
    }
} else
    header('location: ./login.php');
?>