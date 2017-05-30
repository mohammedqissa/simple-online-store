<?php include_once('../includes/layouts/header.php');  ?>
<?php include_once('../includes/validation_functions.php');  ?>
<?php include_once('../includes/functions.php');  ?>
<?php 

// session_destroy();

if (is_loggedin()) {
    redirect_to('index.php');
}

if (!isset($_SESSION["attempts"])) {
    $_SESSION["attempts"]=3;
}

if ($_SESSION["attempts"]>1) {
    
if(isset($_POST['submit'])) {

$required_fields = array("username", "password"); 
validate_presences($required_fields);
    
    $username = mysqli_real_escape_string($connection,$_POST["username"]);
    $password = mysqli_real_escape_string($connection,$_POST["password"]);
    $login = attempt_login($username, $password);
    // var_dump($login);
    if($login == 1) {
       // $_SESSION["message"] = "Loggin succesful!";
        $_SESSION["attempts"]=3;
        redirect_to("manage_content.php");
    } elseif ($login == 2) {
        $_SESSION["attempts"]=3;
        redirect_to("products.php");
    }
    elseif ($login == -1) {
        echo " error in connection ";
    } 
    // { 
        // redirect_to("index.php");
         //$_SESSION["message"] = "Username/password not found.";
    // }

}
?>


<div class="container">
    <div class="row">
        <div class="col-md-offset-4 col-md-3">
            <div class="form-login">
            <h4>Welcome back.</h4>
            <form action="login.php" method="post">
            <input type="text" id="" name="username" class="form-control input-sm chat-input" placeholder="Username" />
            </br>
            <input type="password" id="" name="password" class="form-control input-sm chat-input" placeholder="Password" />
            </br>
            <?php if (isset($login)) {
                 if ($login == 0) {
                $_SESSION["attempts"]--;
                 $_SESSION['last_login_time'] = time();
                echo '<h6 class="alert alert-danger">Wrong username or password! </h6>';

                }
                elseif ($login == -2) {
                    echo '<h6 class="alert alert-danger">username and password required! </h6>';
                }
            } 

                                    echo '<h6 class="alert alert-danger">you have '.($_SESSION["attempts"]).' trails</h6>';

            ?>
            <div class="form-group row">
            <div class="offset-sm-2 col-sm-10">
                <button type="submit" class="btn btn-primary" name="submit">Login</button>
            </div>
            </div>
            </form>
            </div>
        </div>
    </div>
</div>
<?php 
}else{
    if(time() - $_SESSION['last_login_time'] < 15*60 ) 
      {
        ?>
                     <div class="row">
                <div class="col-md-6 col-md-offset-3">
                                    <h6 class="alert alert-danger text-center"> You have to wait <?php echo round(15-(time() - $_SESSION['last_login_time'])/(15*60),2)?> minutes </h6>
                </div>
            </div>

      <?php }
      else
      {
        $_SESSION['attempts']=3;
      }

 }
