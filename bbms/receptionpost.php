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
$fname    = $conn->real_escape_string($_POST['fname']);
$lname    = $conn->real_escape_string($_POST['lname']);
$bno    = $conn->real_escape_string($_POST['bno']);
$bname    = $conn->real_escape_string($_POST['bname']);
$city    = $conn->real_escape_string($_POST['city']);
$eemail   = $conn->real_escape_string($_POST['eemail']);
$phone   = $conn->real_escape_string($_POST['phone']);
$password = $conn->real_escape_string($_POST['password']);
$security = $conn->real_escape_string($_POST['security']);
$securityans = $conn->real_escape_string($_POST['securityans']);
$query   = "INSERT into receptionist (fname,lname,bno,email,phno,password,bname,city,security,securityans) VALUES('" . $fname . "','" . $lname . "','" . $bno . "','" . $eemail . "','" . $phone . "','" . $password . "','" . $bname . "','" . $city . "','" . $security . "','" . $securityans . "')";
$success = $conn->query($query);
$_SESSION["empEmail"] = $eemail;
$_SESSION["bnum"] = $bno;
$qry = "INSERT INTO blood_bank (bno) VALUES('" . $bno . "')";
$success = $conn->query($qry);
if (!$success) {
    die("Couldn't enter data: ".$conn->error);
 
}

 header('location: rsuccess.php');
 
$conn->close();
 
?>