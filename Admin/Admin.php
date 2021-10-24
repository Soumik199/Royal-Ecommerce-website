<?php
include_once "../util/database.php";
$msg="";
  $sql = 'SELECT * FROM product';
  $statement =$con->prepare($sql);//A prepared statement is a feature used to execute the same (or similar) SQL statements repeatedly with high efficiency.
  $statement->execute();
  $product=$statement->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
<section>
<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand">Royal Store</a>
    <form class="d-flex">
    <a href="../User/nav.php" button type="button" class="btn btn-warning">Visit site</button></a>
    </form>
  </div>
</nav>
</section>
<div class="container-fluid">
      <div class="card mt-9 ">
           <div class="container-fluid bg-primary text-white">
                <h2 style="text-align:center;font-style:bold">List Of All Items</h2>
            </div>
        <div class="card-body">
           <table  class="table  table-bordered bg-light">
           <tr>
              <th>Product-Id</th>
              <th>Product-Name</th>
              <th>Available Quantity </th>
              <th>Product-Descripition</th>
              <th>Product-Discount </th>
              <th>Product-Category </th>
              <th>Product-Price</th>
              <th>Product-Image</th>
              <th>ACTIONS </th>
             </tr>
           <?php foreach($product as $prods): ?>
             <tr>
             <td><?= $prods->productid;?></td>
             <td><?= $prods->productname;?></td>
             <td><?= $prods->productav;?></td>
             <td><?= $prods->productdes;?></td>
             <td><?= $prods->productdis;?></td>
             <td><?= $prods->productcat;?></td>
             <td><?= $prods->productprice;?></td>
             <td><?= $prods->image;?></td>
             <td>
             <a class="btn btn-dark" href="editproduct.php?productid=<?=$prods->productid?>" role="button"><i class="fa fa-pencil" aria-hidden="true"></i></a>
             </td>
             <td>
             <a onclick="return confirm('Are you sure you want to delete this entry')"href="deleteproduct.php?productid=<?=$prods->productid?>" role="button" class="btn btn-primary"><i class="fa fa-trash-o" aria-hidden="true" style="color:white"></i></a>
             </td>
             </tr>
            <?php endforeach;?>
        </table>
        </div>
       
       </div>
  
  
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>