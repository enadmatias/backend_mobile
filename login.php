
<?php 
include 'connect.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD']=='POST') {
   $name = $_POST['name'];
   $pwd = md5($_POST['pwd']);

   $sql = "SELECT * FROM user WHERE user_uname = '$name' && user_password = '$pwd' ";
   $response = mysqli_query($conn, $sql);
   $result = array();
   $result['login'] = array();


    if($row = mysqli_fetch_assoc($response)){
        $index['id'] = $row['id'];
        $index['username'] = $row['user_uname'];
        $index['password'] = $row['user_password'];
        $index['fname'] = $row['user_fname'];
        $index['lname'] = $row['user_lname'];
        $index['contact'] = $row['user_contact'];
        $index['address']  = $row['user_address'];
        $index['email'] = $row['user_email'];
        $index['path'] = $row['user_photo'];
        array_push($result['login'], $index);

        $result['success'] = "1";
        $result['message'] = "success";
        echo json_encode($result);

         mysqli_close($conn);
          
    }
    else{
        $result['success'] = "0";
        $result['message'] = "error";
        echo json_encode($result);

        mysqli_close($conn);


    }


}

?>