<?
define('DB_SERVER','localhost');
define('DB_USERNAME','csci488_fall22');
define('DB_PASSWORD','db_fun_2022');
define('DB_DATABASE','csci488_fall22');

// $connect = mysqli_connect("localhost","root","","allphptricks");
//     if (mysqli_connect_errno()){
// 	echo "Failed to connect to MySQL: " . mysqli_connect_error();
// 	die();
// 	}

$con = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
if ($con->connect_errno) {
    // echo "\n Failed to connect to MySQL: (" . $con->connect_errno . ") " . $con->connect_error;
    exit;
}
else    
{
    // echo "connected<br>";
}
?>