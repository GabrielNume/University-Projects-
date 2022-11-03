<?php
/**
 * 1 Verificam butonu
 * 2 Facem logout la user
 */


// AICI APELEZ SESSION START CA SA POT SA STERG DATELE SALVATE 
// DATELE AU FOST SALVATE CAND AM FACUT LOGIN 
session_start();

// 1. VERIFIC BUTONU
if ($_POST["submit"]) {

    // 2. FAC LOGOUT
    // CA SA FAC LOGOUT TREBE DOAR SA DISTRUG SESIUNEA CURENTA
    session_destroy();
    header("Location: ./index.php");
    exit();
}