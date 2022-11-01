<?
include('db.php');
header('Access-Control-Allow-Origin: *');                 // Allow Access from any origin
header('Content-Type: application/json; charset=UTF-8');  // JSON payload (not HTML)

// echo $work_id;

$work = $_GET['work'];

if (isset($work)) {
    // echo "inside if<br>";
    $sql = "SELECT * FROM `shakespeare_works` WHERE `work_id` = '$work'";
    //$sql = "SELECT * FROM `shakespeare_works`";
}
else
{
    $sql = "SELECT * FROM `shakespeare_works`";
}

//echo "sql ". $sql;
//echo "<br>";

// $result = mysqli_query($mysqli,$sql);
// echo "result ". $result;

// if(mysqli_num_rows($result)>0){
//     // echo "<br>there are results<br>";
//     $row = mysqli_fetch_array($result);
//     $work_id = $row['work_id'];
//     $work_long_title = $row['work_long_title'];
//     $work_year = $row['work_year'];
//     $work_genre = $row['work_genre'];
//     response($work_id, $work_title, $work_long_title, $work_year, $work_genre);
//     mysqli_close($mysqli);
// }
// else
// {
//     echo "no results<br>";
// }


// $con=mysqli_connect("example.com","alex","qwerty","db_name");
    
// Check connection
if (mysqli_connect_errno($con)) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

    $query=mysqli_query($con, $sql);
    while($data = mysqli_fetch_array($query)){
        // echo $data["work_year"]."<br>";
        $work_id = $data['work_id'];
        $work_long_title = $data['work_long_title'];
        $work_year = $data['work_year'];
        $work_genre = $data['work_genre'];
        response($work_id, $work_title, $work_long_title, $work_year, $work_genre);
    }

function response($work_id, $work_title, $work_long_title, $work_year, $work_genre){
	$response['work_id'] = $work_id;
	$response['work_title'] = $amount;
	$response['work_long_title'] = $work_long_title;
	$response['work_year'] = $work_year;
    $response['work_genre'] = $work_genre;

	$json_response = json_encode($response);
	echo $json_response;
}

?>


