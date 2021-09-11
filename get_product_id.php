<?php


header('Content-Type: application/json');
        require_once 'DB_Connect.php';
        // connecting to database
        $db = new Db_Connect();
        $con = $db->connect();


 date_default_timezone_set('Africa/Johannesburg');
        $hour=date("H:i:s");
        $date=date("d-m-Y");
         $server_ip="139.59.38.160";

if(!$con){
   echo "Could not connect to DBMS";       
 }else {
   if (isset($_POST['ID'])){


 
    $otp= $_POST['ID'];
   
    $otp=test_input($otp);



  $response = array("bookingservices"=>array());


$sql="SELECT `ID`,(SELECT `Name` FROM `menu_type` WHERE ID=f.IDMenu) AS `IDMenu`,(SELECT `Category` FROM `submenu` WHERE ID=f.IDMenu) AS `Submenu`,(SELECT Name FROM subsubmenu WHERE ID=f.IDSubmenu) AS `Subsubmenu`, `Name`, `Weight`, `Unit`, `Description`, `MRP`, `JalpanPrice`, `Discount`, `Photo`, `Photo1`, `Photo2`, `Photo3`,isOutOfStock, `Recomended`, `Popular`, `Rating`, `Available`, `User`, `Date`, `Time` FROM `foods` f WHERE `ID`='$otp'";
    


$result = $con->query($sql);


  while ($user = mysqli_fetch_assoc($result)) {

$jsonRow=array(
               "ID"=>$user['ID'],
                     "IDMenu"=>$user['IDMenu'],
                "Submenu"=>$user['Submenu'],
                
                "Name"=>$user['Name'],
                "Subsubmenu"=>$user['Subsubmenu'],
                     
                "Weight"=>$user['Weight'],
                           "Unit"=>$user['Unit'],

                                      "Photo"=>'http://' . $server_ip . '/' . 'IziGourmet'.'/'.'Dashboard'.'/'.'products'. '/'.$user['Photo'],
                                        "Photo1"=>$user['Photo1'],
                                          "Photo2"=>$user['Photo2'],
                                            "Photo3"=>$user['Photo3'],
          
                "Description"=>$user['Description'],  
                       
                "MRP"=>$user['MRP'],
                           "JalpanPrice"=>$user['JalpanPrice'],
                "Discount"=>$user['Discount'],
                        "Unit"=>$user['Unit'], 
                            "isOutOfStock"=>$user['isOutOfStock'],    
             );


array_push($response["bookingservices"], $jsonRow);


}








}

 echo json_encode($response);


}


 

 
 function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}     



?>