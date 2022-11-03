<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='./css/style_menu.css'>
    <script src="https://kit.fontawesome.com/76bd7cf633.js" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    
<?php
require_once './menu.php';
build_menu();
echo "<div class='content'>";
// loop trough all the users and make a button for deleting them
require_once './database_connector.php';
require_once './basic_cruds.php';
$conn = DatabaseConnector::getInstance()->getConnection();
$sql = "SELECT * FROM `user`";
if(!$result = $conn->query($sql))
    throwError("1Oops! Something went wrong. Please try again later.",502);

if(isset($_SESSION['id'])&&$_SESSION['logged_in']==1&&$_SESSION['is_admin']==1){
while($row = $result->fetch_assoc()){
    echo '<form action="admin_actions.php" method="post">';
    echo '<input type="hidden" name="ID" value="'.$row['ID'].'">';
    echo 'ID: '.$row['ID'];
    echo '<input type="text" name="Nume" value="'.$row['Nume'].'">';
    echo '<input type="text" name="Email" value="'.$row['Email'].'">';
    echo '<input type="submit" name="edit_user" value="Edit User">';
    echo '<input type="submit" name="delete_user" value="Delete User">';
    echo '</form>';
    
}
echo "<form action=\"./admin_actions.php\" method=\"post\">
    <h2>Add User</h2>
    <label>User Name</label>
    <input type=\"text\" name=\"Username\" placeholder=\"User Name\"><br>
    <label>Email</label>
    <input type=\"text\" name=\"Email\" placeholder=\"Email\"><br>
    <label>Password</label>
    <input type=\"password\" name=\"password\" placeholder=\"Password\"><br>
    <button type=\"submit\" name=\"add_user\">Add</button>
</form>";
}
else
    echo "You are not logged in or you are not an admin";
echo '</div>';
?>
</body>
</html>