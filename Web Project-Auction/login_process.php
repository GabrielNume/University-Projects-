<?php session_start();
require_once './database_connector.php';
$con = DatabaseConnector::getInstance()->getConnection();
if (isset($_POST["submit_sig"])) {
	header("Location: ./sigin.php");
	exit();
}

if (isset($_POST['login'])) { //$_SESSION['auction_id']="";

	$user_unsafe = $_POST['username'];
	$password = hash("sha256", $_POST['password']);

	$user = mysqli_real_escape_string($con, $user_unsafe);
	$pass = mysqli_real_escape_string($con, $pass_unsafe);

	$query = mysqli_query($con, "select * from user where email='$user' and password='$password'") or die(mysqli_error($con));
	$row = mysqli_fetch_array($query);

	$name = $row['username'];
	$counter = mysqli_num_rows($query);
	$id = $row['id'];
	$role_id = $row['role_id'];
	$errors=[];
	if ($role_id == 1) {

		$_SESSION['is_admin'] = true;
		header("Location: ./home.php?" . http_build_query($errors));
		// exit;
		// echo "<script type='text/javascript'>document.location='home.php'</script>";

	}

	if ($counter == 0) {
		
		$errors["da"]="Invalid Username or Password!";
		$_SESSION['is_admin'] = true;
		header("Location: ./login.php?" . http_build_query($errors));
		// exit;
		// echo "<script type='text/javascript'>alert('Invalid Username or Password!');
		//  document.location='login.php'</script>";
	} else {
		$_SESSION['id'] = $id;
		$_SESSION['username'] = $name;
		$_SESSION["logged_in"] = true;
		header("Location: ./home.php?" . http_build_query($errors));
		// exit;
		// echo "<script type='text/javascript'>document.location='home.php'</script>";
	}
}
