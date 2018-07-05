<!DOCTYPE html>
<html>
	<head>
		<title>Forget Password</title>
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
			<link rel="stylesheet" href="forget.css" >
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
?>
<?php
if(isset($_POST) & !empty($_POST)){
	$answer = mysqli_real_escape_string($connection, $_POST['securityans']);
	$email = $_SESSION['username'];
	$sql = "SELECT * FROM `receptionist` WHERE email = '$email'";
	$res = mysqli_query($connection, $sql);
	$row = mysqli_fetch_array($res);
	if($answer == $row['securityans']){
	?>	
	<div class="container">
		<header class="jumbotron">
			<div class="container">
		<h1>Your Recovered Password is:</h1>
	<?php	
		echo "<h2>" .$row['password'] . "</h2>";
	?>	
	<a class="btn btn-lg btn-primary btn-block" href="reception.php">LOGIN</a>
	</div>	
	</header>
	</div>

	<?php	
	}

else {
		
?>
	<form class="form-signin" method="POST" action="">
		<h2 class="form-signin-heading"><?php echo "<h1>Wrong Answer</h1>" ?></h2>
	<a class="btn btn-lg btn-primary btn-block" href="rreset.php">TRY AGAIN</a>
	</form>
<?php		
	}
}	
?>
</body>
</html>