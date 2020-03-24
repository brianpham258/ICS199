<?php
    //database script
    include('database.php');
    //
    include('postdata.php');

    //querying
    $selectUser = 'SELECT * FROM user WHERE user_name = ' . '"'. $userName . '"' . ';';


    //$regUser = 'INSERT INTO user(user_name, password) VALUES (' . '"' . $regUserName . '"' .  ', "' . $regUserPassword . '"' .  ');';
    //$regResult = mysqli_query($connectData, $regUser);
    $result = mysqli_query($connectData, $selectUser);
    $row = mysqli_fetch_array($result);
    
    /*if($regUser){
        print "Register Success!";
    }else{
        print "Invalid!!!";
    }*/
    
    
    //print $regUser;
    
    if(($userName == $row["user_name"]) && ($userPassword == $row["password"])){
        print "<br><br><h1>Log in Successful</h1>";
    }else{
        print "<br>Username or password are incorrect! Please try again!<br>";
    }
    //print_r($row);
    print $row["user_name"];
    print $row["password"];
    print $selectUser;
    mysqli_close($connectData);

?>