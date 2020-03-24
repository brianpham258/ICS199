
<?php
include('connect.php');
$query2 = "SELECT NOW()";
// Order status need to be deliver by the end so we can change it to 03 to avoid duplication
$result2 = mysqli_query($connectData, $query2);
$row = mysqli_fetch_array($result2);
print $row['NOW()'];
$filename = fopen("reciept/test.txt", "w") or die ("unable to create file");
while($row = mysqli_fetch_array($result2)){
		//$text = file_get_contents($file);
               $text = $row['order_id']."-". $row['product_name']."- pcs: ".$row['quantity']."-price: " . $row['product_price']."\n";
		//echo $text;
                //$text = "asd"
		fwrite($filename, $text);
}

fclose($filename);

?>

