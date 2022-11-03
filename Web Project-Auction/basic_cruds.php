<?php
// require_once("./conn.php");

function add_user($conn, array $data)
{$da=hash("sha256",$data['password']);
    $sql = "INSERT INTO user(`name`,`email`,`password`,`role_id`)
        VALUES('$data[name]','$data[email]', '$da','0')";
    $conn->query($sql);
    if ($conn->errno) {
        var_dump($conn);
        die;
    }
}

function update_user($conn, $data)
{
    $sql = "UPDATE user SET `name` = '$data[name]', 
                `email` =  '$data[email]',
                `role_id` =  '$data[role_id]'
                WHERE `id`= '$data[id]'";
    $conn->query($sql);
}


function delete_user($conn, $data)
{
    $sql = "DELETE FROM user
            WHERE `id` = '$data[id]'";
    $conn->query($sql);
}

function get_all_users($conn)
{
    $sql = "SELECT * FROM users";
    return $conn->query($sql);
}


