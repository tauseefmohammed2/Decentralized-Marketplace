<?php

$productName = $_REQUEST['pName'];
$productPrice = $_REQUEST['pTokens'];
$account = $_REQUEST['account'];
$date = $_REQUEST['date'];

$servername = "localhost";
$username = "root";
$password = "";
$dbName = "ecommerce";

// Create connection
$con = mysqli_connect($servername, $username, $password, $dbName);

// Check connection
if (!$con) {
	echo "Connection Falied";
  	die("Connection failed: " . mysqli_connect_error());
}

$sql_query = "SELECT MAX(ORDER_ID) FROM ORDERS";
$result = mysqli_query($con,$sql_query);
$row = mysqli_fetch_array($result);
$max_orderID = $row["MAX(ORDER_ID)"];

if($max_orderID == "" || is_null($max_orderID))
	$max_orderID = 1001;

else
	$max_orderID += 1;

$sql_query = "INSERT INTO ORDERS VALUES ('$max_orderID', '$productName', '$productPrice', '$account', '$date')";
$result = mysqli_query($con,$sql_query);

if(!$result)
	echo "Unable to Process Query";

else{
	$sql_query ="COMMIT";
	$result = mysqli_query($con,$sql_query);
}

echo $max_orderID;

?>