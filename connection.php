<?php





$dbhost = 'localhost';



$dbuser = 'singupc1_sms';



$dbpass = '@$-b[S_cT;xr';



$dbname = 'singupc1_twilio_sms';

$con= new mysqli($dbhost, $dbuser, $dbpass,$dbname);

$a = mysqli_query($con,"SHOW TABLES FROM $dbname");



$tables = '';



if ($con->connect_error) {

    die("Connection failed: " . $conn->connect_error);

} 

?>