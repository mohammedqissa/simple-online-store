<?php
include('../includes/functions.php');
session_start();
logout();
redirect_to('index.php');
?>