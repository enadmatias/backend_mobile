<?php 
include 'connect.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD']=='POST') {
    $id = $_POST['id'];
    $selectedType = $_POST['selectedType']; 
    $schoolName = $_POST['schoolName'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $purpose = $_POST['purpose'];
    $image = $_POST['image'];
    $name = $_POST['name'];
    $validId = $_POST['validId'];
    $path = "uploads/$name.png";
    $result = array();
    $result['data'] = array();
    $actualpath = "http://10.0.2.2:8080/dbproject/$path";
     
     $sql = "INSERT INTO record(user_id,visitor_type,visitor_school,date,time,visitor_purpose,visitor_image,visitor_id,visitor_status) values('$id','$selectedType','$schoolName','$date','$time','$purpose','$actualpath','$validId','Pending')";

     $response = mysqli_query($conn, $sql);
     

     if($response){
         file_put_contents($path,base64_decode($image));
         $last_id = mysqli_insert_id($conn);
         $sql1 = "SELECT * FROM record WHERE  record_id = $last_id";
         $request = mysqli_query($conn, $sql1);
         if($data = mysqli_fetch_assoc($request)){
            $index['record_id'] = $data['record_id'];
            $index['date'] = $data['date'];
            $index['time'] = $data['time'];
            array_push($result['data'], $index);
            $result['message'] = "success";
            echo json_encode($result);

            mysqli_close($conn);
         }
     }
     else{
        $result['message'] = "failed";
        echo json_encode($result);

         mysqli_close($conn);
     }

}

?>