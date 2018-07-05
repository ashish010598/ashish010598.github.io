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
	$username = mysqli_real_escape_string($connection, $_POST['email']);
	$sql = "SELECT * FROM `receptionist` WHERE email = '$username'";
	$res = mysqli_query($connection, $sql);
	$count = mysqli_num_rows($res);
	if($count == 1){
		$_SESSION['username'] = $username;
		$row = mysqli_fetch_array($res);
		?>
		<form class="form-signin" method="POST" action="rrecover.php">
        <h1 class="form-signin-heading"><?php echo "<h1>" .$row['security'] . "?</h1>" ?></h1>
        <div class="input-group">
	  <span class="input-group-addon" id="basic-addon1">@</span>
	  <input type="text" name="securityans" class="form-control" placeholder="answer" required autocomplete="off">
	</div>
	<br />
        <button class="btn btn-lg btn-primary btn-block" type="submit">GO</button>
      </form>
	<?php	
	}else{
		echo "<h1>User name does not exist in database</h1>";
	}
}
?>
   </body>
</html> 
