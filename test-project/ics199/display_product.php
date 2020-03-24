
<?php
    include('header.html');
?>

<!--SEARCHING-->
<div class="search-category">
    <form method="GET" action="display_product.php">
        <select name="category">
            <option value="01">Chicken</option>
            <option value="02">Dessert</option>
            <option value="03">Fries</option>
            <option value="04">Hamburger</option>
            <option value="05">Noodle</option>
            <option value="07">Pizza</option>
            <option value="08">Rice</option>
            <option value="09">Seafood</option>
            <option value="06">Others</option>
        </select>
        <input type="submit" value="Search" id="myButton">
    </form>
</div>

<?php
    //For now 
        $path = "../adminpage/" .rest_pic_file;
    include("connect.php");  // connection string is $dbc
    $food_category = $_GET["category"];
    // run query
	$query = "SELECT r.rest_name, r.rest_pic_file, p.product_name, p.product_price, p.product_pic_path 
				FROM PRODUCT p, RESTAURANT r
				WHERE r.rest_id = p.rest_id
				AND product_category = '$food_category';";
    $result = mysqli_query($connectData, $query);
    // start table build
    echo "<table id='display' class='table'>";
        echo "<tr>";
            echo    "<th>Restaurant Name</th>";
            echo    "<th>Restaurant Logo</th>";
            echo    "<th>Product</th>";
            echo    "<th>Product Name</th>";
            echo    "<th>Product price</th>";
        echo "</tr>";

        while($row=mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            // display each row 
            echo "<tr>";
            echo "<td>".$row['rest_name']."</td>"; 
            echo "<td>"."<img src='../adminpage/".$row['rest_pic_file']."'  style='width:200px;height:200px;'></td>"; 
            echo "<td>"."<img src='../adminpage/".$row['product_pic_path']."'  style='width:200px;height:200px;'></td>"; 
            echo "<td>".$row['product_name']."</td>"; 
            echo "<td>".$row['product_price']."</td>";
            echo "</tr>";
        }
    echo "</table>";
    mysqli_close($dbc);
?>  

    </body>
    <footer></footer>
</html>