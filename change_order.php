<?php
include "dbconfig.php";

$con = mysqli_connect($server, $login, $password, $dbname) 
      or die("<br>Cannot connect to DB:$dbname on $host\n");

$userCID = $_GET['cid'];
$userPID = $_GET['pid'];
$userOID = $_GET['oid'];
$reqQty = $_GET['new_qty'];

$sqlLogon = "SELECT ob.cid, p.Quantity FROM Order_bollasa ob 
JOIN CPS3740.Products p ON ob.pid = p.P_Id Where ob.pid = $userPID AND ob.cid = $userCID";
$sqlChange ="UPDATE Order_bollasa SET order_qty = $reqQty, order_datetime = NOW() WHERE oid = $userOID AND cid = $userCID";

$logonResult = mysqli_query($con, $sqlLogon);
if($logonResult){
    $row = mysqli_fetch_assoc($logonResult);
    if(isset($row['cid'],$row['Quantity'])){
        if($row['cid'] == $userCID){
            if(ctype_digit($reqQty) && $reqQty <= $row['Quantity'] && $reqQty > 0){
                $result = mysqli_query($con, $sqlChange);
                if($result){
                    echo 'Successfully Changed Order Quantity';
                } else {
                    echo 'Order Change unsuccessful.';
                }
            } else {
                echo 'What you have entered is not an integer that is greater than one and lower than the available quantity.';
            }
        } else {
            echo 'Your customer ID is not tied to this order.';
        }
    } else {
        echo 'Issue with Product ID.';
    }
} else {
    echo 'Issue verifying that this is your order.';
}
mysqli_close($con);
?>