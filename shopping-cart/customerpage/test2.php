<?php
include('connect.php');
$query3 = "SELECT NOW();";
if($query3)
	print "yay<br>";
$result3 = mysqli_query($connectData, $query3);
if($result3)
	print "yay2<br>";
$row2 = mysqli_fetch_array($result3);
if($row2){
print "yay";
}else{
print "nah";
}
$dateNow = $row2['NOW()'];
print $dateNow;
?>
