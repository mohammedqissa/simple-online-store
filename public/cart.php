<?php
require_once('../includes/config.php');
require_once('../includes/functions.php');
include_once('../includes/layouts/header.php');


	if(isset($_GET['method'])){
		switch ($_GET['method']){
			case "addToCart":
				if(isset($_GET['product_id'])){
					if(!isset($_SESSION['cart'])){
						$_SESSION['cart'] = array();

					}
					if(!isset($_SESSION['cart'][$_GET['product_id']])){
						$_SESSION['cart'][$_GET['product_id']]=['price' => $_GET['product_price'],'id' => $_GET['product_id'],'name'=> $_GET['product_name']];
					}
					redirect_to("product-detail.php?id=".$_GET['product_id']);
				} else {
					//XXX add badboy code?
					redirect_to("products.php");
				}
				break;

			case "removeFromCart":
				if(isset($_GET['product_id'])){
					if(isset($_SESSION['cart'])){
						if(isset($_SESSION['cart'][$_GET['product_id']])){
							unset($_SESSION['cart'][$_GET['product_id']]);
						}
					}
					redirect_to("product-detail.php?id=".$_GET['product_id']);
				} else {
					redirect_to("products.php");
				}
				break;
		}
	}else{
		?>
	<div class="row">
		<div class="col-sm-offset-2 col-md-8 panel panel-default text-center">
			<h3> Shopping Cart </h3>
		</div>
		<div class="col-sm-offset-2 col-md-8 ">
			<ul class="list-group">

	<?php
		$price=0;
		if (isset($_SESSION['cart'])) {
			foreach ($_SESSION['cart'] as $product) {
				echo '<li class="list-group-item"><a href="product-detail.php?id='.$product['id'].'">'.$product["name"].' | '.$product["price"].'$</a></li>';
				$price += $product["price"];
			}
		}
		echo '<li class="list-group-item disabled"><a >total price = '.$price.'$</a></li></ul>';

	}
	echo '
		</div>';


include_once('../includes/layouts/footer.php');
?>