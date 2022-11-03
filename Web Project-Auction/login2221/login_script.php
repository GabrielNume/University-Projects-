<?php
/**
 * session_start();
 * imi da access la vector $_SESSION (POT CITI SI SCRIE IN VECOTRU $_SESSION)
 * DACA NU APELEZ session_start CAND INCERC SA CITESC DIN VECTOR $_SESSION O SA PRIMESC NULL
 * SI CAND INCERC SA SCRIU VALOAREA NU VA FI SALVATA
 */
session_start(); 
/**
 * 1 verificam daca sa apasat butonu de login
 * 2 validam datele introduse
 * 3 cautam in baza de date utilizatoru dupa email
 * 4 verificam parolele
 * 5 autentificam useru
 */

 // 1 VERIFICAM DACA SA APASAT BUTONU 
 if(isset($_POST["submit"])){

    // NE FACEM UN VECTOR DE DATE SI UN VECTOR DE REGULI PENTRU VALIDAREA DATELOR
    $data = [
        "email" =>$_POST['email'],
        "password"=> $_POST['password'],
    ];
    $rules = [
        "email" => [
            "required",
            "email"
        ],
        "password" => [
            "required",
            "min_len" => 6,
            "max_len" => 20,
            // "contains_special_symbol"
        ],
    ];


    // 2. VALIDAM DATELE INTRODUSE
    require_once("./validator.php");
    $validator = new Validator;
    $validator->validate($data,$rules);

    // DACA AVEM ERORI NE INTOARCE CU ELE INAPOI
    if ($validator->hasErrors()) {
        header("Location: index.php?".http_build_query($validator->getErrors()));
        exit();
    }


    // DACA NU AVEM ERORI INCERCAM SA NE CONECTAM LA BAZA DE DATE
    require_once("./databse_singleton_connector.php");
    $conn = DatabaseConnector::getInstance()->getConnection();
    
    // 3.cautam in baza de date utilizatoru dupa email
    $sql= "SELECT * FROM users WHERE `email`= '$data[email]'";
    $db_Data= $conn->query($sql); // asta executa query

    // DACA AVEM 0 LINI SAU MAI MULT DE 1 INSEAMNA CA CEVA NU E BINE 
    // PENTRU CA NU PUTEM SA AVEM 2 USERI CU ACELASI EMAIL
    // DECI INTOARCEM O EROARE 
    if (mysqli_num_rows($db_Data) != 1) {
        $errors = ["error" => "Invalid username or password"];
        header("Location: ./index.php?".http_build_query($errors));
        exit();
    }

    // DACA NU AVEM ERORI, IAU DETELE USERULUI SI LE PUN IN VARIABILA $USER_DATA
    $user_data = null;
    while ($row = $db_Data->fetch_assoc()) {
        $user_data = $row;
    }

    // 4.VERIFICAM PAROLELE
    if (hash("sha256", $data['password']) != $user_data['password']) {
        $errors = [
            "error" => "INvalid username or password"
        ];
        header("Location: ./index.php?".http_build_query($errors));
        exit();
    }

    // 5. AUTENTIFICAM USERUL
    // DACA PAROLELE CORESPUND SE VA AJUNGE AICI SI SE VA AUTENTIFICA USERUL
    $_SESSION["is_logged_in"] = true;
    $_SESSION["username"] = $user_data["name"];
    $_SESSION["email"] = $user_data["email"];
    $_SESSION["is_admin"] = $user_data["role_id"] == 1;
    header("Location: ./dashboard.php");
    exit();
 }
 else{
    //  DACA NU SA APASAT BUTONUL MERGEM PE PAGINA 404
    header("Location: 404.php");
    exit();
 }
 
 
 
 
 
//  if(array_key_exists("submit", $_POST)){}