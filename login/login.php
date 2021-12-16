<?php
error_reporting(~E_WARNING & ~E_NOTICE);
$username = $_POST['username'];
$password  = $_POST['password'];
$dbuser = "";
$dbpwd = "";
$error=false;
// $errormessage = array();
$errmsg = "";

if($username == ""){
    // $errormessage[0] = "Name is empty";
    $errmsg = "Name is empty";
    $error = true;
}
if($password == ""){
    // $errormessage[1] = "Email is empty";
    $errmsg = $errmsg . "<br>Email is empty";
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
$dbusername = "root";
$dbpassword = "";
$dbname = "project";
// Create connection
$conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
if ($username == "" || $password == "" ){
  $data = array(
    'status' => 'failed',
    'message' => "Connection failed: " . mysqli_error($conn));
}else{
 

$sql = "SELECT * FROM register WHERE user='".$username."' and password='".$password."'";
// echo $sql;
$result = mysqli_query($conn, $sql);
// print_r($result);
// exit;
if (mysqli_num_rows($result) > 0) {
  // output data of each row

  $data = array(
    'status' => 'success',
    'message' => 'Login successfully');

  // while($row = mysqli_fetch_assoc($result)) {
  //   echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
  // }
} else {
    
    $data = array(
      'status' => 'failed',
      'message' => "Invalid login credentials"); 
}

mysqli_close($conn); 


}
}
$result = json_encode(array("data" => $data));
echo $result;
?>