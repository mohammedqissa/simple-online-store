<?php

function redirect_to($new_location) {
    header("Location: ". $new_location);
}

function mysqli_result($res,$row=0,$col=0){ 
    $numrows = mysqli_num_rows($res); 
    if ($numrows && $row <= ($numrows-1) && $row >=0){
        mysqli_data_seek($res,$row);
        $resrow = (is_numeric($col)) ? mysqli_fetch_row($res) : mysqli_fetch_assoc($res);
        if (isset($resrow[$col])){
            return $resrow[$col];
        }
    }
    return false;
}

function mysql_prep($string) {

    global $connection;

    $escaped_string = mysqli_real_escape_string($connection, $string);
    return $escaped_string; 
}

function form_errors($errors=array()) {
    $output = "";
    if(!empty($errors)) {
        $output = "<div class=\"error\">";
        $output .= "Please fix the following errors: ";
        $output .= "<ul>";
        foreach($errors as $key => $error) {
            $output .= "<li>{$error}</li>";
        }
        $output .= "</ul>";
        $output .= "</div";
    }
    return $output;
}

function attempt_login($username, $password) {
    global $connection;

     $safe_username = mysqli_real_escape_string($connection,$username);
     $safe_password = mysqli_real_escape_string($connection,$password);


    $password_hash=md5($safe_password);
     if(!empty($safe_username) && !empty($safe_password)){
         $query="select * FROM `users` where `userName` = '".$safe_username."' and `password` = '".$password_hash."' and is_active = '1'";

         if($query_run = mysqli_query($connection, $query)){
             $query_num=mysqli_num_rows($query_run);
             if($query_num==0){
                 return 0; //wrong pass or name
                 
             }else if($query_num==1){
                $user_id=mysqli_result($query_run ,0,'id');
                $rule=mysqli_result($query_run ,0,'rule');
                $userName=mysqli_result($query_run ,0,'userName');
                $_SESSION['user_id']=$user_id;
                $_SESSION['userName']= $userName;
                $_SESSION['rule']= $rule;

                if ($rule == 1) {
                    return 1; //admin
                }
                elseif ($rule == 2) {
                    return 2; //user
                }

               }
         
         } else {return -1;} // error in connection 
         
     } else {return -2;} //error empty name or pass

}




function category_select() {
    global $connection;

    $query  = "SELECT distinct category ";
    $query .= "FROM products";
    $result = mysqli_query($connection, $query);
    echo $query;
    if(!$result) {
        echo "error";
    }
     while($row_category = mysqli_fetch_assoc($result)){
       
        $output  = "<option>";
        $output .= "{$row_category["category"]}";
        $output .= "</option>";
        echo $output;
    }           
}

function get_products() {
    global $connection;
    $query = "SELECT * ";
    $query .= "FROM products ";
    $query .= "WHERE visible = 1;";
    $products = mysqli_query($connection, $query);
    if (!$products) {
    // redirect_to("error.php");
    }
    $product = array();
    while($row_product = mysqli_fetch_assoc($products)) {
        $product[] = $row_product;
    }
    $count = 0;
    foreach($product as $item) {
               if ($count == 0) {
            echo "  <div class='row' >";
        }
        $output  = "<div class=\"col-xs-10 col-sm-6 col-md-4 col-lg-4 product\">";
        $output .= "<div class=\"panel panel-default\">";
        $output .= "<div class=\"panel-heading\">";
        $output .= "<a href=\"product-detail.php?id={$item["id"]}\"><h3 class=\"panel-title\">{$item["name"]}</h3><a>";
        $output .= "</div>";
        $output .= "<div class=\"panel-body\">";
        $output .= "<div class=\"thumbimg\">";
        $output .= "<img class=\"img-responsive\"src=\"{$item["photo_dir"]}1.jpg\" ";
        $output .= "alt=\"Photo of {$item["name"]}\">";
        $output .= "</div>";
        $output .= "<p>&nbsp;&nbsp;Price: {$item["price"]} </p>";
        $output .= "</div>";
        $output .= "</div>";
        $output .= "</div>";

        $count++;
        echo $output;
        if ($count == 3) {
            $count = 0;
            echo "  </div>";
        }
    }      
    mysqli_free_result($products);
}
 
function upload_and_validation($upload_dir) { 
    
    $tmp_file = $_FILES['photo']['tmp_name'];
    $target_file = basename($_FILES['photo']['name']);
    $file_size = $_FILES['photo']['size'];
    $file_error = $_FILES['photo']['error'];
    
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    $uploadOk = 1;

     // Check if file already exists
    if (file_exists($target_file)) {
        $_SESSION["errors"] = "Sorry, file already exists.";
        $uploadOk = 0;
        redirect_to("new_product.php");
    }

    // Check file size
    if ($file_size > 500000) {
        $_SESSION["errors"] = "Sorry, your file is too large.";
        $uploadOk = 0;
        redirect_to("new_product.php");
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        $_SESSION["errors"] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
        redirect_to("new_product.php");
    }
    // Check if $uploadOk is set to 0 by an error
    move_uploaded_file($tmp_file, $upload_dir.$target_file);
}

function is_loggedin(){
    if (isset($_SESSION['userName'])) {
        return true;
    }
    return false;
}

function is_admin(){
    if (isset($_SESSION['rule'])) {
        if ($_SESSION['rule'] == 1) {
            return true;
        }
    }
    return false;
}

function logout(){
    session_destroy();
}

function is_in_cart($id){
    if(isset($_SESSION['cart'])){
        if(isset($_SESSION['cart'][$id])){
            return  true;
        }
    }
    return false;
}

/*function list_products() {
    global $connection;

    $query  = "SELECT * ";
    $query .= "FROM products";
    $result = mysqli_query($connection, $query);
    if(!$result) {
        echo "error";
    }
     while($row_name = mysqli_fetch_assoc($result)){
       
        $output  = "<ul>";
        $output .= "<li><a href=\"edit_products.php?id={$row_name["id"]}\">{$row_name["name"]}</a></li>";
        $output .= "</ul>";
        echo $output;
    }           
}*/



 ?>
