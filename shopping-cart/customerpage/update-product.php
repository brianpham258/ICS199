<div class="foodHeader">
    <div class="foodContent">
        <?php
            include('connect.php');
			 
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                $order_id = $_POST['order_id'];
                $product_id = $_POST['product_id'];
                $quantity = $_POST['quantity'];

                $query = "UPDATE SOLD_PRODUCT SET QUANTITY = '$quantity' 
                            WHERE ORDER_ID = '$order_id' AND PRODUCT_ID = '$product_id'";
                $result = mysqli_query($connectData, $query);
            }
            include('cart.php');
        ?>
    </div> 
</div>