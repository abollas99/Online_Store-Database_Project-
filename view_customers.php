<?php
include "dbconfig.php";

$con = mysqli_connect($server, $login, $password, $dbname) 
      or die("<br>Cannot connect to DB:$dbname on $host\n");

$query = "select * from CPS3740.Customers"; 
$result = mysqli_query($con, $query);
if($result){
    echo '<table border="1">';
    echo '<tr><th>Customer ID</th>
    <th>Customer Name</th>
    <th>Date of Birth</th>
    <th>Gender</th>
    <th>City</th></tr>';

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['id'] . '</td>';
        echo '<td>' . $row['name'] . '</td>';
        echo '<td>' . $row['DOB'] . '</td>';
        echo '<td>' . $row['gender'] . '</td>';
        echo '<td>' . $row['city'] . '</td>';
        echo '</tr>';
    }
} else {
    echo "Issue with database.";
}
mysqli_close($con);
?>