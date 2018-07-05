<!DOCTYPE html>
<html>
	<head>
		<title>Success</title>
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		 <link rel="stylesheet" href="fonts/fontawesome/css/font-awesome.min.css">
		 <link rel="stylesheet" href="css/style.css">
		 <link rel="stylesheet" href="css/table.css">
		 <link rel="stylesheet" type="text/css" href="css/error.css">
	</head>
	<body>	
		<?php  

		session_start();

		$connection = mysqli_connect('localhost', 'root', 'ashish');
		if (!$connection){
		    die("Database Connection Failed" . mysqli_error($connection));
		}
		$select_db = mysqli_select_db($connection, 'bbms');
		if (!$select_db){
		    die("Database Selection Failed" . mysqli_error($connection));
		}

		if (isset($_POST['email']) and isset($_POST['password'])){
		
		$email = $_POST['email'];

		$password = $_POST['password'];

		$query = "SELECT * FROM `blood_bank_manager` WHERE email='$email' and password='$password'";

		$result = mysqli_query($connection, $query) or die(mysqli_error($connection));

		$count = mysqli_num_rows($result);

		if ($count == 1){

		$_SESSION['email'] = $email;
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
					<h1 style="color:black;text-align:center;font-family:Lato"><span style="color:red;">INVALID</span> LOGIN CREDENTIALS</h1>
					<a href="manager.php" class="btn btn-primary btn-lg">TRY AGAIN</a>
				</div>
			</header>	
		</div>
		<?php
		}

		}

//3.1.4 if the user is logged in Greets the user with message

if (isset($_SESSION['email']))
{

$email = $_SESSION['email'];

$query = "SELECT bname FROM blood_bank_manager WHERE email = '$email'";
$success = $connection->query($query);
$obj = mysqli_fetch_object($success);
?>
<header role="banner">
      <div class="top-bar">
        <div class="container">
          <div class="row">
            <div class="col-md-6 col-sm-6 col-5">
              <ul class="social list-unstyled">
                <li><a href="#"><span class="fa fa-facebook"></span></a></li>
                <li><a href="#"><span class="fa fa-twitter"></span></a></li>
                <li><a href="#"><span class="fa fa-instagram"></span></a></li>
                  <li style="color:cyan;"><?php
              echo "Hi!  " . $email .""; 
              ?></li>
              </ul>
            </div>
            <div class="col-md-6 col-sm-6 col-7 text-right">
              <p class="mb-0">
                <a href="mlogout.php" class="cta-btn" style="font-size: 15px;">LOGOUT</a></p>
            </div>
          </div>
        </div>
      </div>
		<div class="container">
			<header class="jumbotron">
				<div class="container">
					<h1 style="text-align: center;"><i class="fa fa-tint"></i><?php echo  " $obj->bname";  ?></h1>
				</div>
			</header>	
		</div>
		<h1 style="text-align: center">DONOR RECORD</h1>
<?php
	$query = "SELECT bno FROM blood_bank_manager WHERE email='$email'";
	$bno = $connection->query($query);
	$_SESSION['bno'] = $bno;
	$bno = mysqli_fetch_array($bno);
	$bno = $bno[0];

	$_SESSION['email'] = $email;

	$query = "SELECT city FROM blood_bank_manager WHERE email='$email'";
	$success = $connection->query($query);
	$row = mysqli_fetch_array($success);
	$city = $row[0];
?>	
<?php	
	 $result = mysqli_query($connection,"SELECT * FROM donor INNER JOIN receptionist ON donor.empEmail = receptionist.email  WHERE bno = $bno");
			
	
			echo "<table border='1'>
				<tr>
					<th>DATE</th>
					<th>NAME</th>
					<th>ADDRESS</th>
					<th>MOBILE</th>
					<th>EMAIL</th>
					<th>AGE</th>
					<th>SEX</th>
					<th>BLOOD GROUP</th>
					<th>ID</th>
					<th>REGISTERED BY</th>
					
				</tr>";
			while($row = mysqli_fetch_array($result)){
				echo "<tr>";
				echo "<td>" .$row['ddate'] . "</td>";
				echo "<td>" .$row['name'] . "</td>";
				echo "<td>" .$row['address'] . "</td>";
				echo "<td>" .$row['phno'] . "</td>";
				echo "<td>" .$row['email'] . "</td>";
				echo "<td>" .$row['age'] . "</td>";
				echo "<td>" .$row['sex'] . "</td>";
				echo "<td>" .$row['blood_group'] . "</td>";
				echo "<td>" .$row['id'] . "</td>";
				echo "<td>" .$row['empEmail'] . "</td>";
				
				echo "<tr>";
			}
			echo "</table>"	;
			?>
			<br>
			<br>
			<h1 style="text-align: center">BLOOD RECORD</h1> 
			<?php
		    $query = mysqli_query($connection,"SELECT * FROM blood_bank WHERE bno = '$bno'");
			
			?>

			<table border='1' id="t1">
			<?php	
			echo "<tr>
					<th>BLOOD GROUP</th>
					<th>QUANTITY</th>
				</tr>";
			$row = mysqli_fetch_array($query);
				echo "<tr>";
				echo "<td>A+</td>";
				echo "<td>" .$row['Ap'] . "</td>";
				echo "<tr>";
				echo "<td>A-</td>";
				echo "<td>" .$row['An'] . "</td>";
				echo "<tr>";
				echo "<td>B+</td>";
				echo "<td>" .$row['Bp'] . "</td>";
				echo "<tr>";
				echo "<td>B-</td>";
				echo "<td>" .$row['Bn'] . "</td>";
				echo "<tr>";
				echo "<td>O+</td>";
				echo "<td>" .$row['Op'] . "</td>";
				echo "<tr>";
				echo "<td>O-</td>";
				echo "<td>" .$row['Om'] . "</td>";
				echo "<tr>";
				echo "<td>AB+</td>";
				echo "<td>" .$row['ABp'] . "</td>";
				echo "<tr>";
				echo "<td>AB-</td>";
				echo "<td>" .$row['ABn'] . "</td>";
				echo "<tr>";
	
			echo "</table>"	
			?>
			<h1 style="text-align: center">PENDING ORDERS<span style= "font-size:20px; color: red;">(*City: <?php echo "$city"?>)</span></h1>
			<?php
		    $query = mysqli_query($connection,"SELECT * FROM blood_bank_manager INNER JOIN hospital INNER JOIN ordersblood ON blood_bank_manager.city = hospital.address AND ordersblood.hemail = hospital.email WHERE blood_bank_manager.city='$city' group by oid");
			
	
			echo "<table border='1'>
				<tr>
					<th>DATE</th>
					<th>HOSPITAL NAME</th>
					<th>HOSPITAL EMAIL</th>
					<th>CITY</th>
					<th>ORDER ID</th>
					<th>BLOOD GROUP</th>
					<th>QUANTITY</th>
					<th>CLICK TO CONFIRM</TH>
				</tr>";
			while($row = mysqli_fetch_array($query)){
				echo "<tr>";
				echo "<td>" .$row['odate'] . "</td>";
				echo "<td>" .$row['name'] . "</td>";
				echo "<td>" .$row['hemail'] . "</td>";
				echo "<td>" .$row['address'] . "</td>";
				echo "<td>" .$row['oid'] . "</td>";
				echo "<td>" .$row['blood_type'] . "</td>";
				echo "<td>" .$row['quantity'] . "</td>";
				echo "<td><a href='delete2.php?id=".$row['oid']."'>"?> <i class="fa fa-check-circle"> CONFIRM </i> <?php "</a></td>";
				echo "<tr>";
			}
			echo "</table>"	
		?>
		<br>
		<br>

<?php
}
		mysqli_close($connection);
?>
 	</body>
</html>