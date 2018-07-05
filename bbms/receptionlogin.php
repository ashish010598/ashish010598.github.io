<!DOCTYPE html>
<html>
	<head>
		<title>Success</title>
		<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		 <link rel="stylesheet" href="fonts/fontawesome/css/font-awesome.min.css">
		  <link rel="stylesheet" type="text/css" href="css/error.css">
	</head>
	<body>	
<?php  //Start the Session

session_start();

$connection = mysqli_connect('localhost', 'root', 'ashish');
if (!$connection){
    die("Database Connection Failed" . mysqli_error($connection));
}
$select_db = mysqli_select_db($connection, 'bbms');
if (!$select_db){
    die("Database Selection Failed" . mysqli_error($connection));
}

if (isset($_POST['eemail']) and isset($_POST['password'])){
	

//3.1.1 Assigning posted values to variables
$eemail = $_POST['eemail'];

$password = $_POST['password'];

//3.1.2 Checking the values are existing in the database or not

$query = "SELECT * FROM `receptionist` WHERE email='$eemail' and password='$password'";


$result = mysqli_query($connection, $query) or die(mysqli_error($connection));

$count = mysqli_num_rows($result);

//3.1.2 If the posted values are equal to the database values, then session will be created for the user.

if ($count == 1){

$_SESSION['eemail'] = $eemail;


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
					<a href="reception.php" class="btn btn-primary btn-lg">TRY AGAIN</a>
				</div>
			</header>	
		</div>
		<?php



}

}

//3.1.4 if the user is logged in Greets the user with message

if (isset($_SESSION['eemail'])){

$eemail = $_SESSION['eemail'];
//$query = "SELECT bno FROM receptionist WHERE email='$eemail'";
//$success = $conn->query($query);
//$bno=intval($success);
//$_SESSION['bno']=$bno;
 
header('Location: donor2.php');


}else{
  

}
?>
 	</body>
</html>