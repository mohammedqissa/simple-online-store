<?php  require_once('../includes/session.php'); ?>
<?php require_once('../includes/config.php'); ?>
<?php require_once('../includes/functions.php'); ?>
<?php require_once('../includes/validation_functions.php'); ?>
<?php include('../includes/layouts/header.php'); ?>
<?php 

if(isset($_POST['submit'])) { 


        $name = mysql_prep($_POST['name']);
        $lastname = mysql_prep($_POST['lastname']);
        $email = mysql_prep($_POST['email']);
        $question = mysql_prep($_POST['question']);
         
         //Validations
         $required_fields = array("$name", "$lastname","$email","$question");
         validate_presences($required_fields);



        $query  = "INSERT INTO contact (";
        $query .= " fname, lname, email, question";
        $query .= ") VALUES ("; 
        $query .= " '{$name}', '{$lastname}', '{$email}', '{$question}'";
        $query .= ")";
        $result = mysqli_query($connection, $query);

        if($result){ 
            $_SESSION["message"] = "Your question has been submited";
            redirect_to("contact.php");
        } else {
    redirect_to("index.php");
}
}


?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Contact information</h2>
                <p>If you have some questions please fill this contact form and we will answer your question as soon as posible</p>
                    <?php //session message
                        echo message(); 
                        //$errors = errors();
                        //echo form_errors($errors);
                         ?> 
        </div>

        <form class="col-md-6" action="contact.php" method="post">
        <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" name="name" id=""  placeholder="Enter your name">
        </div>
        <div class="form-group">
            <label>Last Name</label>
            <input type="text" class="form-control" name="lastname" id=""  placeholder="Enter your last name">
        </div>
        <div class="form-group">
            <label for="">Email address</label>
            <input type="email" class="form-control" id="" name="email"  placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>  
        <div class="form-group">
            <label>Your question</label>
            <textarea class="form-control" id="" name="question" rows="3"></textarea>
        </div>
        <div class="form-group row">
            <div class="offset-sm-2 col-sm-10">
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </div>
            </div>
        </form>

    </div>
</div>

<?php
include_once('../includes/layouts/footer.php');
?>