<!DOCTYPE html>
<html>
	<head>
		<title>Success</title>
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		 <link rel="stylesheet" href="fonts/fontawesome/css/font-awesome.min.css">


		 
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
		$blood_type    = $conn->real_escape_string($_POST['blood_type']);
		$quantity    = $conn->real_escape_string($_POST['quantity']);
		$hemail   = $_SESSION["email"];
		$query = "SELECT name FROM hospital WHERE email='$hemail'";
		$success = $conn->query($query);
		$row = $success->fetch_assoc();
		$name = $row['name'];
		$date = date('Y-m-d H:i:s');
		$query   = "INSERT into ordersblood (hemail,name,blood_type,quantity,odate) VALUES('" . $hemail . "','" . $name . "','" . $blood_type . "','" . $quantity . "','" . $date . "')";
		$success = $conn->query($query);
		$oid = mysqli_INSERT_id($conn);
		$query = "SELECT cost FROM blood_cost where blood_group='$blood_type'";
		$success = $conn->query($query);
		$row = mysqli_fetch_array($success);
		$cost = $row[0];

		 
		if (!$success) {
		    die("Couldn't enter data: ".$conn->error);
		 
		}
		?> 
		<div class="container">
		<header class="jumbotron">
			<div class="container">
				<i class="fa fa-cart-plus" aria-hidden="true" style="font-size: 15em;margin-left: 370px;"></i> 
				<h1 style="text-align: center">Order Successfully Placed!</h1>
				
				
			</div>
		</header>	
	</div>
	<br>
	<br>
	<div class="container">
		<header class="jumbotron">
			<div class="container">
				<p><?php echo " Order ID : " . $oid .""; ?></p>
				<p><?php echo "Blood Group: " . $blood_type .""; ?></p>
				<p><?php echo "Quantity:" . $quantity .""; ?></p>
				<p><?php echo "Estimated Amount ₹" . $cost*$quantity .""; ?></p>
				<p></p>
				
				<a href="order2.php" class="btn btn-primary btn-lg">Order More</a>

			</div>
		</header>
	</div>	
	<?php
		$conn->close();
	?>		
	</body>
	</html>

