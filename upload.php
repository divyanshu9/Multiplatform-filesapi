<?php

if(!defined('UPLOAD_DIR')) define("UPLOAD_DIR", "uploads/");
$user_check = $_SESSION['login_user'];
if(!is_dir(UPLOAD_DIR.$user_check."/")) {
mkdir(UPLOAD_DIR.$user_check."/");}
if (!empty($_FILES["myFile"])) {
    $myFile = $_FILES["myFile"];

    if ($myFile["error"] !== UPLOAD_ERR_OK) {
        echo "<p>An error occurred.</p>";
        exit;
    }
    
define('DB_HOST', 'localhost');
define('DB_NAME', 'company'); 
define('DB_USER','root'); 
define('DB_PASSWORD',''); 
$con=mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME); 
    // ensure a safe filename
    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);

    // don't overwrite an existing file
    $i = 0;
    $parts = pathinfo($name);
    while (file_exists(UPLOAD_DIR . $name)) {
        $i++;
        $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
        
    }
    $files = $name;
   // echo $ppic;
    // preserve file from temporary directory
    $success = move_uploaded_file($myFile["tmp_name"],
        UPLOAD_DIR .$user_check.'/'. $files);
   // echo "Uploaded";
$db=mysqli_query($con,"SELECT DATABASE()") or die("Failed to connect to MySQL: " . mysql_error()); 
$query = "UPDATE login SET files = CONCAT(files,'$files ') WHERE username = '$user_check'";
$data = mysqli_query($con, $query)or die(mysql_error());
    
    if (!$success) { 
        echo "<p>Unable to save file.</p>";
        exit;
    }

    // set proper permissions on the new file
    //chmod(UPLOAD_DIR . $name, 0644);
    $imgset = 1;
}

/*<?php
// verify the file is a GIF, JPEG, or PNG
$fileType = exif_imagetype($_FILES["myFile"]["tmp_name"]);
$allowed = array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG);
if (!in_array($fileType, $allowed)) {
    // file type is not permitted
    ...*/

/*
<?php
// verify the file is a PDF
$mime = "application/pdf; charset=binary";
exec("file -bi " . $_FILES["myFile"]["tmp_name"], $out);
if ($out[0] != $mime) {
    // file is not a PDF
    ...
*/
/* <?php
exec("clamscan --stdout " . $_FILES["myFile"]["tmp_name"], $out, $return);
if ($return) {
    // file is infected
    ...
    */
?>

