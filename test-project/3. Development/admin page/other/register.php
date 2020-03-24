<?php
    //database script
    include('database.php');
    // Post data
    include('postdata.php');

    //$regUser = 'INSERT INTO user(username, password, first_name, last_name, address, email, phone) VALUES ('. '"' . $usernameReg . '"' .  ', "' . $passwordReg . ', "' . $firstnameReg . '"' .  ', "' . $lastnameReg . '"'  .  ', "' . $addressReg . '"' .  ', "' . $emailReg . '"' .  ', "' . $phoneReg . '"' . ');';
    $regUser = 'INSERT INTO CUSTOMER(username, password, first_name, last_name, address, email, phone, user_authority) VALUES ("'. $usernameReg . '", "' . $passwordReg . $firstnameReg . '", "'. $lastnameReg . '", "' . $addressReg . '", "' . $emailReg . '", "' . $phoneReg . '", "03");';


    $regResult = mysqli_query($connectData, $regUser);

    if($regResult){
        print "Success!";
    }else{
        print "Registration failed please try again!";
    }
    echo "<br";

    echo '<a href="../index.html">Go Back</a>';
    echo "<br>";

    echo $regUser;

    mysqli_close($connectData);

?>
<a href="../index.html">Go Back</a>