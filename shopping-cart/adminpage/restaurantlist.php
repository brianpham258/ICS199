<?php
Error_reporting(E_ALL);
ini_set('display_errors',1);
    include('header.html');
	
	include("connect.php");  // connection string is $dbc
	// run query
	$query = "  SELECT REST_ID, REST_NAME, REST_PIC_FILE, REST_ADD, REST_DESC, 
  CONCAT(SUBSTR(REST_PHONE,1,1),'-(',SUBSTR(REST_PHONE,2,3),')',SUBSTR(REST_PHONE,4,3),'-',SUBSTR(REST_PHONE,8,4)) REST_PHONE 
  FROM RESTAURANT;";
	
	$rows = mysqli_query($connectData, $query);
	
	// start table build
	echo "<table style='border: 1px solid black'>";
	echo "<tr><th style='border: 1px solid black'>RESTAURANT</th>
		  <th style='border: 1px solid black'>LoGo</th>
		  <th style='border: 1px solid black'>Address</th>
		  <th style='border: 1px solid black'>Restaurant Description</th>
		  <th style='border: 1px solid black'>REST_PHONE</th></tr>
		<th style='border: 1px solid black'>Modify</th></tr>";
 
	while($row=mysqli_fetch_array($rows, MYSQLI_ASSOC)) { 
		// display each row 
		echo "<tr>";
		echo "<td style='border: 1px solid black'>".$row['REST_NAME']."</td>";
		echo "<td style='border: 1px solid black'>"."<img src='".$row['REST_PIC_FILE']."'  style='width:100;height:100;'></td>"; 
		echo "<td style='border: 1px solid black'>".$row['REST_ADD']."</td>";
		echo "<td style='border: 1px solid black'>".$row['REST_DESC']."</td>"; 
		echo "<td style='border: 1px solid black'>".$row['REST_PHONE']."</td>";
		echo '<td style="border: 1px solid black"><form action="addmenu.php" method="GET"><input type="hidden" name="restaurant_id" value="'.$row['REST_ID'].'" /><input type="submit" class="btn btn-dark" value="Add Product"></form></td>';
		echo "</tr>";
	}
	echo "</table>";
	//mysqli_close($connectData);
?>

<?php 
include('footer.html');
?>
 
