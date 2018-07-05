<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Donor Registeration</title>
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
  <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300, 400, 700" rel="stylesheet">

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">

    <link rel="stylesheet" href="fonts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="fonts/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  
  
      
      <link rel="stylesheet"type="text/css" href="css/style.css">
    <link rel="stylesheet"type="text/css" href="index.css">
    <link rel="stylesheet" type="text/css" href="css/formDonor.css">
  </head>
  <body>
    
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
                session_start();
                $eemail = $_SESSION['eemail'];
              echo "Hi!  " . $eemail .""; 
              ?></li>
              </ul>
               
            </div>
            <div class="col-md-6 col-sm-6 col-7 text-right">
              <p class="mb-0">
                <a href="rlogout.php" class="cta-btn" style="font-size: 15px;">LOGOUT</a></p>
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
                <a class="nav-link" href="hospital.php">Hospital</a>
              </li>
            
              <li class="nav-item dropdown">
                <a class="nav-link active dropdown-toggle" href="doctors.html" id="dropdown05" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Blood Bank</a>
                <div class="dropdown-menu" aria-labelledby="dropdown05">
                  <a class="dropdown-item" href="manager.php">Manager</a>
                  <a class="dropdown-item" href="Reception.php">Receptionist</a>
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
    <!-- END header -->


  



    <section class="home-slider inner-page owl-carousel">
      <div class="slider-item" style="background-image: url('img/donor.jpg');">
        
        <div class="container">
          <div class="row slider-text align-items-center">
            <div class="col-md-7 col-sm-12 element-animate">
              <h1 style="color:#d34343; font-weight:bold;">DONOR REGISTRATION</h1>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi unde impedit, necessitatibus, soluta sit quam minima expedita atque corrupti reiciendis.</p>
            </div>
          </div>
        </div>
      </div>
    </section>
  


 <div class="col-md-20 stretch-left-1 element-animate" data-animate-effect="fadeInLeft">
<div class="container" id="back" style="max-width:3000px;width:2500px;">
      <div class="row main">
        <div class="main-login main-center" style="margin-left:70px;">
        <h5 style="text-align:center;">NEW DONOR FORM</h5>
          <form class="" method="post" action="donorpost2.php">
            
            <div class="form-group" style="width:430px;">
              <label for="name" class="cols-sm-2 control-label" >Name</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user-md" aria-hidden="true"></i></span>
                  
                  <input type="text"  class="form-control"  name="name" id="name" required  placeholder="Enter Donor Name" / >

                </div>
              </div>
            </div>

            <div class="form-group" style="width:430px;">
              <label for="address" class="cols-sm-2 control-label">Address</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-home" aria-hidden="true"></i></span>
                  <input type="text" class="form-control" name="address" id="address"  placeholder="Enter Address" required style="width:700px">
                </div>
              </div>
            </div>

            <div class="form-group" style="width:430px;">
              <label for="contact" class="cols-sm-2 control-label">Contact Number</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-phone" aria-hidden="true"></i></span>
                  <input type="text" class="form-control" name="phno" id="number" Maxlength="10" Minlength="10" placeholder="Enter Contact Number" required/>
                </div>
              </div>
            </div>

             <div class="form-group" style="width:430px;">
              <label for="email" class="cols-sm-2 control-label">Email</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                  <input type="email" class="form-control" name="email" id="email"  placeholder="Enter Email Address" required style="width:450px">
                </div>
              </div>
            </div>

             <div class="form-group" style="width:430px;">
              <label for="age" class="cols-sm-2 control-label">Age</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-angle-double-right" aria-hidden="true"></i></span>
                  <input type="number" min=18 max=65 class="form-control" name="age" id="age" placeholder="Enter Age" required/>
                </div>
              </div>
            </div>

             <div class="form-group" style="width:430px;">
              <label for="gender" class="cols-sm-2 control-label">Gender</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-venus-mars" aria-hidden="true"></i></span>
                  <select name="sex" id="gender" class="form-control" placeholder="" required>
                    <option>Male</option>
                    <option>Female</option>
                    <option>Other</option>
                  </select>
                  
                </div>
              </div>
            </div>

            <div class="form-group" style="width:430px;">
              <label for="blood" class="cols-sm-2 control-label">Blood Group Required</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-tint" aria-hidden="true"></i></span>
                  <select name="blood_group" id="blood" class="form-control" placeholder="" required>
                    <option>A+</option>
                    <option>A-</option>
                    <option>B+</option>
                    <option>B-</option>
                    <option>O+</option>
                    <option>O-</option>
                    <option>AB+</option>
                    <option>AB-</option>
                  </select>
                  
                </div>
              </div>
            </div>
            <div class="form-group " style="width:430px;">
              <input type="submit" value="Register And Donate" id="button" class="btn btn-primary btn-lg btn-block login-button">
            </div>

            
          </form>
        </div>
        <div class="main-login main-center" style="margin-left:150px; position: relative; height: 300px;">
        <h5 style="text-align:center;">EXISTING DONOR VERIFICATION</h5>
          <form class="" method="post" action="donorpost1.php">
            
            <div class="form-group" style="width:430px;">
              <label for="did" class="cols-sm-2 control-label">DONOR ID</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user-md" aria-hidden="true"></i></span>
                  
                  <input type="number"  class="form-control"  name="did" id="did" required  placeholder="Enter Donor ID" / >

                </div>
              </div>
            </div>
            <div class="form-group " style="width:430px;">
              <input type="submit" value="Verify And Donate" id="button" class="btn btn-primary btn-lg btn-block login-button">
            </div>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>
</div>






<section class="cover_1" style="background-image: url(img/bg_1.jpg);">
      <div class="container">
        <div class="row text-center justify-content-center">
          <div class="col-md-10">
            <h2 class="heading element-animate">Experience Our Advance Facilities</h2>
            <p class="sub-heading element-animate mb-5">BBMS+ is one of the largest online platforms for Blood Bank Management System.<br>Experience the best customer services and advance facilities by providing your valuable feedback to us.</p>
            <p class="element-animate"><a href="contact.php" class="btn btn-primary btn-lg">Get In Touch</a></p>
          </div>
        </div>
      </div>
    </section>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
  <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/jquery.timepicker.min.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/main.js"></script>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

  

    <script  src="js/donor.js"></script>




</body>

</html>
