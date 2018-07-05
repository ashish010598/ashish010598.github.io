<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Request</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 <link rel="stylesheet" type="text/css" href="index.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300, 400, 700" rel="stylesheet">

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">
    <link rel="stylesheet" href="css/table.css">

    <link rel="stylesheet" href="fonts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="fonts/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
     <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
   


    <!-- Theme Style -->
    <link rel="stylesheet" href="css/style.css">
     <link rel="stylesheet" type="text/css" href="css/khuchbhi.css">
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
                $email=$_SESSION["email"] ;
              echo "Hi!  " . $email .""; 

              ?></li>
              </ul>
              </ul>
            </div>
            <div class="col-md-6 col-sm-6 col-7 text-right">
              <p class="mb-0">
                <a href="order2.php" class="cta-btn" style="font-size: 15px;">BACK</a></p>
            </div>
          </div>
        </div>
      </div>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
         <img src="img/logo.jpg">
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarsExample05">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="hospital.php">Hospital</a>
              </li>
            
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Blood Bank</a>
                <div class="dropdown-menu" aria-labelledby="dropdown05">
                  <a class="dropdown-item" href="manager.php">Manager</a>
                  <a class="dropdown-item" href="reception.php">Receptionist</a>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="news.php">News</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="about.php">About Us</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contact.php">Contact Us</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
    
      <?php
      $_SESSION['email'] = $email;
         
         $query = "SELECT address FROM hospital WHERE email='$email'";
        $success = $connection->query($query);
        $row = mysqli_fetch_array($success);
        $city = $row[0];
       ?>
       <h1 style="text-align: center">PENDING ORDERS</h1> 
       <?php
        $query = mysqli_query($connection,"SELECT * FROM blood_bank_manager INNER JOIN hospital INNER JOIN ordersblood ON blood_bank_manager.city = hospital.address AND ordersblood.hemail = hospital.email WHERE blood_bank_manager.city='$city' group by oid");
      echo "<table border='1'>
        <tr>
          <th>DATE</th>
          <th>ORDER ID</th>
          <th>BLOOD GROUP</th>
          <th>QUANTITY</th>
        </tr>";
      while($row = mysqli_fetch_array($query)){
        echo "<tr>";
        echo "<td>" .$row['odate'] . "</td>";
        echo "<td>" .$row['oid'] . "</td>";
        echo "<td>" .$row['blood_type'] . "</td>";
        echo "<td>" .$row['quantity'] . "</td>";
        echo "<tr>";
      }
      echo "</table>" 
      ?>
      <br>
      <br>
       <h1 style="text-align: center">CLEARED ORDER</h1> 
      <?php 
   $result = mysqli_query($connection,"SELECT * FROM previousorders where hemail = '$email' group by oid");
      
  
      echo "<table border='1'>
        <tr>
          <th>BLOOD BANK NAME</th>
          <th>BLOOD BANK EMAIL</th>
          <th>ORDER ID</th>
          <th>BLOOD TYPE</th>
          <th>QUANTITY</th>
        </tr>";
      while($row = mysqli_fetch_array($result)){
        echo "<tr>";
        echo "<td>" .$row['name'] . "</td>";
        echo "<td>" .$row['bemail'] . "</td>";
        echo "<td>" .$row['oid'] . "</td>";
        echo "<td>" .$row['blood_type'] . "</td>";
        echo "<td>" .$row['quantity'] . "</td>";
        echo "<tr>";
      }
      echo "</table>" ;
      ?>
      <br>
      <br>
 <?php     

    mysqli_close($connection);
?>
  </body>
</html>

