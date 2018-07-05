<!DOCTYPE html>
<html>
	<head>
		<title>Success</title>
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		 <link rel="stylesheet" href="fonts/fontawesome/css/font-awesome.min.css">
		 <link rel="stylesheet" type="text/css" href="css/success.css">
	</head>
	<body>	
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
$address    = $conn->real_escape_string($_POST['address']);
$age   = $conn->real_escape_string($_POST['age']);
$email   = $conn->real_escape_string($_POST['email']);
$phno   = $conn->real_escape_string($_POST['phno']);
$sex = $conn->real_escape_string($_POST['sex']);
$blood_group = $conn->real_escape_string($_POST['blood_group']);
$empEmail = $_SESSION["eemail"];
$date = date('Y-m-d H:i:s');
$query   = "INSERT into donor (name,address,phno,email,age,sex,blood_group,empEmail,ddate) VALUES('" . $name . "','" . $address . "','" . $phno . "','" . $email . "','" . $age  . "','" . $sex . "','" . $blood_group. "','" . $empEmail. "','" . $date. "')";
$success = $conn->query($query);
if($success){
	$last_id= mysqli_INSERT_id($conn);
}
$query = "SELECT bno FROM receptionist WHERE email='$empEmail'";
$success = $conn->query($query);
$row = $success->fetch_assoc();
$bno = $row['bno'];
 
$qry ="INSERT INTO blood (blood_group,bno,id) VALUES('" . $blood_group . "','" . $bno . "','" . $last_id . "')";
$success = $conn->query($qry);
if($blood_group == 'A+'){
	$query = "UPDATE blood_bank SET Ap=Ap+1 WHERE bno=$bno";
	$result = $conn->query($query);
}
else if($blood_group == 'A-'){
	$query = "UPDATE blood_bank SET An=An+1 WHERE bno=$bno";
	$result = $conn->query($query);
}
else if($blood_group == 'B+'){
	$query = "UPDATE blood_bank SET Bp=Bp+1 WHERE bno=$bno";
	$result = $conn->query($query);
}
else if($blood_group == 'B-'){
	$query = "UPDATE blood_bank SET Bn=Bn+1 WHERE bno=$bno";
	$result = $conn->query($query);
}
else if($blood_group == 'AB+'){
	$query = "UPDATE blood_bank SET ABp=ABp+1 WHERE bno=$bno";
	$result = $conn->query($query);
}
else if($blood_group == 'AB-'){
	$query = "UPDATE blood_bank SET ABn=ABn+1 WHERE bno=$bno";
	$result = $conn->query($query);
}
else if($blood_group == 'O+'){
	$query = "UPDATE blood_bank SET Op=Op+1 WHERE bno=$bno";
	$result = $conn->query($query);
}
else if($blood_group == 'O-'){
	$query = "UPDATE blood_bank SET Om=Om+1 WHERE bno=$bno";
	$result = $conn->query($query);
}
 if (!$success) {
    die("Couldn't enter data: ".$conn->error);
 }
 ?>
 <div class="container">
		<header class="jumbotron">
			<div class="container">
				<!-- <i class="fa fa-check-square" aria-hidden="true" style="font-size: 15em;margin-left: 370px;"></i> -->
				<div class="check_mark">
					  <div class="sa-icon sa-success animate">
					    <span class="sa-line sa-tip animateSuccessTip"></span>
					    <span class="sa-line sa-long animateSuccessLong"></span>
					    <div class="sa-placeholder"></div>
					    <div class="sa-fix"></div>
					  </div>
				</div>
				<h1>Donor Successfully Registered!</h1>
				<p><?php echo "The Donor ID is " . $last_id .""; ?></p>
				
				<a href="donor2.php" class="btn btn-primary btn-lg">Register Another</a>
				
			</div>
		</header>	
	</div>
<?php
	$conn->close();
?>	
</body>
</html>