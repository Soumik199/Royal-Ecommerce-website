<?php
$dbServerName="localhost";
$dbUserName="root";
$dbPassword="";
$dbName="phpproject";
try{
    $con=new PDO("mysql:host=$dbServerName;dbname=phpproject",$dbUserName,$dbPassword);
    echo "Database connected";//print data//
}
catch(PDOExpection $e){
    echo " connection failed ".$e->getMessage();
}

?>