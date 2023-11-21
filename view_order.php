<?php
include "dbconfig.php";

$con = mysqli_connect($server, $login, $password, $dbname) 
      or die("<br>Cannot connect to DB:$dbname on $host\n");

$userCID = $_GET['cid'];
$sql = "SELECT ob.oid, p.name, p.price, p.Quantity, ob.order_qty, p.V_Id, ob.order_datetime, p.P_Id
FROM Order_bollasa ob 
JOIN CPS3740.Products p ON ob.pid = p.P_Id
WHERE ob.cid = $userCID
ORDER BY ob.oid";

$result = mysqli_query($con, $sql);
if($result){
    echo '<table border="1">';
    echo '<tr><th>Order ID</th>';
    echo '<th>Product Name</th>';
    echo '<th>Price</th>';
    echo '<th>Available Quantity</th>';
    echo '<th>Order Quantity</th>';
    echo '<th>Vendor ID</th>';
    echo '<th>Date Time</th>';
    echo '<th>Action</th></tr>';

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['oid'] . '</td>';
        echo '<td>' . $row['name'] . '</td>';
        echo '<td>$' . $row['price'] . '</td>';
        echo '<td>' . $row['Quantity'] . '</td>';
        echo '<td>' . $row['order_qty'] . '</td>';
        echo '<td>' . $row['V_Id'] . '</td>';
        echo '<td>' . $row['order_datetime'] . '</td>';
        echo '<td><a href="cancel_order.php?cid='.$userCID.' &oid='.$row['oid'].'">Cancel Order</a>
        <form action="change_order.php" method="get">
        <input type="text" name="new_qty"> 
        <input type="hidden" name="cid" value="' . $userCID . '">
        <input type="hidden" name="pid" value="' . $row['P_Id'] . '">
        <input type="hidden" name="oid" value="' . $row['oid'] . '">
        <input type="submit" value="Change Order"> </form></td></tr>';
    }
} else {
    echo "Database error";
}
mysqli_close($con);
?>