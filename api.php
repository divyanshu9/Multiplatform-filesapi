<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'company'); 
define('DB_USER','root'); 
define('DB_PASSWORD',''); 
$con=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME); 
$apikey = $_GET['apikey'];
$apikey = stripslashes($apikey);
$apikey = mysqli_real_escape_string($con,$apikey);
$db=mysqli_query($con,"SELECT DATABASE()") or die("Failed to connect to MySQL: " . mysql_error()); 
$query = "SELECT username,files FROM login WHERE apikey = '$apikey'";
$result = mysqli_query($con,$query);
$data = mysqli_fetch_row($result);
if($data[1])
    $filelists = explode(" ",$data[1]);
    $files = array();
    $response = array('Response' => 'True');
if($data[0]) {
    $user_check=$data[0];
    foreach ($filelists as &$fl) {
        echo "  <a href=\"http://localhost/xampp/website3/internship/uploads/$user_check/$fl\" target=\"blank\">$fl</a><br>";
        $link = "http://localhost/xampp/website3/internship/uploads/$user_check/$fl";
        if($fl){
        $subresponse = array('filename' => $fl, 'filelink' => $link);
        array_push($response,$subresponse);
        }
    }
    //array_push($response,$subresponse);
}
else
    $response = array('Response' => 'False', 'error' => 'Invalid Api Key');
//header('Content-Type: application/json');
echo json_encode($response);
mysqli_close($con);
?>