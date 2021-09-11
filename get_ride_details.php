<?php


header('Content-Type: application/json');
        require_once 'DB_Connect.php';
        // connecting to database
        $db = new Db_Connect();
        $conn = $db->connect();

 
if(!$conn){
   echo "Could not connect to DBMS"; 
    }else { 

if (isset($_POST['Unique_Ride_Code'])){
 
        $Unique_Ride_Code= $_POST['Unique_Ride_Code'];
   

       $Unique_Ride_Code=test_input($Unique_Ride_Code);



try{
$server_ip="139.59.38.160";
  $response = array("Book_Ride_Now"=>array());

  $Book_Ride_Now=$conn->query("SELECT t.Distance,t.Name AS SName, t.Phone_No, t.Address, t.Latitude, t.Longitude,b.Type,b.PaymentMode,b.ID, b.OTP, b.Unique_Ride_Code,b.Cost, b.From_Latitude, b.From_Longitude,COUNT(s.NoofItems) AS CountNoofItems,NoofItems,f.Name,b.To_Latitude,b.To_Longitude,b.Is_Running FROM `book_ride` b INNER JOIN store_order s ON s.UserID=b.User_ID AND s.OrderID=b.OTP INNER JOIN foods f ON f.ID=s.FoodID INNER JOIN tez_Canteen t ON t.ID=s.CanteenID WHERE  b.Unique_Ride_Code ='$Unique_Ride_Code'  ");

  while ($user1 = mysqli_fetch_assoc($Book_Ride_Now)) {
 $jsonRow_201=array(
           
  "ID"=>$user1["ID" ],
  "OTP"=>$user1["OTP"],
  "Unique_Ride_Code"=>$user1["Unique_Ride_Code"],
  "From_Latitude"=>$user1["From_Latitude"],
  "From_Longitude"=>$user1["From_Longitude"],
   "To_Latitude"=>$user1["To_Latitude" ],
     "To_Longitude"=>$user1["To_Longitude"],
     "Is_Running"=>$user1["Is_Running"],
   "Cost"=>$user1["Cost"],
      "CountNoofItems"=>$user1["CountNoofItems"],
          "PaymentMode"=>$user1["PaymentMode"],
              "Type"=>$user1["Type"],
      "SName"=>$user1["SName"],
     "Phone_No"=>$user1["Phone_No"],
   "Address"=>$user1["Address"],
      "Latitude"=>$user1["Latitude"],
          "Longitude"=>$user1["Longitude"],
      "Distance"=>$user1["Distance"],
             );
array_push($response["Book_Ride_Now"], $jsonRow_201);
  
}

   echo json_encode($response);    

} catch(Error $e) {
    $trace = $e->getTrace();
    echo $e->getMessage().' in '.$e->getFile().' on line '.$e->getLine().' called from '.$trace[0]['file'].' on line '.$trace[0]['line'];
}

}
}
 
    
 
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>