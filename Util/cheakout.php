<?php
  session_start();
  include_once "database.php";
  $msg="";
  if (strlen($_SESSION['uid']==0)) {
  header('location:login.php');
  } 
  else{
  $id=$_SESSION['uid'];
  if ($_SERVER['REQUEST_METHOD']=='POST') {
   $name = $_POST['name'];
   $email =$_POST['email'];
   $address=$_POST['address'];
   $phnumber=$_POST['phnumber'];
   $city=$_POST['city'];
   $state=$_POST['state'];
   $cod=$_POST['cod'];
   $paymentstatus='confirm By user';
   $cartStatus='1';
   $sql = 'UPDATE cart SET name=:name, address=:address,phnumber=:phnumber,city=:city,state=:state,cod=:cod ,paymentstatus=:paymentstatus,cartStatus=:cartStatus WHERE userId=:id';
   $statement = $con->prepare($sql);
   if ($statement->execute([':name' => $name, ':address' => $address,':phnumber'=>$phnumber, 'city'=>$city,':state'=>$state,':cod'=>$cod,':paymentstatus'=>$paymentstatus,'cartStatus'=>$cartStatus,':id' => $id])) {
     header("location: order.php");
   }
 }
 $sql= 'SELECT productid,image,productname,productprice,quantity FROM cart';
  $statement =$con->prepare($sql);//A prepared statement is a feature used to execute the same (or similar) SQL statements repeatedly with high efficiency.
  $statement->execute();
  $product=$statement->fetchAll(PDO::FETCH_OBJ);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cheakout</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" class="css">
  <link rel="stylesheet" href="../css/cheakout.css" class="css">
</head>
<body>  
<div class="container">
        <div class="col-40">
        <div class="panel panel-info">
            <div class="panel-heading"><i class="fa fa-shopping-cart" aria-hidden="true"></i>
              Review Order <div class="pull-right"><small><a class="afix-1" href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit Cart</a></small></div>
            </div>
        <div class="panel-body py-2">
            <?php foreach($product as $prods): ?>
              <div class="form-group">
                   <div class="col-40">
                       <img class="img-responsive"src="<?=$prods->image;?>" width="20%">
                   </div>
                   <div class="col-30">
                       <div class="col-30"><?=$prods->productname;?></div>
                             <div class="col-30"><small>Quantity:<span><?=$prods->quantity;?></span></small></div>
                        </div>
                         <div class="col-40 text-right">
                             <h6><span>Rs: </span><?=$prods->productprice;?></h6>
                          </div>
                  </div>
              <?php endforeach; ?>
        </div>
        </div>
    </div>
   <form method="POST">
      <div class="row">
        <div class="col-40">
            <h3 style="text-align:center">Billing Address</h3>
            <label for="fname"><i class="fa fa-user"></i> Full Name</label>
            <input type="text" id="fname" name="name" placeholder="John M. Doe"autocomplete="off">

            <label for="email"><i class="fa fa-envelope"></i> Email</label>
            <input type="text" id="email" name="email" placeholder="john@example.com"autocomplete="off">

            <label for="adr"><i class="fa fa-address-card-o"></i> Address</label>
            <input type="text" id="adr" name="address" placeholder="542 W. 15th Street"autocomplete="off">

            <label for="phnumber"><i class="fa fa-mobile" aria-hidden="true"></i></i> Ph.Number</label>
            <input type="text" id="phnumber" name="phnumber" placeholder="91+000-000-0000"autocomplete="off">

            <label for="city"><i class="fa fa-institution"></i> City</label>
            <input type="text" id="city" name="city" placeholder="New York"autocomplete="off">

            <label for="state">State</label>
            <input type="text" id="state" name="state" placeholder="NY"autocomplete="off"autocomplete="off">

            <span for="payment">Cash of Delivery</span>
            <input type="radio" name="COD" class="radio">
            <br>
            <br>
            <button class="btn btn-primary" type="submit">Confirm And Pay</button>   
      </form>
</div>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</body>
</html>
