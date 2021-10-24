<?php
require "../util/database.php";
$productid = $_GET['productid'];
$sql = 'SELECT * FROM product WHERE productid =:productid';
$statement = $con->prepare($sql);
$statement->execute([':productid'=> $productid ]);
$product = $statement->fetch(PDO::FETCH_OBJ);
 //var_dump($product);
// Update The data//
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  $productname = $_POST["productname"];
  $productav =  $_POST["productav"];
  $productdes=  $_POST["productdes"];
  $productdis=  $_POST["productdis"];
  $productcat=  $_POST["productcat"];
  $productprice= $_POST["productprice"];
  $sql = 'UPDATE product SET productname=:productname,productav=:productav,productdes=:productdes,
  productdis=:productdis,productcat=:productcat,productprice=:productprice WHERE productid=:productid';
  $statement = $con->prepare($sql);
  if($statement->execute([':productid'=>$productid,':productname'=> $productname,':productav'=>$productav,
  ':productdes'=>$productdes,':productdis'=>$productdis,':productcat'=>$productcat,':productprice'=>$productprice])){
    header("Location: ../util/productdisplay.php");
  }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Edit Product Details</title>
  <link rel="stylesheet" href="../css/product.css" class="css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
<div class="container">
<div class="card  bg-dark">
 <article class="card-body mx-auto" style="max-width: 500px;">
     <h2 class="text-white">Edit The Products Details</h2>
     <?php if(!empty($message)):?>
       <div class ="alert alert-sucess"><h5><?=$message;?><h5></div>
     <?php endif;?>  
     <form method="POST" enctype="multipart/form-data" action="">
        <!----PRODUCT_NAME ---->
        <div class="form-group col-md-9">
             <label for="productname" class="form-label fs-4 text-white">Product-Name:</label>
             <input  name="productname" value="<?=$product->productname?>"type="text" class="form-control"  id="productname" placeholder="PRODUCT-NAME ">
        </div>
          <!-------PRODUCT-AVIABLE--->
       <div class=" form-group col-md-9">
          <label for="productav" class="form-label fs-4 text-white">Available Quantity:</label>
          <input  name="productav"  type="text" class="form-control" value="<?=$product->productav?>" id="productav" placeholder="PRODUCT-AVAILABLE ">
       </div>

         <!-----PRODUCT-DES------>
         <div class=" form-group col-md-9">
             <label for="productdes" class="form-label fs-4 text-white">Product-Descripition:</label>
             <textarea name="productdes" value=""class="form-control"  id="productdes"><?= $product->productdes?></textarea>
         </div>
        <!-----PRODUCT DISCOUNT--->
        <div class=" form-group col-md-9">
           <label for="productdis" class="form-label fs-4 text-white">Product-Discount:</label>
           <input name="productdis" type="text" class="form-control"value="<?= $product->productdis?>"  id="productdis" placeholder="PRODUCT-DISCOUNT ">
        </div>
         <!---PRODUCT-CAT--->
         <div class="form-group col-md-9">
               <label for="productcat" class="form-label fs-4 text-white">Product-Category:</label>
               <input name="productcat" type="text" class="form-control"value="<?= $product->productcat?>"  id="productcat" placeholder="PRODUCT-CAT ">
         </div>
         <!---PRODUCT-price--->
         <div class="form-group col-md-9">
               <label for="productprice" class="form-label fs-4 text-white">Product-Price:</label>
               <input name="productprice" type="text" class="form-control" value="<?= $product->productprice?>"   id="productprice" placeholder="PRODUCT-PRICE ">
         </div>
        
        <!-------SUMBIT--->
        <div class=" form-group col-md-9 mt-4">
           <label for="sumit" class="form-label fs-4 text-white "></label>
             <button type="sumbit" class="btn btn-primary btn-block but">EDIT</button>
       </div>
      </form>
    </article>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</div>
</body>
</html>
