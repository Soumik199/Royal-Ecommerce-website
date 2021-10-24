<?php
require '../util/database.php';
$productid = $_GET['productid'];
$sql = 'DELETE FROM product WHERE productid=:productid';
$statement = $con->prepare($sql);
if ($statement->execute([':productid' => $productid])) {
  header("Location: ../util/productdisplay.php");
}



