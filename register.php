<?php
	ob_start();
	session_start(); // start a new session or continues the previous
	if( isset($_SESSION['customer'])!="" ){
		header("Location: home.php"); // redirects to home.php
	}
	//to insurt the dbconnect.php
 	include_once 'db_connection.php';
 	$error = false;
 	if ( isset($_POST['btn-signup']) ) {
		  // sanitize customer input to prevent sql injection
		$name = trim($_POST['name']);
		$name = strip_tags($name);		//schutz for fremdangriffen (code/sql)
		$name = htmlspecialchars($name);
		$email = trim($_POST['email']);
		$email = strip_tags($email);
		$email = htmlspecialchars($email);
		$pass = trim($_POST['pass']);
		$pass = strip_tags($pass);
		$pass = htmlspecialchars($pass);
		// basic name validation
		if (empty($name)) {
			$error = true;
			$nameError = "Please enter your full name.";
		} else if (strlen($name) < 3) {
		   	$error = true;
		   	$nameError = "Name must have atleat 3 characters.";
		} else if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
			$error = true;
			$nameError = "Name must contain alphabets and space.";
		}
		//basic email validation
		if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
			$error = true;
			$emailError = "Please enter valid email address.";
		} else {
		// check whether the email exist or not
		   $query = "SELECT customerEmail FROM customer WHERE customerEmail='$email'";
		   $result = mysqli_query($conn, $query);
		   $count = mysqli_num_rows($result);
		   if($count!=0){
				$error = true;
				$emailError = "Provided Email is already in use.";
		   	}
		}
		// password validation
		if (empty($pass)){
			$error = true;
		   	$passError = "Please enter password.";
		} else if(strlen($pass) < 6) {
		   	$error = true;
		   	$passError = "Password must have atleast 6 characters.";
		}
		

		// if there's no error, continue to signup
		if( !$error ) {
		   	$query = "INSERT INTO customer(customerName,customerEmail,customerPass) VALUES('$name','$email','$password')";
		   	$res = mysqli_query($conn, $query);
			if ($res) {
				$errTyp = "success";
				$errMSG = "Successfully registered, you may login now";
				unset($name);
				unset($email);
				unset($pass);
		   	} else {
		    	$errTyp = "danger";
		    	$errMSG = "Something went wrong, try again later...";
		   	}
		}
 	}
?>

<!DOCTYPE html>

<html>

<head>

<title>Login & Registration System</title>


<link rel="stylesheet" type="text/css" href="styling.css">

<link href="//netdna.bootstrapcdn.com/font-awesome/3.1.1/css/font-awesome.css" rel="stylesheet">

  <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  

 
</head>



<body>

</ul>
<!-- NAVBAR -->
<div class="navbar navbar-inverse navbar-fixed-top custom-navbar" >
   <div class="container">
      <div class="navbar-header">
         <a class="navbar-brand" href="#">The Car Rental Agency</a>
      </div>
      <div>
         <ul class="nav navbar-nav pull-right">
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="cars_list.php">Cars List</a></li>
            <li><a href="cars_locations.php">Cars Location</a></li>
            <li><a href="office.php">Office List</a></li>
            <li><a href="register.php">Sign Up</a></li>
            <li><a href="#">Contuct</a></li>
         </ul>
      </div>
   </div>
</div>
<!-- BANNER -->
<header class="banner">
   <div class="container text-center"">
      <div class="row">
         <h1>The Car Rental Agency </h1>
         <p>Welcome to our Car Rental Agency</p>
      </div>
   </div>
</header>
<br><br>


  <div class="container">
    <div class="row">
     <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3" >
        
     

    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">

        
          <h1>Sign Up</h1>

                 <hr />

            <?php

   if ( isset($errMSG) ) {

   

    ?>


             <div class="alert">

 <?php echo $errMSG; ?>

             </div>

 <?php

   }

   ?>

          <label id="icon" for="name"><i class="icon-user"></i></label>
              <input type="text" name="name" class="form-control" placeholder="Enter Name" maxlength="50" value="<?php echo $name ?>" />
                <span class="text-danger"><?php echo $nameError; ?></span>

   
          <label id="icon" for="name"><i class="icon-envelope "></i></label>
            <input type="email" name="email" class="form-control" placeholder="Enter Your Email" maxlength="40" value="<?php echo $email ?>" />
              <span class="text-danger"><?php echo $emailError; ?></span>
   
                        
         <label id="icon" for="name"><i class="icon-shield"></i></label>
          <input type="password" name="pass" class="form-control" placeholder="Enter Password" maxlength="15" />
            <span class="text-danger"><?php echo $passError; ?></span>

            <hr />

          <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Sign Up</button> | <a href="index.php">Sign In</a>

             
        </div>
      </div>
  </form>

<script src="java.js"></script>
</body>

</html>

<?php ob_end_flush(); ?>





          