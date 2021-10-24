<?php
 session_start();
 include_once "database.php";
  if(strlen($_SESSION["uid"]==0)){
      header('location:login.php');
}
  else{
       $userId=$_SESSION['uid'];
        // session_start();$id = $_GET['id'];
        $i=0;
        $subtotal=0;
        $Total=0;
        //submit data to the cart table
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
             $userId= $_SESSION['uid'];
             $productname= $_REQUEST['productname'];
             $productprice= $_REQUEST['productprice'];
             $quantity= $_REQUEST['quantity'];
             $image= $_REQUEST['image'];
             $productid = $_REQUEST['productid'];
             $cartStatus="0";
             $query= $con->prepare("select productid,cartStatus from cart WHERE  productid =: productid ");
             $query->bindValue(':productid',$productid);
             $query->execute();
             $data=$query->fetchAll(PDO::FETCH_OBJ);
            if ($query->rowCount()>0)
            {
    
                $sql = 'UPDATE cart SET quantity=:quantity WHERE userId=:id and productid=:productid';
                $statement = $con->prepare($sql);
                if ($statement->execute([ ':quantity' => $quantity, ':id' => $userId,':productid' => $productid])) 
                {
                header('Location:cart.php');
                }
        // echo '<script type="text/javascript">alert("product is already added to cart")</script>';
            
            }
        // prepared statement is a feature used to execute the same (or similar) SQL statements repeatedly with high efficiency.
            else
            {
                # code..
                $sql = 'INSERT INTO cart (userId,productname,productprice,quantity,image,productid,cartStatus) VALUES(:userId,:productname,:productprice,:quantity,:image,:productid,:cartStatus)';
                $statement = $con->prepare($sql);
                if ($statement->execute([':userId'=>$userId,':productname' => $productname, ':productprice'=>$productprice,':quantity' => $quantity,'image'=>$image,':productid'=>$productid,':cartStatus'=>$cartStatus]))
                {
                    header('location:cart.php');
                 echo  'data inserted successfully';
                }
            }
        }
    
    }
    
     //collect data from cart
    $sql = 'SELECT * FROM cart WHERE userId=:id';
    $statement = $con->prepare($sql);
    $statement->execute([':id' => $userId]);
    $product = $statement->fetchAll(PDO::FETCH_OBJ);
   // $subtotal =($product[$i]->productprice)*($product[$i]->quantity);
   // $Total=$subtotal+($product[$i]->productprice)*($product[$i]->quantity);  
    //echo $subtotal;
    //echo $Total;
 ?>
<!DOCTYPE html>
<html>
<head>
<title></title>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">


<!------ Include the above in your HEAD tag ---------->
</head>
<body>
    <div class="container">
    <table id="cart" class="table table-hover table-condensed">
                    <thead>
                        <tr>
                            <th style="width:50%">Product</th>
                            <th style="width:10%">Quantity</th>
                            <th style="width:10%">Price</th>
                           <th style="width:10%">Total</th>
                            <th style="width:10%">Action</th>
                            <!-- <th style="width:22%" class="text-center">Subtotal</th> -->
                            <th style="width:10%"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($product as $prods): ?>
                             <?php if(strlen($prods->cartStatus == "0")){  ?>
                        <tr>
                            <td data-th="Product">
                                <div class="row">
                                    <div class="col-sm-2 hidden-xs"><img src="<?= $prods->image; ?>" alt="..." class="img-responsive"/></div>
                                    <div class="col-sm-8">
                                        <h4 class="nomargin"><?= $prods->productname; ?></h4>
                                        <p>Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Lorem ipsum dolor sit amet.</p>
                                    </div>
                                </div>
                            </td>
                            <td class="col-sm-2"><?= $prods->quantity; ?></td>
                            <td data-th="Price">Rs:<?= $prods->productprice; ?></td>
                            
                            <td data-th="" class="text-center">
                                <?php
                                $subtotal=0;
                                $subtotal= ($prods->productprice)*($prods->quantity);
                                $Total=$Total+$subtotal;
                                echo $subtotal;
                                ?>
                            </td>
                            <td class="actions" data-th="">
                                <button class="btn btn-danger btn-sm"><a href="deletecart.php?id=<?= $prods->cartId; ?>"><i class="fa fa-trash-o" ></i></a></button>                           
                            </td>
                        </tr>
                         <?php }?>
                          <?php endforeach; ?>

                     
                    </tbody>
                    <tfoot>
                        <tr class="visible-xs">
                            <td class="text-center"><strong>
                             
                           
                            </strong></td>
                        </tr>
                        <tr>
                            <td><a href="productdisplay.php" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
                            <td colspan="2" class="hidden-xs"></td>
                            <td class="hidden-xs text-center"><strong>Total <?php echo $Total?></strong></td>
                            <td><a href="cheakout.php" class="btn btn-success btn-block">Checkout <i class="fa fa-angle-right"></i></a></td>
                        </tr>
                    </tfoot>
                </table>
</div>

</body>
</html>
</body>
</html>