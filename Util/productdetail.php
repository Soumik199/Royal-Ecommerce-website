<?php
    session_start();
	include_once "database.php";
	$productid = $_GET['productid'];
    $sql = 'SELECT * FROM product WHERE productid=:productid';
    $statement =$con->prepare($sql);
    $statement->execute([':productid'=>$productid]);
	$product=$statement->fetch(PDO::FETCH_OBJ);
	//var_dump($product);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product Detail</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
     <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
     <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/productdetail.css" class="css">
  </head>
  <body>
	<div class="container">
		<div class="card">
			<div class="container-fliud">
				<div class="wrapper row">
					<div class="preview col-md-6">
						
						<div class="preview-pic tab-content">
						  <div class="tab-pane active" id="pic-1"><img src="<?= $product->image; ?>"></div>
						</div>
					</div>
					<div class="details col-md-6">
						<h3 class="product-title"></h3>
						<div class="rating">
							<div class="stars">
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star"></span>
								<span class="fa fa-star"></span>
							</div>
							<span class="review-no">41 reviews</span>
						</div>
						<h2>Product Description</h2>
						<p class="product-description"><?= $product->productdes; ?></p>
						<h3>Product Available Instock</h3>
						<h4><?= $product->productav; ?></h4>
						<h5 class="price">Current Price:<span> Rs.<?= $product->productprice; ?></span></h5>
						<h5 class="price">Discount price: <span><?= $product->productdis; ?></span></h5>
						<p class="vote"><strong>91%</strong> of buyers enjoyed this product! <strong>(87 votes)</strong></p>
						<div class="action">
						<form method="POST" action="cart.php">
                            <input type="number" name="quantity" value="1" min="1" placeholder="Quantity" size="1px" required>
                            <input type="hidden" name="productname" value="<?=$product->productname?>">
                            <input type="hidden" name="image" value="<?=$product->image?>">
                            <input type="hidden" name="productprice" value="<?=$product->productprice?>">
                            <input type="hidden" name="productid" value="<?=$product->productid?>">
							<input type="submit" value="Add to cart" class="btn btn-primary">
							</form>
							<button class="like btn btn-default" type="button"><span class="fa fa-heart"></span></button>
                      
					    </div>
					</div>
				</div>
			</div>
		</div>
	</div>
  </body>
</html>
