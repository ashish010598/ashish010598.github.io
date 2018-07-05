<?php
function Connect()
{
 $dbhost = "localhost";
 $dbuser = "root";
 $dbpass = "ashish";
 $dbname = "bbms";
 
 // Create connection
 $conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname) or die($conn->connect_error);
 
 return $conn;
}
 
$conn    = Connect();
$fname    = $conn->real_escape_string($_POST['fname']);
$lname    = $conn->real_escape_string($_POST['lname']);
$email   = $conn->real_escape_string($_POST['email']);
$message  = $conn->real_escape_string($_POST['message']);
$query   = "INSERT into feedback (fname,lname,email,message) VALUES('" . $fname . "','" . $lname . "','" . $email . "','" . $message . "')";
$success = $conn->query($query);
 
if (!$success) {
    die("Couldn't enter data: ".$conn->error);
 
}
 
echo "Thank You For Your valuable feedback <br>";
echo "<a href= contact.php>Go Back</a>";
 
$conn->close();
 
?>

