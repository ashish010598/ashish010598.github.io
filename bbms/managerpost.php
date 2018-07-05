<!DOCTYPE html>
<html>
	<head>
		<title>Success</title>
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		 <link rel="stylesheet" href="fonts/fontawesome/css/font-awesome.min.css">
		 <link rel="stylesheet" href="css/style.css">
		 <link rel="stylesheet" href="css/table.css">
	</head>
	<body>	
		<?php
		function Connect()
		{
		 $dbhost = "localhost";
		 $dbuser = "root";
		 $dbpass = "ashish";
		 $dbname = "bbms";
		 
		 // Create connection
		 $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die($conn->connect_error);
		 
		 return $conn;
		}
		 
		$conn    = Connect();
		$fname    = $conn->real_escape_string($_POST['fname']);
		$lname    = $conn->real_escape_string($_POST['lname']);
		$bbnum    = $conn->real_escape_string($_POST['bbnum']);
		$bname    = $conn->real_escape_string($_POST['bname']);
		$city    = $conn->real_escape_string($_POST['city']);
		$email   = $conn->real_escape_string($_POST['email']);
		$phone   = $conn->real_escape_string($_POST['phone']);
		$password = $conn->real_escape_string($_POST['password']);
		$security = $conn->real_escape_string($_POST['security']);
		$securityans = $conn->real_escape_string($_POST['securityans']);
		$query   = "INSERT into blood_bank_manager (fname,lname,bno,email,phno,password,bname,city,security,securityans) VALUES('" . $fname . "','" . $lname . "','" . $bbnum . "','" . $email . "','" . $phone . "','" . $password . "','" . $bname . "','" . $city . "','" . $security . "','" . $securityans . "')";
		$success = $conn->query($query);
		 
		if (!$success) {
		    die("Couldn't enter data: ".$conn->error);
		 
		}
		 
		 

		 header('location: msuccess.php');
		 ?>
 	</body>
</html>
