<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./app.css" />
   
    <title>Admin</title>
</head>
<body>
<?php session_start();
if(empty($_SESSION['id'])):
header('Location:./login.php');
endif;?>

<?php
if($_SESSION['is_admin']==0):
header('Location:./home.php');
endif;?>

<?php
require_once './header.php';


// loop trough all the users and make a button for deleting them
require_once './database_connector.php';
require_once './basic_cruds.php';
$conn = DatabaseConnector::getInstance()->getConnection();
$sql = "SELECT * FROM `user`";
if(!$result = $conn->query($sql))
    throwError("1Oops! Something went wrong. Please try again later.",502);
    echo'<br><br><br>';
    echo'<pre>              name                 email                  role:admin/user</pre>';
  //  if($_SESSION['logged_in']==1&&$_SESSION['is_admin']==1){
while($row = $result->fetch_assoc()){
    echo '<form action="admin_actions.php" method="post">';
    echo '<input type="hidden" name="id" value="'.$row['id'].'">';
    echo 'id: '.$row['id'];
    echo '<input type="text" name="name" value="'.$row['name'].'">';
    echo '<input type="text" name="email" value="'.$row['email'].'">';
    echo '<input type="text" name="role_id" value="'.$row['role_id'].'">';
    echo '<input type="submit" name="edit_user" value="Edit User">';
    echo '<input type="submit" name="delete_user" value="Delete User">';
    echo '</form>';
    
}
echo "<form action=\"./admin_actions.php\" method=\"post\">
    <h2>Add User</h2>
    <label>User Name</label>
    <input type=\"text\" name=\"name\" placeholder=\"User Name\"><br>
    <label>Email</label>
    <input type=\"text\" name=\"email\" placeholder=\"email\"><br>
    <label>Password</label>
    <input type=\"password\" name=\"password\" placeholder=\"password\"><br>
    <button type=\"submit\" name=\"add_user\">Add</button>
</form>";
//}

?>
</body>
</html>