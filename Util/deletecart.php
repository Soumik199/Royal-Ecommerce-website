<?php
require 'database.php';
$cartId = $_GET['cartId'];
$sql = 'DELETE FROM cart WHERE cartId=:cartId';
$statement = $con->prepare($sql);
if ($statement->execute([':cartId' => $cartId])) {
  header("Location: productdisplay.php");
}
