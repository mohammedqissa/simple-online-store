<?php 
session_start();

function message() {
    if(isset($_SESSION["message"])) {
        $output  = "<div class=\"col-md-6 alert alert-success\">";
        $output .= "<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">";
        $output .= "&times;</a>";
        $output .= htmlentities($_SESSION["message"]);
        $output .= "</div>"; 
        
        
        $_SESSION["message"] = null;
        
        return $output;
    }
 }

 function errors() {
     if(isset($_SESSION["errors"])) {
        $output  = "<div class=\"col-md-6 alert alert-danger\">";
        $output .= "<a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">";
        $output .= "&times;</a>";
        $output .= htmlentities($_SESSION["errors"]);
        $output .= "</div>"; 
        
        
        $_SESSION["errors"] = null;
        
        return $output;
     }
 }

?>