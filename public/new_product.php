<?php require_once('../includes/config.php'); ?>
<?php require_once('../includes/functions.php'); ?>
<?php require_once('../includes/validation_functions.php'); ?>
<?php include('../includes/layouts/header.php'); 

    if (is_loggedin()) {
        if (is_admin()) {
        }else
        redirect_to('index.php');
    }else
        redirect_to('index.php');

?>

<?php

if(isset($_POST["submit"])) {
    
    
       $upload_dir = "images/";
       upload_and_validation($upload_dir);
    
   
        $pname = mysql_prep($_POST['product_name']);
        $price = mysql_prep($_POST['price']);
        $category = mysql_prep($_POST['category']);
        $description = mysql_prep($_POST['description']);
        $size = mysql_prep($_POST['size']);
        $target_age = mysql_prep($_POST['target_age']);
        $remarks = mysql_prep($_POST['remarks']);
        $stock = mysql_prep($_POST['stock']);

        $photo1 = $upload_dir . $_FILES['photo1']['name'];
        $photo2 = $upload_dir . $_FILES['photo2']['name'];
        $photo3 = $upload_dir . $_FILES['photo3']['name'];

       

        $query  = "INSERT INTO products (";
        $query .= " name, price, category, description, photo_dir, stock, ";
        $query .= ") VALUES ("; 
        $query .= " '{$pname}', '{$price}', '{$category}', '{$description}', '{$photo}', '{$stock}'";
        $query .= ")";
        
        $result = mysqli_query($connection, $query);
        
        if($result){
            $_SESSION["message"] = "Your product has been added! ";
            //redirect_to("new_product.php");
        } else {
            $_SESSION["errors"] = "Something went wrong try again! ";
            redirect_to("new_product.php");
        }
}
    
?>

 
    
    <?php echo message();
          echo errors(); ?>
 <form class="col-md-4 col-md-offset-4" action="new_product.php" enctype="multipart/form-data" method="post" >
        
        <h2> Add new product </h2>
        <div class="form-group">
            <label>Product name</label>
            <input type="text" class="form-control" name="product_name" id=""  placeholder="Enter product name">
        </div>
        <div class="form-group">
            <label>Product price</label>
            <input type="number" class="form-control" name="price" id=""  placeholder="Enter product price">
        </div>
        <div class="form-group">
            <label>Add description</label>
            <textarea class="form-control" id="" name="description" rows="3" placeholder="Add description here"></textarea>
        </div>
        <div class="form-group">
            <label>Product category</label>
            <input type="text" class="form-control" name="product_category" id=""  placeholder="Enter product category">
        </div>
        <div class="form-group">
            <label>Product size</label>
            <input type="text" class="form-control" name="product_name" id=""  placeholder="Enter product size  ex: 5x3x7 ">
        </div>
        <div class="form-group">
            <label>Target Age</label>
            <input type="text" class="form-control" name="target_age" id=""  placeholder="Enter product Target Age">
        </div>        
        <div class="form-group">
            <label>Remarks</label>
            <input type="text" class="form-control" name="remarks" id=""  placeholder="Enter Remarks">
        </div>                    
        <div class="form-group">
            <label>Stock</label>
            <input type="number" class="form-control" id="" name="stock"></input>
        </div>
        <div class="form-group">
            <label>Select images to upload:</label>
           <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
            <input type="file" name="photo1" id="">
           <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
            <input type="file" name="photo2" id="">
           <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
            <input type="file" name="photo3" id="">                        
        </div>
        <div class="form-group row">
            <div class="offset-sm-2 col-sm-10">
            <button type="submit" class="btn btn-primary" name="submit">Add Product</button>
             <a href="manage_content.php">Cancel</a>
            </div>
            </div>
        </form>