<html>
<body>

<?php

$dbname = 'vsms_db';
$dbuser = 'root';  
$dbpass = ''; 
$dbhost = 'localhost'; 

$connect = @mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

if(!$connect){
	echo "Error: " . mysqli_connect_error();
	exit();
}

echo "Connection Success!<br><br>";

$temperature = $_GET["temperatureC"];




$query = "INSERT INTO vitalsigns (temperature) VALUES ('$temperature')";
$result = mysqli_query($connect,$query);

echo "Insertion Success!<br>";

?>
</body>
</html>/