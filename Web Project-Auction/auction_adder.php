<?php


if (isset($_POST["submit_auction"])) {

    $errors = [];
    if (
        !isset($_POST["title"]) || $_POST["title"] == "" || !isset($_POST["description"]) || $_POST["description"] == ""
        || !isset($_POST["price"]) || $_POST["price"] == ""  || !isset($_POST["end_time"])  || $_POST["end_time"] == ""
        || !isset($_POST["step"]) || $_POST["step"] == ""
    )
        $errors["ceva"] = "Toate campurile trebe completate";


    if (count($errors) != 0) {
        header("Location: ./produs.php?" . http_build_query($errors));
        exit;
    }
}

require_once './produs.php';
require_once './database_connector.php';


if (isset($_POST['auction'])) {
    header('location: ./produs.php');
    exit();
}


$picture_link = './images/';
if (isset($_SESSION['id']) && $_SESSION['logged_in'] == 1) {
    if (isset($_POST['submit_auction'])) {
        $name = $_FILES['picture']['name'];
        $picture = $picture_link . $name;
        $conn = DatabaseConnector::getInstance()->getConnection();
        $sql = "INSERT INTO `auction`(`s_id`,`name`, `description`, `picture`, `min_price`,`max_price`, `step`, `end_time`) VALUES  (?,?,?,?,?,?,?,?)";
        if (!($stmt = $conn->prepare($sql)))
            throwError("1Oops! Something went wrong. Please try again later.", 502);

        if (!move_uploaded_file($_FILES['picture']['tmp_name'], $picture))
            throwError("3Oops! Something went wrong. Please try again later.", 502);

        $stmt->bind_param("isssiiss", $_SESSION['id'], $_POST['title'], $_POST['description'],   $picture, $_POST['price'], $_POST['price'], $_POST['step'], $_POST['end_time']);
        if (!$stmt->execute())
            throwError("2Oops! Something went wrong. Please try again later.", 502);
        $stmt->close();
        header('location: ./home.php');
    }
} else
    header('location: ./login.php');
