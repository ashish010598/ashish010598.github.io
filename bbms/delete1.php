<?php
session_start();
$id=$_GET['id'];
$dbname = "bbms";
$conn = mysqli_connect("localhost", "root", "ashish", $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$email=$_SESSION['email'];
echo gettype($email);
echo "$email";
$qry="SELECT bno from blood_bank_manager where email='$email'";
$success=$conn->query($qry);
$row = mysqli_fetch_array($success);
$bno = $row[0];
$bno=intval($bno);
$qry = "SELECT blood_type FROM ordersblood WHERE oid='$id'";
$success = $conn->query($qry);
$row = mysqli_fetch_array($success);
$blood_group = $row[0];
$qry = "SELECT quantity FROM ordersblood WHERE oid='$id'";
$success = $conn->query($qry);
$row = mysqli_fetch_array($success);
$quantity = $row[0];
$quantity=intval($quantity);
$query="SELECT * FROM blood_bank where bno=$bno";
$success=$conn->query($query);
$row = mysqli_fetch_array($success);
 

    
					if($blood_group == 'A+'){
						
						if($quantity<=(int)$row['Ap'])
                        {
                        $sql = "DELETE FROM ordersblood WHERE oid = '$id'"; 
                        $success=$conn->query($sql);
						$query = "UPDATE blood_bank SET Ap=Ap-$quantity WHERE bno=$bno";
						$result = $conn->query($query);
						header('Location: managerlogin.php');
					    }
					    else{
					   		header('Location: delerror.php');

					    }
					}
					else if($blood_group == 'A-'){
						 if($quantity<=(int)$row['An'])
                        {
                        $sql = "DELETE FROM ordersblood WHERE oid = '$id'"; 
                        $success=$conn->query($sql);
						$query = "UPDATE blood_bank SET An=An-$quantity WHERE bno=$bno";
						$result = $conn->query($query);
						header('Location: managerlogin.php');
					    }
					    else{
					   		header('Location: delerror.php');
					   	}	
					}
					else if($blood_group == 'B+'){
						if($quantity>=(int)$row['Bp'])
                        {
                        $sql = "DELETE FROM ordersblood WHERE oid = '$id'"; 
                        $success=$conn->query($sql);
						$query = "UPDATE blood_bank SET Bp=Bp-$quantity WHERE bno=$bno";
						$result = $conn->query($query);
						header('Location: managerlogin.php');
					    }
					    else{
					   		header('Location: delerror.php');
					   	}	
					}
					else if($blood_group == 'B-'){
						 if($quantity>=(int)$row['Bn'])
                        {
                        $sql = "DELETE FROM ordersblood WHERE oid = '$id'"; 
                        $success=$conn->query($sql);
						$query = "UPDATE blood_bank SET Bn=Bn-$quantity WHERE bno=$bno";
						$result = $conn->query($query);
						header('Location: managerlogin.php');
					    }
					    else{
					   		header('Location: delerror.php');
					   	}	
					}
					else if($blood_group == 'AB+'){
						if($quantity>=(int)$row['ABp'])
                        {
                        $sql = "DELETE FROM ordersblood WHERE oid = '$id'"; 
                        $success=$conn->query($sql);
						$query = "UPDATE blood_bank SET ABp=ABp-$quantity WHERE bno=$bno";
						$result = $conn->query($query);
						header('Location: managerlogin.php');
					    }
					    else{
					   		header('Location: delerror.php');
					   	}	
					}
					else if($blood_group == 'AB-'){
						 if($quantity>=(int)$row['ABn'])
                        {
                        $sql = "DELETE FROM ordersblood WHERE oid = '$id'"; 
                        $success=$conn->query($sql);
						$query = "UPDATE blood_bank SET ABn=ABn-$quantity WHERE bno=$bno";
						$result = $conn->query($query);
						header('Location: managerlogin.php');
					    }
					    else{
					   		header('Location: delerror.php');
					   	}	
					}
					else if($blood_group == 'O+'){
						 if($quantity<=(int)$row['Op'])
                        {
                        $sql = "DELETE FROM ordersblood WHERE oid = '$id'"; 
                        $success=$conn->query($sql);
						$query = "UPDATE blood_bank SET Op=Op-$quantity WHERE bno=$bno";
						$result = $conn->query($query);
						header('Location: managerlogin.php');
					    }
					    else{
					   		header('Location: delerror.php');
					   	}	
					}
					else if($blood_group == 'O-'){
					 if($quantity>=(int)$row['Om'])
                        {
                        $sql = "DELETE FROM ordersblood WHERE oid = '$id'"; 
                        $success=$conn->query($sql);
						$query = "UPDATE blood_bank SET Om=Om-$quantity WHERE bno=$bno";
						$result = $conn->query($query);
						header('Location: managerlogin.php');
					    }
					    else{
					   		header('Location: delerror.php');
					   	}	
					
					}
    mysqli_close($conn);

?>