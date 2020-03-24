<?php
    //database script
    include('database.php');
    //
    include('postdata.php');

    //querying
    $selectUser = 'SELECT * FROM CUSTOMER WHERE username = ' . '"'. $userName . '"' . ';';


    //$regUser = 'INSERT INTO user(user_name, password) VALUES (' . '"' . $regUserName . '"' .  ', "' . $regUserPassword . '"' .  ');';
    //$regResult = mysqli_query($connectData, $regUser);
    $result = mysqli_query($connectData, $selectUser);
    $row = mysqli_fetch_array($result);
    
    /*if($regUser){
        print "Register Success!";
    }else{
        print "Invalid!!!";
    }*/
    
    /*print SHA1($row["password"]);
    //print $regUser;
    if (SHA1($userPassword) == $row["password"]){
        print "<h2>yEhey!!!!!!!";
    }
    if(($userName == $row["username"]) && (SHA1($userPassword) == $row["password"])){
        print "<br>yehey2";
    }*/

    if(($userName == $row["username"]) && (SHA1($userPassword) == $row["password"])){
        print "<br><br><h1>Log in Successful";
    }else{
        print "<br>Username or password are incorrect! Please try again!<br></h1>";
    }
    
 
    mysqli_close($connectData);

?>