<?php
include "dbconfig.php";


$con = mysqli_connect($server, $login, $password, $dbname) 
      or die("<br>Cannot connect to DB:$dbname on $host\n");
if (isset($_POST['username']))
    $browser_username=$_POST['username'];
else
	die();
$browser_password=$_POST['password'];
$sql="select * from CPS3740.Customers where login='$browser_username' ";

$result = mysqli_query($con, $sql); 

//echo "<br>SQL: $sql\n";


if ($result) {
	if (mysqli_num_rows($result)>0) {
		$row = mysqli_fetch_array($result);
		$user_password=$row['password'];
		if ($browser_password==$user_password) {
			$user_name=$row['name'];
            $user_gender=$row['gender'];
            $user_img=$row['img'];
            $user_DOB=$row['DOB'];
            $user_street=$row['street'];
            $user_city=$row['city'];
            $user_state=$row['state'];
            $user_zip=$row['zipcode'];
            $birth = new DateTime($user_DOB);
            $current = new DateTime();
            $ageInterval = $birth->diff($current);           
            $user_age=$ageInterval->y;
            $user_ip=$_SERVER['REMOTE_ADDR'];
            setcookie("Login",$browser_username,time()+3600);
            echo "$user_ip";
            $ip_num = ip2long($user_ip);
            $range1_start = ip2long('10.0.0.0');
            $range1_end = ip2long('10.255.255.255');
            $range2_start = ip2long('131.125.0.0');
            $range2_end = ip2long('131.125.255.255');
            if (($ip_num >= $range1_start && $ip_num <= $range1_end) || ($ip_num >= $range2_start && $ip_num <= $range2_end)) {
                echo "<br>You are in Kean Domain";
            } else {
                echo "<br>You are not within the Kean Domain";
            }
			echo "<br>Welcome $user_name";
            echo "<br>Gender: $user_gender";
            echo "<br>DOB: $user_DOB, age: $user_age";
            echo "<br>Address: $user_street, $user_city, $user_state, $user_zip";
            echo '<br><img src="data:image/jpeg;base64,' . base64_encode($user_img) . '">';
            echo '<br><a href="">Logout</a><br><a href="order_product.php">Order Product</a><br><a href=>view, change, or cancle my order history</a>';
		} else {
			die("Login $browser_username exists, but password does not match");
		}
	}
	else
		echo "<br>Login $browser_username doesn't exist in the database\n";
}
else {
  echo "Something is wrong with SQL:" . mysqli_error($con);	
}
mysqli_free_result($result);
mysqli_close($con);
?>
