<?php
session_start();
if(isset($_SESSION['login_user']))
{
    include('upload.php');
    $user_check=$_SESSION['login_user'];
    
    ?>
<html>
<head><title>Profile Page</title>
 <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous"> 
<link rel="stylesheet" href="customstyle.css">
<style></style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"> </script>
</head>
<body>
<div class="container">
    <h1> Welcome <?php  echo $user_check;  ?> <span><button type="button" class="toggle lgout">Logout</button></span></h1>
    <div style="margin-top:50px;border: 2px solid black;" class="wrapper">
        <form action="" method="post" enctype="multipart/form-data">
        <label class="myLabel">
             <input type="file" name="myFile" required/>
        <h1 style="text-align: center;">Upload</h1>
            <input type="submit" value="Upload">
        </label>
            </form>
    </div>
    <?php $con1=mysqli_connect('localhost','root','','company'); 
    $db1=mysqli_query($con1,"SELECT DATABASE()") or die("Failed to connect to MySQL: " . mysqli_error()); 
    $query2 = "SELECT apikey from login where username = '$user_check'";
    $res2 = mysqli_query($con1,$query2);
    $d2 = mysqli_fetch_row($res2);
    $query1 = "SELECT files from login where username = '$user_check'";
    $res = mysqli_query($con1,$query1);
    $d = mysqli_fetch_row($res);
    //echo $d[0];
    $filelists = explode(" ",$d[0]);
    foreach ($filelists as &$fl) {
  //echo 'http://localhost/xampp/website3/internship/uploads/'."$fl ";
}
    ?>
    <div style="border: 1px solid black; text-align:center;">
        <h1>Myfiles</h1><span><p style="color:red;"><?php echo "Your api key is $d2[0]"; ?></p></span>
    <?php
    foreach ($filelists as &$fl) {
  echo "  <a href=\"http://localhost/xampp/website3/internship/uploads/$user_check/$fl\" target=\"blank\">$fl</a><br>";
}
    ?>
    </div>
    

      
    </div>
    <script>
    $(document).ready(function() {
        $(".lgout").on("click", function(){
           window.location = "logout.php"; 
        });
    });
    </script>
    </body>
</html>
<?php

}
else
{
    echo "YOU NEED TO LOGIN FIRST";
}
?>
    