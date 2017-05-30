<?php 
	include_once('../includes/layouts/header.php');
	include_once('../includes/functions.php');

	if (is_loggedin()) {
		if (is_admin()) {
		}else
		redirect_to('index.php');
	}else
		redirect_to('index.php');
  ?>


<div class="col-md-6">  
    <h3>Add or edit products</h3>
    <ul>
        <li><a href="new_product.php">Add new product</li>
        <li><a href="edit_products.php">Edit/Delete product</a></li>
    </ul> 
</div>