<?php   
require_once('../includes/config.php'); 
require_once('../includes/functions.php'); 
require_once('../includes/validation_functions.php'); 
include('../includes/layouts/header.php');


    if (is_loggedin()) {
        if (is_admin()) {
        }else
        redirect_to('index.php');
    }else
        redirect_to('index.php');

$query  = "SELECT * ";
$query .= "FROM products";
$result = mysqli_query($connection, $query);
if(!$result) {
        echo "error";
}
if(isset($_POST["submit"])) {


}
?>

<div class="col-md-10">
<?php 
if(isset($_GET["id"])) {

$query  = "SELECT * ";
$query .= "FROM products where id = '".$_GET["id"]."'";
$result = mysqli_query($connection, $query);
$product = mysqli_fetch_assoc($result); 
?>
    <form class="col-md-4 col-md-offset-4" action="edit_products.php" enctype="multipart/form-data" method="post" >
        
        <h2> Add new product </h2>
        <div class="form-group">
            <label>Product name</label>
            <input type="text" class="form-control" name="product_name" id=""  placeholder="Enter product name" value="<?php echo htmlspecialchars($product["name"]); ?>">
        </div>
        <div class="form-group">
            <label>Product price</label>
            <input type="number" class="form-control" name="price" id=""  placeholder="Enter product price" value="<?php echo htmlspecialchars($product["price"]); ?>">
        </div>
        <div class="form-group">
            <label>Add description</label>
            <textarea class="form-control" id="" name="description" rows="3" placeholder="Add description here" value=""><?php echo htmlspecialchars($product["description"]); ?></textarea>
        </div>
        <div class="form-group">
            <label>Stock</label>
            <input type="number" class="form-control" id="" name="stock" value="<?php echo htmlspecialchars($product["stock"]); ?>"></input>
        </div>
        <div class="form-group">
            <label>Is item available/visible? </label>
        <input type="radio" name="visible" <?php if($product["visible"] == 1) echo "checked"; ?> > Available 
            <input type="radio" name="visible" <?php if($product["visible"] == 0) echo "checked"; ?> > Not available 
        </div>
       
        <div class="form-group row">
            <div class="offset-sm-2 col-sm-10">
            <button type="submit" class="btn btn-primary" name="submit">Edit Product</button>
             <a href="edit_products.php">Cancel</a>
            </div>
            </div>
        </form>
<?php
    }           
 else {
        echo "<h3>Choose product to edit </h3>";
        while($row_name = mysqli_fetch_assoc($result)) {       
        $output  = "<ul>";
        $output .= "<li><a href=\"edit_products.php?id={$row_name["id"]}\">{$row_name["name"]}</a></li>";
        $output .= "</ul>";
        echo $output;
        } 
}
?>
</div>
<?php
mysqli_free_result($result);
include_once('../includes/layouts/footer.php');
?>