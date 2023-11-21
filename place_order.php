<?php
include "dbconfig.php";

try {
    $con = mysqli_connect($server, $login, $password, $dbname) 
        or die("<br>Cannot connect to DB:$dbname on $host\n");
    $userCID = $_GET['cid'];
    $userPID = $_GET['pid'];
    $reqQty = $_GET['pid_order_qty'];
    $sqlCheck = "select Quantity from CPS3740.Products where P_Id = $userPID";
    $query = "INSERT INTO Order_bollasa (order_datetime, order_qty, cid, pid) 
    VALUES (NOW(),$reqQty,$userCID, $userPID)";
    $resultCheck = mysqli_query($con, $sqlCheck);
    if($resultCheck){
    $row = mysqli_fetch_assoc($resultCheck);
    if(isset($row['Quantity'])){
        if(ctype_digit($reqQty) && $reqQty >= 1){
            if($reqQty <= $row['Quantity']){
                $resultInsert = mysqli_query($con, $query);
                if ($resultInsert){
                    echo "Order Successfully Placed!";
                } else {
                    echo "Unable to place Order.";
                }
            } else {
                echo 'You requested '.$reqQty.', but we only have '.$row['Quantity'];
            }
        } else {
            echo "That is not an integer greater than zero";
        }
    } else {
        echo "Issue Finding Product.";
    }
    } else {
    echo "Issue Finding Product.";
    }
    mysqli_close($con);
} catch (Exception $e) {
    echo "There was an error. The record was not inserted.";
}

?>