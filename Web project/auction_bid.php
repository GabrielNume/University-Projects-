

<?php
session_start();
function throwError($message,$code){
    throw new Exception($message,$code);
}
if(isset($_SESSION['id'])&&$_SESSION['logged_in']==1){
if(isset($_POST['bid_auction'])){
    require_once './database_connector.php';
    if(isset($_POST['bid'])){
        $conn = DatabaseConnector::getInstance()->getConnection();
         $sql = "UPDATE `auction` SET `Max_Price` = '$_POST[bid]',`B_ID` = '$_SESSION[id]' WHERE `ID` = '$_POST[id_auction]' AND `S_ID` != '$_SESSION[id]'";
         if(!$conn->query($sql))
             throwError("4Oops! Something went wrong. Please try again later.",502);
            }
            header('location: ./display_auction.php?auction_id='.$_POST['id_auction']);
}
}
else
header('location: ./login.php');
?>