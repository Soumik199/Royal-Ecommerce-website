<?php
  include_once "../util/database.php";
  $message="";
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $productname =  $_POST["productname"];
      $productav =  $_POST["productav"];
      $productdes=  $_POST["productdes"];
      $productdis=  $_POST["productdis"];
      $productcat=  $_POST["productcat"];
      $productprice= $_POST["productprice"];
      //file upload
      $pic_name = $_FILES['pic']['name'];//file name
      $pic_size = $_FILES['pic']['size'];//file size
      $pic_tmp = $_FILES['pic']['tmp_name'];//file temporay location
      $directory = "../ProductImage/";
      $image = $directory.$pic_name;
      if($pic_size > 500019)
      {
        echo"Image size should less 5MB";
      }
      else{
      move_uploaded_file($pic_tmp, $image);
      $sql ='INSERT INTO product(productname,productav,productdes,productdis,productcat,productprice,image) VALUES(:productname,:productav,:productdes,:productdis,:productcat,:productprice,:image)';
      $statement= $con->prepare($sql);
      if($statement->execute([':productname'=> $productname ,':productav'=>$productav,'productdes'=>$productdes,'productdis'=>$productdis,':productcat'=>$productcat, ':productprice'=>$productprice ,':image'=>$image])){
            $message= "Data is sumbitted";
        }
        else
        {
          echo "Data is not sumbit";
         }
      }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Items</title>
  <link rel="stylesheet" href="../css/product.css" class="css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
<div class="container">
<div class="card bg-success">
 <article class="card-body mx-auto" style="max-width: 500px;">
     <h2 class="text-white">:Enter The Products Details:</h2>
     <?php if(!empty($message)):?>
       <div class ="alert alert-sucess"><h5><?=$message;?><h5></div>
     <?php endif;?>  
     <form method="POST" enctype="multipart/form-data" action="">
        <!----PRODUCT_NAME ---->
        <div class="form-group col-md-9">
             <label for="productname" class="form-label fs-4 text-white">Product-Name:</label>
             <input  name="productname" type="text" class="form-control"  id="productname" placeholder="PRODUCT-NAME ">
        </div>
          <!-------PRODUCT-AVIABLE--->
       <div class=" form-group col-md-9">
          <label for="productav" class="form-label fs-4 text-white">Available Quantity:</label>
          <input  name="productav" type="text" class="form-control"  id="productav" placeholder="PRODUCT-AVAILABLE ">
       </div>
         <!-----PRODUCT-DES------>
         <div class=" form-group col-md-9">
             <label for="productdes" class="form-label fs-4 text-white">Product-Descripition:</label>
             <textarea name="productdes"  class="form-control"  id="productdes"></textarea>
         </div>
        <!-----PRODUCT DISCOUNT--->
        <div class=" form-group col-md-9">
           <label for="productdis" class="form-label fs-4 text-white">Product-Discount:</label>
           <input name="productdis" type="text" class="form-control"  id="productdis" placeholder="PRODUCT-DISCOUNT ">
        </div>
         <!---PRODUCT-CAT--->
         <div class="form-group col-md-9">
               <label for="productcat" class="form-label fs-4 text-white">Product-Category:</label>
               <input name="productcat" type="text" class="form-control"  id="productcat" placeholder="PRODUCT-CAT ">
         </div>
         <!---PRODUCT-price--->
         <div class="form-group col-md-9">
               <label for="productprice" class="form-label fs-4 text-white">Product-Price:</label>
               <input name="productprice" type="text" class="form-control"  id="productprice" placeholder="PRODUCT-PRICE ">
         </div>
         
           <!---Upload Image --->
          <div class=" form-group col-md-9">
             <label for="pic" class="form-label fs-4 text-white">Upload Image:</label>
              <input id="pic" name="pic" class="form-control" type="file">
          </div>
        
        <!-------SUMBIT--->
        <div class=" form-group col-md-9">
           <label for="sumit" class="form-label fs-4 text-white "></label>
            <button type="sumbit" class="btn btn-danger btn-block but">SUMBIT</button>
       </div>
      </form>
    </article>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</div>
</body>
</html>
