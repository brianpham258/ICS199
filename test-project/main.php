<?php
include('database.php');

echo "<br>";
//testing
$userName = $_POST['username'];
$userPassword = $_POST['password'];
//querying
$selectUser = 'SELECT * FROM user WHERE user_name = ' . '"'. $userName . '"' . ';';
$result = mysqli_query($connectData, $selectUser);
$row = mysqli_fetch_array($result);



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
