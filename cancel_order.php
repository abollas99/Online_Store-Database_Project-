<?php
include "dbconfig.php";

$con = mysqli_connect($server, $login, $password, $dbname) 
      or die("<br>Cannot connect to DB:$dbname on $host\n");

$userCID = $_GET['cid'];
$userOID = $_GET['oid'];
$sql = "DELETE FROM Order_bollasa WHERE oid = $userOID";
$sqlCheck = "SELECT cid FROM Order_bollasa where oid = $userOID";
$checkResult = mysqli_query($con, $sqlCheck);

if($checkResult){
    $row = mysqli_fetch_assoc($checkResult);
    if(isset($row['cid'])){
        $result = mysqli_query($con, $sql);
        if($result){
            if($row['cid'] == $userCID){
                echo "Order $userOID was successfully removed.";
            } else {
                echo "Your Customer ID is not tied to this order.";
            }
        } else {
            echo "Cannot find the Order.";
        }
    } else {
        echo "Cannot find the Order.";
    }
} else {
    echo "Cannot find the Order.";
}
mysqli_close($con);
?>
