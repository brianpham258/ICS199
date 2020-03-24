<div class="foodHeader">
    <div class="foodContent">
        <?php
            include('connect.php');
			 
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                $order_id = $_POST['order_id'];
                $product_id = $_POST['product_id'];
                $count = $_POST['count'];
                $query1 = "DELETE FROM SOLD_PRODUCT WHERE ORDER_ID = '$order_id' AND PRODUCT_ID = '$product_id';";
                $query2 = "DELETE FROM ORDERINFO WHERE ORDER_ID = '$order_id'";
                if($count > 1) {
                    $result1 = mysqli_query($connectData, $query1);
                }
                else if($count == 1) {
                    $result2 = mysqli_query($connectData, $query1);
                    $result3 = mysqli_query($connectData, $query2);
                }
            }
            include('cart.php');
        ?>
    </div> 
</div>