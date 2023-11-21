<?php
include "dbconfig.php";

$con = mysqli_connect($server, $login, $password, $dbname) 
      or die("<br>Cannot connect to DB:$dbname on $host\n");

$query = "select * from CPS3740.Products"; 
$result = mysqli_query($con, $query);
if($result){
    $userCID = $_GET['cid'];
    echo '<table border="1">';
    echo '<tr><th>Product ID</th>
    <th>Name</th>
    <th>Price</th>
    <th>Available Quantity</th>
    <th>Vendor ID</th>
    <th>Quantity to Order</th></tr>';

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['P_Id'] . '</td>';
        echo '<td>' . $row['Name'] . '</td>';
        echo '<td> $' . $row['Price'] . '</td>';
        echo '<td>' . $row['Quantity'] . '</td>';
        echo '<td>' . $row['V_Id'] . '</td>';
        echo '<td><form action="place_order.php" method="get">
        <input type="hidden" name="cid" value="' . $userCID . '">
        <input type="hidden" name="pid" value="' . $row['P_Id'] . '">
        <input type="text" name="pid_order_qty"> 
        <input type="submit" value="Place Order"> </form></td>';
        echo '</tr>';
    }
} else {
    echo "Issue with database.";
}
mysqli_close($con);
?>





