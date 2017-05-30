<?php  require_once('../includes/session.php'); ?>
<?php require_once('../includes/config.php'); ?>
<?php require_once('../includes/functions.php'); ?>
<?php require_once('../includes/validation_functions.php'); ?>
<?php include('../includes/layouts/header.php'); ?>

<?php if(!is_loggedin()){


    if (!isset($_SESSION['reg#'])) {
        $_SESSION['reg#'] =1;
    }

    if ($_SESSION['reg#']==1) {
        
    

    ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Register</h2>
                <p> Step 1 of Registration</p>
        </div>

        <form class="col-md-6" action="register.php" method="post">
        <H3   class=""> Main Information: </H3>
        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="name" id=""  placeholder="Enter your name" value="<?php echo isset($_POST['name'])?$_POST['name']: ""; ?>">
        </div>
        <div class="form-group">
            <label>Address</label>
            <input type="text" class="form-control" name="address" id=""  placeholder="Enter your Address" value="<?php echo isset($_POST['name'])?$_POST['address']: ""; ?>">
        </div>
        <div class="form-group">
            <label>Date of Birth</label>
            <input type="text" class="form-control" name="date" id=""  placeholder="Enter your Date of Birth ex: 23/4/1990" value="<?php echo isset($_POST['name'])?$_POST['date']: ""; ?>">
        </div>
        <div class="form-group">
            <label for="">Email address</label>
            <input type="email" class="form-control" id="" name="email"  placeholder="Enter email" value="<?php echo isset($_POST['name'])?$_POST['email']: ""; ?>">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>  
        <div class="form-group">
            <label>Phone Number</label>
            <input type="text" class="form-control" name="phone" id=""  placeholder="Enter your Phone Number" value="<?php echo isset($_POST['name'])?$_POST['phone']: ""; ?>">
        </div>
        <H3   class=""> Credit Card Information:  </H3>
        <small id="" class="form-text text-muted">Your credit card details is in safe hands</small>
        <div class="form-group">
            <label>CC Number</label>
            <input type="text" class="form-control" name="number" id=""  placeholder="Enter your CC Number" value="<?php echo isset($_POST['name'])?$_POST['number']: ""; ?>">
        </div>
        <div class="form-group">
            <label>Expire Date</label>
            <input type="text" class="form-control" name="exDate" id=""  placeholder="Enter your CC Expire Date" value="<?php echo isset($_POST['name'])?$_POST['exDate']: ""; ?>">
        </div>
        <div class="form-group">
            <label>CC Name</label>
            <input type="text" class="form-control" name="cName" id=""  placeholder="Enter your CC Name" value="<?php echo isset($_POST['name'])?$_POST['cName']: ""; ?>">
        </div>
        <div class="form-group">
            <label>Bank Name</label>
            <input type="text" class="form-control" name="bName" id=""  placeholder="Enter the Bank Name" value="<?php echo isset($_POST['name'])?$_POST['bName']: ""; ?>">
        </div>

<?php
if (isset($_POST['submit'])) {
    echo '<h6 class="alert alert-danger">Wrong Entries</h6>';
}
 ?>
        <div class="form-group row">
            <div class="offset-sm-2 col-sm-10">
                <button type="submit" class="btn btn-primary" name="submit">Step 2</button>
            </div>
            </div>
        </form>

    </div>
</div>


<?php
    if(isset($_POST['name']) &&  isset($_POST['address']) && isset($_POST['date'])  && isset($_POST['email'])  && isset($_POST['phone'])  &&
    isset($_POST['number']) &&  isset($_POST['exDate'])  &&isset($_POST['exDate'])  && isset($_POST['bName']) 
     ){
         
          if(!empty($_POST['name']) && !empty($_POST['address']) &&!empty($_POST['date']) && !empty($_POST['email']) &&!empty($_POST['phone'])
            &&!empty($_POST['number'])  && !empty($_POST['exDate']) &&!empty($_POST['cName']) && !empty($_POST['bName'])){
         

    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $address=mysqli_real_escape_string($connection, $_POST['address']);
    $date=mysqli_real_escape_string($connection, $_POST['date']);
    $email=mysqli_real_escape_string($connection, $_POST['email']);
    $phone=mysqli_real_escape_string($connection, $_POST['phone']);
    
    $number=mysqli_real_escape_string($connection, $_POST['number']);
    $exDate=mysqli_real_escape_string($connection, $_POST['exDate']);
    $cName=mysqli_real_escape_string($connection, $_POST['cName']);
    $BanckName=mysqli_real_escape_string($connection, $_POST['bName']);
    
    $_SESSION['name']=$name;
    $_SESSION['address']=$address;
    $_SESSION['date']=$date;
    $_SESSION['email']=$email;
    $_SESSION['phone']=$phone;
    $_SESSION['number']=$number;
    $_SESSION['exDate']=$exDate;
    $_SESSION['cName']=$cName;
    $_SESSION['BanckName']=$BanckName;
    

    $query= "INSERT INTO `users` (`name`, `address`, `date`, `email`, `phone`, `number`, `exDate`, `cName`, `BanckName`) 
             VALUES ( '$name', '$address', '$date', '$email', '$phone', '$number', '$exDate', '$cName', '$BanckName');";
                                         
                         if($query_run=mysqli_query($connection,$query)){

                                $_SESSION['reg#']=2;

                                redirect_to("register.php");
                        }                           
                        else
                            echo "error in register 1 query";


    
    }
    }


}else
{
    ?>



<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Register</h2>
                <p> Step 2 of Registration</p>
        </div>

        <form class="col-md-6" action="register.php" method="post">
        <H3   class=""> User Information: </H3>
        <div class="form-group">
            <label>User Name</label>
            <input type="text" class="form-control" name="username" id=""  placeholder="Enter user name" value="<?php echo isset($_POST['username'])?$_POST['username']: ""; ?>">
                        <small id="" class="form-text text-muted">user name should be between 6-13 character</small>

        </div>
        <div class="form-group">
            <label for="">Password</label>
            <input type="password" class="form-control" id="" name="password1"  placeholder="Enter password">
            <small id="" class="form-text text-muted">Password should be between 8-12 character</small>
        </div>  
        <div class="form-group">
            <label>Password conformation</label>
            <input type="password" class="form-control" name="password2" id=""  placeholder="reEnter your password">
        </div>

        <?php
if (isset($_POST['submit'])) {
    echo '<h6 class="alert alert-danger">Wrong Entries</h6>';
}
 ?>

        <div class="form-group row">
            <div class="offset-sm-2 col-sm-10">
                <button type="submit" class="btn btn-primary" name="submit">Register</button>
            </div>
            </div>
        </form>

    </div>
</div>


    <?php

if(isset($_POST['username']) & isset($_POST['password1']) & isset($_POST['password2'])){
    
    if(!empty($_POST['username']) & !empty($_POST['password1']) & !empty($_POST['password2'])){
        
        $password1=mysqli_real_escape_string($connection,$_POST['password1']);
        $password2=mysqli_real_escape_string($connection,$_POST['password2']);
        $username=mysqli_real_escape_string($connection,$_POST['username']);
        
        global $connection;
        $password_hash=md5($password1);

        if($password1== $password2 ){
        if((strlen($password1)<=12 && strlen($password1)>=8 )&& (strlen($username)>=6 && strlen($username)<=13)){
        
        $query="SELECT * FROM `users` where `email` = '".$_SESSION['email']."'";
        echo $query;
        if($query_run = mysqli_query($connection, $query)){
             $query_num=mysqli_num_rows($query_run);
             if($query_num==1){
                 $id=mysqli_result($query_run ,0,'id');
                 
                 $queryAdd=" UPDATE `users` SET `password` = '$password_hash', `userName` = '$username' WHERE `id` = $id;";
                 echo "<BR> $queryAdd ";
                 // var_dump($mysqli_result);
                 if($query_run_add = mysqli_query($connection, $queryAdd)){
                        $_SESSION['reg#']=1;


                        $_SESSION['name']="";
                        $_SESSION['address']="";
                        $_SESSION['date']="";
                        $_SESSION['email']="";
                        $_SESSION['phone']="";
                        $_SESSION['number']="";
                        $_SESSION['exDate']="";
                        $_SESSION['cName']="";
                        $_SESSION['BanckName']="";

                        $_SESSION['username']="";
                        $_SESSION['password1']="";
                        $_SESSION['password2']="";


                         $login = attempt_login($username, $password1);

                        var_dump($login);

                        if($login == 1) {
                            redirect_to("manage_content.php");
                        } elseif ($login == 2) {
                            redirect_to("products.php");
                        }
                        elseif ($login == -1) {
                            echo " error in connection ";
                        }               
                 }
             }
         
         
        } 
}


}}}}

}else
    redirect_to("index.php");//logged in

include_once('../includes/layouts/footer.php');
?>