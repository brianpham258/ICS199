<?php
include('header.html');
?>

<!-- HEADER -->
<div id="header">
    <h1>Product</h1>
    <br>
    <h4>Scroll down to find all...the food we have</h4>
</div>

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
        <div id="product">
            <!--Display Products Category-->
            <?php
                include('content.php');
            ?>
        </div>
    </body>
    <footer></footer>
</html>