<?php 
include 'connect.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD']=='POST') {
     $id = $_POST['ID'];

    $sql = "SELECT * FROM record WHERE visitor_status = 'Accepted' && user_id = $id ";
   
    $response = mysqli_query($conn, $sql);
    $result = array();
    $result['data'] = array();
if(mysqli_num_rows($response) >0){
    while($row = mysqli_fetch_assoc($response)){
        $index['record_id'] = $row['record_id'];
        $index['purpose'] = $row['visitor_purpose'];
        $index['date'] = $row['date'];
        $index['time'] = $row['time'];
        $index['status'] = $row['visitor_status'];
        array_push($result['data'], $index);
        $result['message'] = "success";
        
    }
    echo json_encode($result);
    mysqli_close($conn);
  }
  else{
    $result['message'] = "failed";
    echo json_encode($result);
    mysqli_close($conn);
  }
  

}
?>