<?php 
include 'connect.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD']=='POST') {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $sql = "INSERT INTO user (user_fname, user_lname, user_address,user_contact, user_uname, user_email, user_password, user_status) VALUES ('$fname','$lname', '$address', '$contact', '$username', '$email', '$password','Active')";

    $response = mysqli_query($conn, $sql);
    $result = array();
    if($response){
        $result['message'] = "success";
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