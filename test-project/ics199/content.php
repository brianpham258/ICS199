<div class="foodHeader">
    <div class="foodContent">
        <?php
            include("connect.php");

            $query = "SELECT r.rest_name, r.rest_pic_file, p.product_name, p.product_price, p.product_pic_path 
                FROM PRODUCT p, RESTAURANT r
                WHERE r.rest_id = p.rest_id;";
            
            $result = mysqli_query($connectData, $query);

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
                    echo "<td>CAD ".$row['product_price']."</td>";
                    echo "</tr>";
                }
            echo "</table>";
        ?>
    </div>
</div>