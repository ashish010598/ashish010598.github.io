<?php
session_start();
?>
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
$name    = $conn->real_escape_string($_POST['name']);
$address   = $conn->real_escape_string($_POST['address']);
$email   = $conn->real_escape_string($_POST['email']);
$phno  = $conn->real_escape_string($_POST['phno']);
$password = $conn->real_escape_string($_POST['password']);
$security = $conn->real_escape_string($_POST['security']);
$securityans = $conn->real_escape_string($_POST['securityans']);
$query   = "INSERT into hospital (address,email,name,phno,password,security,securityans) VALUES('" . $address . "','" . $email . "','" . $name . "','" . $phno . "','" . $password . "','" . $security . "','" . $securityans . "')";
$success = $conn->query($query);
 $_SESSION["name"] = $name;
 $_SESSION["hemail"] = $email;

if (!$success) {
    die("Couldn't enter data: ".$conn->error);
 
}

header('location: hsuccess.php');
 
$conn->close();
 
?>
