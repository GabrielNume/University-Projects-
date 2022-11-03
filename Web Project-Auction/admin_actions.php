<?php
require_once './database_connector.php';
require_once './basic_cruds.php';
$conn = DatabaseConnector::getInstance()->getConnection();
if (isset($_POST['edit_user'])) {
    update_user($conn, $_POST);
    header('location: ./admin.php');
}
if (isset($_POST['delete_user'])) {
    delete_user($conn, $_POST);
    header('location: ./admin.php');
}
if (isset($_POST['add_user'])) {
    add_user($conn, $_POST);
    header('location: ./admin.php');
}
// if (isset($_POST['edit_self'])) {
//     update_user_with_pass($conn, $_POST);
//     header('location: ./profile.php');
// }
