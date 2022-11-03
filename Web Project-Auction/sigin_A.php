<?php
if (isset($_POST["submit_log"])) {
    header("Location: ./login.php");

    exit();
}

if (isset($_POST["submit"])) {
    $errors = [];
    if (!isset($_POST["nume"]) || $_POST["nume"] == "")
        $errors["name"] = "Numele ESTE OBLIGATORIU";
    if (!isset($_POST["email"]) || $_POST["email"] == "")
        $errors["email"] = "Email ESTE OBLIGATORIU";
    if (!isset($_POST["parola"]) || $_POST["parola"] == "")
        $errors["password"] = "Parola ESTE OBLIGATORIU";
    if (count($errors) != 0) {
        header("Location: ./sigin.php?" . http_build_query($errors));
        exit;
    }

    $server_name = "localhost";
    $user = "root";
    $pass = "";
    $db = "proiect";
    $conn = new mysqli($server_name, $user, $pass, $db);
    if ($conn->connect_errno) {
        $errors["error"] = "Sorry, we could not process your request at this time. Please try again later.";
        header("Location: ./sigin.php?" . http_build_query($errors));
        exit;
    }

    $data = [
        "name" => htmlspecialchars($_POST["nume"]),
        "email" => htmlspecialchars($_POST["email"]),
        "password" => htmlspecialchars(hash("sha256", $_POST["parola"]))

    ];

    $sql = "INSERT INTO user(`name`,`email`,`password`,`role_id`)
        VALUES('$data[name]','$data[email]','$data[password]',0)";

    $user_check_query = "SELECT * FROM user WHERE  email='$_POST[email]' LIMIT 1";
    $result = mysqli_query($conn, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) { // if user exists

        if ($user['$_POST[email]'] === $email) {
            $errors["exista"] = "This email was used for registration. Use another email.";
            header("Location: ./sigin.php?" . http_build_query($errors));
            exit;
        }
    } else {

        $conn->query($sql);
        if ($conn->errno) {
            $errors["error"] = "Sorry, we could not process your request at this time. Please try again later.";
            header("Location: ./sigin.php?" . http_build_query($errors));
            exit;
        }

        $errors["success"] = "Te-ai inregistrat";
        header("Location: ./sigin.php?" . http_build_query($errors));
        exit;
    }
}
header("Location: ./sigin.php");
exit;
