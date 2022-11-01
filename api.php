<?
include('db.php');
header('Access-Control-Allow-Origin: *');                 // Allow Access from any origin
header('Content-Type: application/json; charset=UTF-8');  // JSON payload (not HTML)

$work = $_GET['work'];
$act = $_GET['act'];
$scene = $_GET['scene'];

if (isset($work)) {
    // echo "inside if<br>";
    // $sql = "SELECT * FROM `shakespeare_works` WHERE `work_id` = '$work'";
    $sql = "SELECT * FROM shakespeare_works JOIN shakespeare_scene_locations WHERE `work_id` = `scene_work_id`";

    if (isset($act)) {
        $sql = "SELECT * FROM shakespeare_works JOIN shakespeare_scene_locations WHERE `work_id` = `scene_work_id`";
    }

    if (isset($scene)) {
        $sql = "SELECT * FROM shakespeare_works JOIN shakespeare_scene_locations WHERE `work_id` = `scene_work_id`";
    }

    // $sql2 = "SELECT * FROM `shakespeare_scene_locations` WHERE `scene_work_id` = '12night'";
    //$sql = "SELECT * FROM `shakespeare_works`";
}
else {
    // NO WORK
    $sql = "SELECT * FROM `shakespeare_works`";
}

if (mysqli_connect_errno($con)) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
    $query=mysqli_query($con, $sql);
    while($data = mysqli_fetch_array($query)){
        $work_id = $data['work_id'];
        $work_title = $data['work_title'];
        $work_long_title = $data['work_long_title'];
        $work_year = $data['work_year'];
        $work_genre = $data['work_genre'];
        response($work_id, $work_title, $work_long_title, $work_year, $work_genre);
    }

function response($work_id, $work_title, $work_long_title, $work_year, $work_genre){
	$response['work_id'] = $work_id;
	$response['work_title'] = $work_title;
	$response['work_long_title'] = $work_long_title;
	$response['work_year'] = $work_year;
    $response['work_genre'] = $work_genre;

	$json_response = json_encode($response);
	echo $json_response;
}



?>


