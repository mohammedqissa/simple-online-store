<?php 
require_once("../includes/config.php");
require_once("../includes/functions.php");
require_once('../includes/session.php');

$pageTitle = "Toyor al-Janna";


?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">

	<title><?php echo isset($pageTitle) ? $pageTitle : "shop" ?></title>
	<meta name="description" content="Simple Toys Shop">
	<meta name="author" content="Mohammed Issa">

	<link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../public/css/styles.css">
</head>

<body>

<div class="container-fluid" id="header">
	<h1><a href="index.php"><?php echo isset($pageTitle) ? $pageTitle : "shop" ?></a></h1>
</div>

<nav class="navbar navbar-default">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-nav">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
	</div>
	<div class="collapse navbar-collapse" id="main-nav">
		<ul class="nav navbar-nav">
			<li class="active"><a href="index.php">Home</a></li>
			<li><a href="products.php">Products</a></li>
			<?php if (!is_loggedin() ){
				if (is_admin()) {
				echo '<li><a href="contact.php">Contact</a></li>';
				}
			}
			?>
			<?php if (is_loggedin() ){
				if (is_admin()) {
				echo '<li><a href="manage_content.php">Manage Products</a></li>';
				}
			}
			?>
			<li><a href="cart.php">Shopping Cart</a></li>

		</ul>
		<ul class="nav navbar-nav navbar-right">
			<?php if (is_loggedin() ){
				echo '<li><a href="logout.php">Logout</a></li>';
			} else{
				echo '<li><a href="register.php">Register</a></li>';
				echo '<li><a href="login.php">Login</a></li>';
			}

			// var_dump($_SESSION['cart']);
			?>
				<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-shopping-cart"></span> <b class="caret"></b></a>
				<ul class="dropdown-menu">
				
				<?php 
					$price=0;
					if (isset($_SESSION['cart'])) {
						foreach ($_SESSION['cart'] as $product) {
							echo '<li><a href="product-detail.php?id='.$product['id'].'">'.$product["name"].' | '.$product["price"].'$</a></li>';
							$price += $product["price"];
						}
					}
					echo '<li><a href="cart.php">total price = '.$price.'$</a></li>';

				?>

					
				</ul>
			</li>
		</ul>
	</div>
</nav>
