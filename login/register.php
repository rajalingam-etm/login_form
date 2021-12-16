<?php

$user = $_POST['user'];
$email  = $_POST['email'];
$password = $_POST['password'];
$retypepassword= $_POST['retypepassword'];

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
if($retypepassword == "" || $retypepassword != $password ){
  // $errormessage[1] = "Email is empty";
  $errmsg = $errmsg . "<br>password is empty or not matched";
  $error = true;
}
if($error){
    $data = array(
        'status' => 'failed',
        'message' => $errmsg );
}else{
$servername = "localhost";
$username = "root";
$dbpassword = "";
$dbname = "project";
// Create connection
$conn = mysqli_connect($servername, $username, $dbpassword, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
if ($user == "" ||$email == ""  || $password == "" || $retypepassword == "" )
{
  $data = array(
    'status' => 'failed',
    'message' => "Connection failed: " . mysqli_error($conn));
  }
else
{
  $sql = "INSERT INTO `register` (`id`,`user`,`email`, `password`,`retypepassword`)
VALUES (NULL,'$user', '$email', '$password', '$retypepassword')";
 
if (mysqli_query($conn, $sql)) {
    $data = array(
        'status' => 'success',
        'message' => 'successfully inserted' );
} else {
  $data = array(
    'status' => 'failed',
    'message' => "Connection failed: " . mysqli_error($conn));}
mysqli_close($conn); 
}}
$result = json_encode(array("data" => $data));
echo $result;
?> 