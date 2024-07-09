<?php 
include 'config.php';
$con=mysqli_connect($dbServer,$dbUsername,$dbPassword,$dbDatabase);
if (mysqli_connect_errno()) {
	# code...
	echo "problem connectiong to database because: ".mysqli_connect_error();
}


 ?>