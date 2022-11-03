<?php

if(isset($_POST['submit'])){
    require_once './login_delegator.php';
    $loginDelegator = new LoginDelegator(new Validator);
    $loginDelegator->logout();
    header('location: ./index.php');
    exit();
}