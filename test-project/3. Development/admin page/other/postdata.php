<?php
    // Log in variable
    $userName = $_POST['username'];
    $userPassword = $_POST['password'];
    
    // Register variable
    $usernameReg = $_POST['usernameReg'];
    $passwordReg = SHA1($_POST[passwordReg]);
    $firstnameReg = $_POST['firsnameReg'];
    $lastnameReg = $_POST['lastnameReg'];
    $addressReg = $_POST['addressReg'];
    $emailReg = $_POST['emailReg'];
    $phoneReg = $_POST['phoneReg'];




?>