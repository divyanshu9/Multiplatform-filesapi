<?php
session_set_cookie_params(0);
session_start();
if (isset($_GET['username'])) {
define('DB_HOST', 'localhost');
define('DB_NAME', 'company'); 
define('DB_USER','root'); 
define('DB_PASSWORD',''); 
$con=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME); 
$username = $_GET['username'];
$username = stripslashes($username);
$username = mysqli_real_escape_string($con,$username);
$password = $_GET['password'];
$password = stripslashes($password);
$password = mysqli_real_escape_string($con,$password);
$password = md5($password);
$db=mysqli_query($con,"SELECT DATABASE()") or die("Failed to connect to MySQL: " . mysql_error()); 
//echo $db;    
$query = "SELECT * FROM login WHERE username = '$username' AND password = '$password'";
$data = mysqli_query($con, $query)or die(mysql_error());
//echo mysqli_num_rows($data);
if(mysqli_num_rows($data)==1) {
    $result = array('Response' => 'True');
    $_SESSION['login_user']=$username;
}
else
    $result = array('Response' => 'False', 'error' => 'Invalid Username or Password');
header('Content-Type: application/json');
echo json_encode($result);
mysqli_close($con);
}
?>