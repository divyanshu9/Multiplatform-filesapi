<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'company'); 
define('DB_USER','root'); 
define('DB_PASSWORD',''); 
$con=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME); 
function NewUser() { 
    global $result;
    global $con;
    $username = $_GET['username'];
    $username = stripslashes($username);
    $username = mysqli_real_escape_string($con,$username);
    $password = $_GET['password'];
    $password = stripslashes($password);
    $password = mysqli_real_escape_string($con,$password);
    $password = md5($password);
    $email = $_GET['email'];
    $email = stripslashes($email);
    $email = mysqli_real_escape_string($con,$email);
    $apikey = random_key();
    
    $query = "INSERT INTO login (username,email,password,apikey) VALUES ('$username','$email','$password','$apikey')";
    $data = mysqli_query ($con,$query)or die(mysql_error());
    if($data) {
        global $result;
        $result = array('Response' => 'True', 'success' => 'Account Created');
        // echo "YOUR REGISTRATION IS COMPLETED";
    }

}
function SignUp() 
{ 
    global $con;
    global $result;
    $query = mysqli_query($con,"SELECT * FROM login WHERE email = '$_GET[email]'"); 
        if(mysqli_num_rows($query)!=1) 
        {
            $query1 = mysqli_query($con,"SELECT* FROM login WHERE username = '$_GET[username]'"); 
            if(mysqli_num_rows($query1)!=1)
            {
            NewUser();
            }
            else
            {
               $result = array('Response' => 'False', 'error' => 'Username already taken');
                
		//echo "SORRY...Username already taken please try again";
            }
        } else 
        { 
            
            $result = array('Response' => 'False', 'error' => 'Email Already Exists');
            
            //echo "SORRY...YOU ARE ALREADY REGISTERED USER...";
            
        }
}
function random_key($str_length = 24)
{
  // base 62 map
  $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

  // get enough random bits for base 64 encoding (and prevent '=' padding)
  // note: +1 is faster than ceil()
  $bytes = openssl_random_pseudo_bytes(3*$str_length/4+1);

  // convert base 64 to base 62 by mapping + and / to something from the base 62 map
  // use the first 2 random bytes for the new characters
  $repl = unpack('C2', $bytes);

  $first  = $chars[$repl[1]%62];
  $second = $chars[$repl[2]%62];

  return strtr(substr(base64_encode($bytes), 0, $str_length), '+/', "$first$second");
}
SignUp();
header('Content-Type: application/json');
echo json_encode($result);
mysqli_close($con);
?>