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
if (isset($_POST['did'])){
	$id = $_POST['did'];
$query = "SELECT * FROM `donor` WHERE id='$id'";
$result = mysqli_query($conn, $query) or die(mysqli_error($conn));
$count = mysqli_num_rows($result);
if ($count == 1){
$empEmail = $_SESSION["eemail"];
$query   = "SELECT blood_group FROM donor where id = '$id'";
$success = $conn->query($query);
$row = $success->fetch_assoc();
$blood_group = $row['blood_group'];
$query   = "SELECT name FROM donor where id = '$id'";
$success = $conn->query($query);
$row = $success->fetch_assoc();
$name = $row['name'];
$query   = "SELECT ddate FROM donor where id = '$id'";
$success = $conn->query($query);
$row = $success->fetch_assoc();
$ddate = $row['ddate'];
$query = "SELECT bno FROM receptionist WHERE email='$empEmail'";
$success = $conn->query($query);
$row = $success->fetch_assoc();
$bno = $row['bno'];
if($success){
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
				<h1>Donor Found!</h1>
				<p><?php echo "The Donor Name is " . $name .""; ?></p>
				<p><?php echo "The Donor blood Group is " . $blood_group .""; ?></p>
				<p><?php echo "Last Donated On " . $ddate .""; ?></p>
				<p><?php echo "The Donor ID is " . $id .""; ?></p>
				<h4>Blood Successfully Donated</h4>
				
				<a href="donor2.php" class="btn btn-primary btn-lg">Register Another</a>
				
			</div>
		</header>	
	</div>
<?php 
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

}
	$conn->close();

		}else{
		?>
		<div class="container">
			<header class="jumbotron">
					<div class="sa" style="margin-left: 380px;">
						<div class="sa-error">
							<div class="sa-error-x">
							<div class="sa-error-left"></div>
							<div class="sa-error-right"></div>
						</div>
							<div class="sa-error-placeholder"></div>
							<div class="sa-error-fix"></div>
						</div>
					</div>
				<div class="container">
					<!-- <i class="fa fa-times" aria-hidden="true" style="font-size: 15em;margin-left: 370px;color:black;"></i> -->
					<h1 style="color:black;text-align:center;font-family:Lato"><span style="color:red;">INVALID</span> Donor Id</h1>
					<a href="donor2.php" class="btn btn-primary btn-lg">TRY AGAIN</a>
				</div>
			</header>	
		</div>
		<?php
		}
	}
		?>
</body>
</html>