<?php
  ob_start();
  session_start();
  require_once 'db_connection.php';
  // it will never let you open index(login) page if session is set
  if ( isset($_SESSION['customer'])!="" ) {
    header("Location: home.php");
    exit;
  }
  $error = false;
  if( isset($_POST['btn-login']) ) {
    // prevent sql injections/ clear customer invalid inputs
    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);
    $pass = trim($_POST['pass']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);
    // prevent sql injections / clear customer invalid inputs
    if(empty($email)){
      $error = true;
      $emailError = "Please enter your email address.";
    } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
      $error = true;
      $emailError = "Please enter valid email address.";
    }
    if(empty($pass)){
      $error = true;
      $passError = "Please enter your password.";
    }
    // if there's no error, continue to login
    if (!$error) {
      $password = hash('sha256', $pass); // password hashing using SHA256
      $res=mysqli_query($conn, "SELECT customerId, customerName, customerPass FROM customer WHERE customerEmail='$email'");
      $row=mysqli_fetch_array($res, MYSQLI_ASSOC);
      $count = mysqli_num_rows($res); // if uname/pass correct it returns must be 1 row
      if( $count == 1 && $row['customerPass']==$password ) {
        $_SESSION['customer'] = $row['customerId'];
        header("Location: home.php");
      } else {
        $errMSG = "Incorrect Credentials, Try again...";
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

        
          <h1>Sign In</h1>

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
   
          <label id="icon" for="name"><i class="icon-envelope "></i></label>
            <input type="email" name="email" class="form-control" placeholder="Enter Your Email" maxlength="40" value="<?php echo $email ?>" />
              <span class="text-danger"><?php echo $emailError; ?></span>
   
                        
         <label id="icon" for="name"><i class="icon-shield"></i></label>
          <input type="password" name="pass" class="form-control" placeholder="Enter Password" maxlength="15" />
            <span class="text-danger"><?php echo $passError; ?></span>

            <hr />

          <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Sign In</button> | <a href="register.php">Sign Up</

             
        </div>
      </div>
  </form>

</body>

</html>

<?php ob_end_flush(); ?>





          