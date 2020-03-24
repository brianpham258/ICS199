<?php

    //This will change depends on what database we'll using
    //database variable authentication
    $usernameDB = 'rolando';
    $serverDB = 'localhost';
    $passwordDB = 'ujmqaz@1211';
    $database = 'testdata'; 

    //initialize connection in database
    $connectData = mysqli_connect($serverDB, $usernameDB, $passwordDB, $database);

    if($connectData){
        echo "Connection to MySql is success";
    }else{
        echo "Connection failed!";
    }

    


?>