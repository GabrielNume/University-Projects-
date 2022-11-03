<?php
require_once './product.php';
require_once './database_connector.php';

function throwError($message,$code){
    throw new Exception($message,$code);
}

if(isset($_POST['auction'])){
    header('location: ./product.php');
    exit();
}

$picture_link = './images/';
if(isset($_SESSION['id'])&&$_SESSION['logged_in']==1){
if(isset($_POST['submit_auction'])){
    $name=$_FILES['picture']['name'];
    $picture=$picture_link.$name;
    $conn = DatabaseConnector::getInstance()->getConnection();
    $sql = "INSERT INTO `auction`(`S_ID`,`Name`, `Description`, `Picture`, `Min_Price`,`Max_Price`, `Step`, `End_Time`) VALUES  (?,?,?,?,?,?,?,?)";
    if(! ($stmt = $conn->prepare($sql)))
    throwError("1Oops! Something went wrong. Please try again later.",502);
    echo "sdajdigyaiudl".$_SESSION['id'];
    if(!move_uploaded_file($_FILES['picture']['tmp_name'],$picture))
        throwError("3Oops! Something went wrong. Please try again later.",502);
    $picture=".".$picture;   
    $stmt->bind_param("isssiiss",$_SESSION['id'],$_POST['title'],$_POST['description'],   $picture,$_POST['price'],$_POST['price'],$_POST['step'],$_POST['end_time']);
    if(!$stmt->execute())
    throwError("2Oops! Something went wrong. Please try again later.",502);
    $stmt->close();
    header('location: ./index.php');
    }}
    else
    header('location: ./login.php');

