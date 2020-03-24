<?php

    //This will change depends on what database we'll using
    //database variable authentication
    $usernameDB = 'ICS199Group06_dev';
    $serverDB = 'localhost';
    $passwordDB = 'camosun@canada';
    $database = 'ICS199Group06_dev'; 

    //initialize connection in database
    $connectData = mysqli_connect($serverDB, $usernameDB, $passwordDB, $database);

    /*if($connectData){
        echo "Connection to MySql is success";
    }else{
        echo "Connection failed!";
    }*/

    


?>