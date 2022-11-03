<?php 
// require_once("./conn.php");

function add_user($conn, array $data){
    $sql= "INSERT INTO user(`Nume`,`Email`,`Password`,`Role_ID`)
        VALUES('$data[Username]','$data[Email]', '$data[password]','0')";
    $conn->query($sql);
        if ($conn->errno) {
            var_dump($conn);
            die;
    }
}

function update_user($conn, $data){
    $sql ="UPDATE user SET `Nume` = '$data[Nume]', 
                `Email` =  '$data[Email]'
                WHERE `ID`= '$data[ID]'";
    $conn->query($sql);
}
function update_user_with_pass($conn, $data){
    $encpass=hash("sha256",$data['Password']);
    $sql ="UPDATE user SET Nume = ?, Email = ?, Password = ? WHERE ID = ?";
                // `Email` =  '$data[Email]',
                // `Password` =  '$encpass'
                // WHERE `ID`= '$data[ID]'";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param('sssi',$data['Nume'],$data['Email'],$encpass,$data['ID']);
    $stmt->execute();
    $stmt->close();
}


function delete_user($conn, $data){
    $sql = "DELETE FROM user
            WHERE `ID` = '$data[ID]'";
    $conn->query($sql);
}

function get_all_users($conn){
    $sql = "SELECT * FROM users";
    return $conn->query($sql);
}


function get_user_by_email($conn, $email){
    $sql = "SELECT * FROM users WHERE `email` = '$email'";
    return $conn->query($sql);
}