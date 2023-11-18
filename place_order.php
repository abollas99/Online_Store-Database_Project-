<?php
include "dbconfig.php";

$con = mysqli_connect($server, $login, $password, $dbname) 
      or die("<br>Cannot connect to DB:$dbname on $host\n");
$userCID = $_GET['cid'];
$userPID = $_GET['pid'];
$reqQty = $_GET['quantity'];

if(is_numeric($reqQty)){
    $query = "INSERT INTO Order_bollasa (order_datetime, order_qty, cid, pid) 
    VALUES (NOW(),$reqQty,$userCID, $userPID)";
    mysqli_query($con, $query);
} else {
    die('The order was not successful');
}



?>