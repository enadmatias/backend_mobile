<?php 
include 'connect.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD']=='POST') {
    $id = $_POST['ID'];
    $fname = $_POST['FNAME'];
    $lname = $_POST['LNAME'];
    $address = $_POST['ADDRESS'];
    $contact = $_POST['CONTACT'];
    $email = $_POST['EMAIL'];
    $username = $_POST['USERNAME'];
    $name = $_POST['NAME'];
    $photo = $_POST['PHOTO'];

    $path = "uploads/$name.png";
    $actualpath = "http://10.0.2.2:8080/dbproject/$path";
    $sql = "UPDATE user SET user_fname = '$fname' , user_lname = '$lname', user_address = '$address', user_contact='$contact', user_email = '$email', user_photo = '$actualpath' WHERE id= $id";

    $response = mysqli_query($conn, $sql);
    $result = array();
    $result  ['data'] = array();
    if($response){
     file_put_contents($path,base64_decode($photo));
     $sql1 = "SELECT * FROM user WHERE  id = $id";
     $request = mysqli_query($conn, $sql1);
     if($data = mysqli_fetch_assoc($request)){
        
        $index['fname'] =  $data['user_fname'];
        $index['lname'] = $data['user_lname'];
        $index['address'] = $data['user_address'];
        $index['contact'] = $data['user_contact'];
        $index['username'] = $data['user_uname'];
        $index['image'] = $data['user_photo'];
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