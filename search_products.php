<?php
include "dbconfig.php";


$con = mysqli_connect($host, $username, $password, $dbname) 
  or die("<br>Cannot connect to DB:$dbname on $host\n");


$keywords=$_GET['keyword'];


$sql ="SELECT * from dreamhome.Staff where fname like '%$keywords%' ";
echo "<br>SQL: $sql\n";
$result = mysqli_query($con, $sql); 


if ($result) {
   if (mysqli_num_rows($result) ==0) {
      echo "<br>No record found.\n";
   } else {
		if($result) {
			echo "<TABLE border=1>\n";
			echo "<TR><TH>fname<TH>lname<TH>salary\n";
		    while($row = mysqli_fetch_array($result))
		    {
		        $fname = $row["fName"];
		        $lname = $row["lName"];
		        $salary = $row["salary"];
		        echo "<TR><TD>$fname<TD>$lname<TD>$salary\n";
		    }
		    echo "</TABLE>\n";
		}
   }
} else {
   echo "<br>Something wrong. Error: " . mysqli_error($con);
}


mysqli_free_result($result);
mysqli_close($con); 


?>
