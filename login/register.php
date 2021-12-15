<?php

$user = $_POST['user'];
$email  = $_POST['email'];
$password = $_POST['password'];
$retypepassword= $_POST['retypepassword'];




// if (!empty($user) || !empty($email) || !empty($password) || !empty($upswd2) )
// {

// $host = "localhost";
// $dbusername = "root";
// $dbpassword = "";
// $dbname = "project";

$error=false;
// $errormessage = array();
$errmsg = "";

if($user == ""){
    // $errormessage[0] = "Name is empty";
    $errmsg = "Name is empty";
    $error = true;
}
if($email == ""){
    // $errormessage[1] = "Email is empty";
    $errmsg = $errmsg . "<br>Email is empty";
    $error = true;
}
if($password == ""){
  // $errormessage[1] = "Email is empty";
  $errmsg = $errmsg . "<br>password is empty";
  $error = true;
}
if($retypepassword == "" || $retypepassword == $password ){
  // $errormessage[1] = "Email is empty";
  $errmsg = $errmsg . "<br>password is not matched";
  $error = true;
}


//if($error == true)
if($error){
    $data = array(
        'status' => 'failed',
        'message' => $errmsg
    );
}else{

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
// if ($username == "" || $password == "" ){
//     echo "Error: " . $sql . "<br>" . mysqli_error($conn);
// }
else
{
  $sql = "INSERT INTO `register` (`id`,`user`,`email`, `password`,`retypepassword`)
VALUES (NULL,'$user',`$email`, '$password',`$retypepassword`)";
}
    

if (mysqli_query($conn, $sql)) {
  //echo "Thank you for the responce, We will contact you soon";
} else {
  $data = array(
    'status' => 'failed',
    'message' => $errmsg
);
}

mysqli_close($conn); 
$data = array(
    'status' => 'success',
    'message' => 'successfully inserted'
);
}
//echo $data;




$result = json_encode(array("data" => $data));
//$data["status"]='success';
//$data["message"]='successfully inserted';
//$result="{status: 'success'; message:'Successfully inserted'}";
//$data = json_decode(file_get_contents('php://input'), true);
echo $result;
?> 