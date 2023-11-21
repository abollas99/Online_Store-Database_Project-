<?php
include "dbconfig.php";

$con = mysqli_connect($server, $login, $password, $dbname) 
      or die("<br>Cannot connect to DB:$dbname on $host\n");

$keywords=$_GET['myproduct'];


$sql ="SELECT * from CPS3740.Products where Name like '%$keywords%' ";
$sqlAll = "SELECT * from CPS3740.Products";

if($keywords == '*'){
	$result = mysqli_query($con, $sqlAll);
    if ($result) {
		echo '<table border="1">';
		echo '<tr><th>Product ID</th>
			<th>Product Name</th>
			<th>Price</th>
			<th>Quantity</th>
			<th>Vendor ID</th></tr>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['P_Id'] . '</td>';
            echo '<td>' . $row['Name'] . '</td>';
            echo '<td>' . $row['Price'] . '</td>';
            echo '<td>' . $row['Quantity'] . '</td>';
            echo '<td>' . $row['V_Id'] . '</td>';
            echo '</tr>';
        }
    }
} else {
	$result = mysqli_query($con, $sql);
    if ($result && mysqli_num_rows($result) != 0) {
		echo '<table border="1">';
		echo '<tr><th>Product ID</th>
			<th>Product Name</th>
			<th>Price</th>
			<th>Quantity</th>
			<th>Vendor ID</th></tr>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['P_Id'] . '</td>';
            echo '<td>' . $row['Name'] . '</td>';
            echo '<td>' . $row['Price'] . '</td>';
            echo '<td>' . $row['Quantity'] . '</td>';
            echo '<td>' . $row['V_Id'] . '</td>';
            echo '</tr>';
        }
	}
}



mysqli_free_result($result);
mysqli_close($con); 
?>
