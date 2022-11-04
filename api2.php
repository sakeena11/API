<?
// include('db.php');
require 'init.php';
header('Access-Control-Allow-Origin: *');                 // Allow Access from any origin
header('Content-Type: application/json; charset=UTF-8');  // JSON payload (not HTML)

$work = $_GET['work'];
$scene = $_GET['scene'];
$act = $_GET['act'];

echo "--work " . $work . "--- <br>";
echo "<br>";
echo "scene " . $scene . "--- <br>";
echo "<br>";
echo "act " . $act . "--- <br>";

//ACT & SCENE IS SET 
if (isset($work) && isset($scene) && isset($act) ) {
    // $sql = "SELECT * FROM shakespeare_paragraphs JOIN shakespeare_scene_locations WHERE `work_id` = `scene_work_id`";
    // $sql = "SELECT * FROM shakespeare_paragraphs JOIN shakespeare_scene_locations ON par_work_id = scene_par_id WHERE par_work_id = $work";

    $sql = "SELECT * FROM shakespeare_paragraphs INNER JOIN shakespeare_scene_locations ON scene_work_id = par_work_id AND scene_act = par_act AND scene_scene = par_scene WHERE par_work_id = '$work' AND par_act = '$act' AND par_scene = '$scene' order by `par_number` ASC";

    echo $sql;

    // scene and act ids are also the same 

    // $sql = "SELECT * FROM `shakespeare_scene_locations` WHERE `scene_work_id` = '$work'";
}

//WORK IS SET 
else if (isset($work)) {
    $sql = "SELECT * FROM `shakespeare_scene_locations` WHERE `scene_work_id` = '$work'";
}
else {
    // NO WORK
    $sql = "SELECT * FROM `shakespeare_works`";
}

if (mysqli_connect_errno($mysqli)) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
    $query=mysqli_query($mysqli, $sql);

    // OPENING
    if (isset($work) && isset($scene) && isset($act) ) {
        //echo "{";
    }
    else {
        echo "[";
    }

    //echo "LINE 44";

    if (isset($act)) {
        //echo "{";
            // para_output .= "paragraphs\": [';
    }
    
    // $para_arr = array(
    //     "scene_location:"=>"xxx", 
    //     "paragraphs:" => 
    //     array("3","xxx","Enter"),
    //     array("3","xxx","Enter"),
    //     array("3","xxx","Enter"),
    //     array("3","xxx","Enter")
    
    // );

    // $para_arr = array(
    //     "scene_location:"=>"".$scene_var, 
    //     "paragraphs:" => "". $arrays_details
    
    // );

    while($data = mysqli_fetch_array($query)){

      //  echo "LINE 48";

        // if (isset($work) && isset($act) && isset($scene)) {
        if (isset($act)) {

            // echo "LINE 53";

            $scene_location = $data['scene_location'];
            // $par_id = $data['par_id'];
            // $par_act = $data['par_act'];
            // $par_scene = $data['par_scene'];
            $par_number = $data['par_number'];
            $par_char_id = $data['par_char_id'];
            $par_text = $data['par_text'];

            // echo "par_number " . $par_number;
            // echo "par_char_id " . $par_char_id;
            //echo "par_text " . $par_text;

            //echo response_para($scene_location, $par_id, $par_act, $par_scene, $par_number, $par_char_id, $par_text);
            // $json_outt .=  response_para($scene_location, $par_id, $par_act, $par_scene, $par_number, $par_char_id, $par_text);
            //$json_outt .=  response_para($scene_location, $par_number, $par_char_id, $par_text);

            // ----$json_outt_arr .= array($par_number,$par_char_id,$par_text) .",";
            //$json_outt_arr .= "array(" . $par_number,$par_char_id,$par_text . "),";
            
            
            $json_outt_arr .=  response_para($par_number, $par_char_id, $par_text);
        }

        else if (isset($work)){
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

    // echo "===";
    // echo $json_outt_arr;
    // echo "===";

    $json_outt_arr2 = substr_replace($json_outt_arr ,"",-1); 
    
    //echo $json_outt_arr2;

    // $para_arr = array(
    //     "scene_location:"=> $scene_location, 
    //     "paragraphs:" =>  array( $json_outt_arr2)
    
    // );

    $para_arr = array("scene_location:"=> $scene_location, "paragraphs:" =>  array( $json_outt_arr2));

    // echo substr_replace($json_outt ,"",-1);

    // CLOSING 
    //echo "]";
    if (isset($act)) {
        //echo "}";
        
        echo json_encode($para_arr);
        //echo $para_arr;
    }
    else {
        echo substr_replace($json_outt ,"",-1);
        echo "]";
    }

    // $json_outt_arr .=  response_para($par_number, $par_char_id, $par_text);

    function response_para($par_number, $par_char_id, $par_text){

        //$json_outt_arr .= array($par_number,$par_char_id,$par_text) .",";

        $response_para =  array($par_number,$par_char_id,$par_text);

        // $response_para['scene_location'] = $scene_location;
        // // $response_para['par_number'] = $par_number;
        // $response_para[''] = $par_number;
        // // $response_para['par_char_id'] = $par_char_id;
        // $response_para[''] = $par_char_id;
        // // $response_para['par_text'] = $par_text;
        // $response_para[''] = $par_text;

        //$json_response = json_encode($response_para);

        $json_response = json_encode($response_para);
        
        // $json_response = $response_para;
        $json_output =  $json_response . ",";
        // //echo $json_response;


    
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

?>


