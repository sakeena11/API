<?
include('db.php');
header('Access-Control-Allow-Origin: *');                 // Allow Access from any origin
header('Content-Type: application/json; charset=UTF-8');  // JSON payload (not HTML)

$work = $_GET['work'];
// echo "work " . $work;

$act = $_GET['act'];
$scene = $_GET['scene'];

if (isset($work)) {
    // echo "work " . $work;

    //WORK IS SET - echo scene 
    // echo "inside if<br>";
    // $sql = "SELECT * FROM `shakespeare_works` WHERE `work_id` = '$work'";

    $sql = "SELECT * FROM `shakespeare_scene_locations` WHERE `scene_work_id` = '$work'";
    // echo $sql;

    // $sql = "SELECT * FROM shakespeare_works JOIN shakespeare_scene_locations WHERE `work_id` = `scene_work_id`";

    //ACT & SCENE IS SET - echo scene 
    if (isset($work) && isset($act) && isset($scene)) {
        $sql = "SELECT * FROM shakespeare_works JOIN shakespeare_scene_locations WHERE `work_id` = `scene_work_id`";
        // $sql = "SELECT * FROM `shakespeare_scene_locations` WHERE `scene_work_id` = '$work'";
        // echo "act" . $sql;


    }

    // if (isset($scene)) {
    //     $sql = "SELECT * FROM shakespeare_works JOIN shakespeare_scene_locations WHERE `work_id` = `scene_work_id`";
    // }

    // $sql2 = "SELECT * FROM `shakespeare_scene_locations` WHERE `scene_work_id` = '12night'";
    //$sql = "SELECT * FROM `shakespeare_works`";
}
else {
    // NO WORK
    $sql = "SELECT * FROM `shakespeare_works`";
    // echo "no work" . $sql;

}

if (mysqli_connect_errno($con)) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
    $query=mysqli_query($con, $sql);
    echo "[";
    while($data = mysqli_fetch_array($query)){


        if (isset($work)){
            // echo " in line 55";

            $scene_id = $data['scene_id'];
            $scene_work_id = $data['scene_work_id'];
            $scene_act = $data['scene_act'];
            $scene_scene = $data['scene_scene'];
            $scene_location = $data['scene_location'];

            //echo response_scene($scene_id, $scene_work_id, $scene_act, $scene_scene, $scene_location);
            $json_outt .=  response_scene($scene_id, $scene_work_id, $scene_act, $scene_scene, $scene_location);
            
        }
        else{
            // echo " in line 66";

            $work_id = $data['work_id'];
            $work_title = $data['work_title'];
            $work_long_title = $data['work_long_title'];
            $work_year = $data['work_year'];
            $work_genre = $data['work_genre'];

            //echo response($work_id, $work_title, $work_long_title, $work_year, $work_genre);

            $json_outt .=  response($work_id, $work_title, $work_long_title, $work_year, $work_genre);
            
        }
    }
    echo substr_replace($json_outt ,"",-1);

    echo "]";

function response($work_id, $work_title, $work_long_title, $work_year, $work_genre){
	$response['work_id'] = $work_id;
	$response['work_title'] = $work_title;
	$response['work_long_title'] = $work_long_title;
	$response['work_year'] = $work_year;
    $response['work_genre'] = $work_genre;

	$json_response = json_encode($response);
    $json_output =  $json_response . ",";
	//echo $json_response;

    return $json_output;
}

function response_scene($scene_id, $scene_work_id, $scene_act, $scene_scene, $scene_location){
    $response_scene['scene_id'] = $scene_id;
    $response_scene['scene_work_id'] = $scene_work_id;
    $response_scene['scene_act'] = $scene_act;
    $response_scene['scene_scene'] = $scene_scene;
    $response_scene['scene_location'] = $scene_location;

    $json_response_scene = json_encode($response_scene);
    // echo $json_response_scene . ",";
    $json_output =  $json_response_scene . ",";
    //echo $json_output;
    //echo substr_replace($json_output ,"",-1);

    return $json_output;
}



?>


