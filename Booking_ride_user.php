<?php
 header('Content-Type: application/json');


require_once 'DB_Functions.php';
$db = new DB_Functions();
 
// json response array
$response = array("error" => FALSE);
 
 
 //var_dump($_POST);
if (isset($_POST['mobile']) &&isset($_POST['address']) && isset($_POST['data'])&& isset($_POST['total'])){
 
    // receiving the post params
    $mobile =$_POST['mobile'];
    $address =$_POST['address'];
    $from_lat=$_POST['from_lat'];
    $from_long=$_POST['from_long'];
    $total = isset($_POST['total']) ? $_POST['total'] : '';
    $gross=isset($_POST['gross']) ? $_POST['gross'] : '';

    $data=isset($_POST['data']) ? $_POST['data'] : '';
 
    $data=test_input($data);
    $mobile=test_input($mobile);
    $address=test_input($address);
    $from_lat=test_input($from_lat);
    $from_long=test_input($from_long);
    $gross=test_input($gross);
    $total=test_input($total);
            $canteen =$_POST['canteen']; 
             $canteen=test_input($canteen);  

                 $ride =$_POST['ride']; 
             $ride=test_input($ride);  
       
        $user = $db->book_ride($mobile,$address,$from_lat,$from_long,$total,$gross,$data,$canteen,$ride);

        if ($user) {
            // user stored successfully
            $response["error"] = FALSE;
            $response["user"]["unique_id"]=$user["Unique_Ride_Code"];
              $response["user"]["OTP"]=$user["OTP"];
                   $response["user"]["ID"]=$user["ID"];
            echo json_encode($response);
        } else {
            // user failed to store
            $response["error"] = TRUE;
            echo json_encode($response);
        }
    
} else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters missing!";
    echo json_encode($response);
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>