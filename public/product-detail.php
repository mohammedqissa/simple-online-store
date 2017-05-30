<?php
require_once('../includes/config.php');
require_once('../includes/functions.php');
include_once('../includes/layouts/header.php');


if (!isset($_GET["id"])) {
    redirect_to("products.php");
}

global $connection;
    $query = "SELECT * ";
    $query .= "FROM products ";
    $query .= "WHERE id = {$_GET["id"]};";
    $product_detail = mysqli_query($connection, $query);
    if (!$product_detail) {
    // redirect_to("error.php");
    }
    $product = mysqli_fetch_assoc($product_detail);  
?>

<div class="container">
    <div class="row">        
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title"><?php echo $product["name"]; ?></h3>

            </div>
            <div class="panel-body">
            <br/>
                <div class="row">
                <div class="col-md-3 col-sm-offset-1">
                    <img class="thumbnail img-responsive" src="<?php echo $product["photo_dir"]."2.jpg"; ?>" alt="<?php echo $product["name"]; ?>"></div>
                    <div class="col-md-4">
                    <img class="thumbnail img-responsive" src="<?php echo $product["photo_dir"]."1.jpg"; ?>" alt="<?php echo $product["name"]; ?>"></div>
                    <div class="col-md-3">
                    <img class="thumbnail img-responsive" src="<?php echo $product["photo_dir"]."3.jpg"; ?>" alt="<?php echo $product["name"]; ?>"></div>

                </div>
                <div class="row">
                <div class="col-sm-offset-2 col-md-8 panel panel-default text-center">
                    <p class="text-center"><?php echo $product["description"]; ?></p>
                </div>
                </div>
            </div>
            <div class="panel-footer">
                In stock: <span class="badge"><?php echo $product["stock"]; ?></span>
                &nbsp;&nbsp;&nbsp;Price : <?php echo $product["price"]; ?> $
                <?php 
                    if (is_loggedin()) {
                        if (is_admin()) {
                            echo '<a class=" panel-title pull-right " href="edit_products.php?id='.$product['id'].'" >Edit this product</a>';
                        }
                        else{
                            if (!is_in_cart($product['id'])) {
                                echo '<a class=" panel-title pull-right " href="cart.php?product_id='.$product['id'].'&product_name='.$product['name'].'&product_price='.$product['price'].'&method=addToCart" >Add To Cart</a>';
                            }
                            else{
                                echo '<a class=" panel-title pull-right " href="cart.php?product_id='.$product['id'].'&product_name='.$product['name'].'&method=removeFromCart" >Remove From Cart</a>';
                            }
                        }
                    }
                        else{
                            if (!is_in_cart($product['id'])) {
                                echo '<a class=" panel-title pull-right " href="cart.php?product_id='.$product['id'].'&product_name='.$product['name'].'&product_price='.$product['price'].'&method=addToCart" >Add To Cart</a>';
                            }
                            else{
                                echo '<a class=" panel-title pull-right " href="cart.php?product_id='.$product['id'].'&product_name='.$product['name'].'&method=removeFromCart" >Remove From Cart</a>';
                            }
                        }
                    

                ?>
            </div>
        </div>       
    </div>
</div>

<?php
mysqli_free_result($product_detail);
include_once('../includes/layouts/footer.php');
?>