<?php  
	ob_start();
	session_start();

	require_once 'db_connection.php';

	// // if session is not set this will redirect to login page
	// if( !isset($_SESSION['customer']) ) {
	// 	header("Location: index.php");
	// 	exit;
	// }

	$res=mysqli_query($conn, "SELECT * FROM customer WHERE customer_id=".$_SESSION['customer']);

	$customerRow=mysqli_fetch_array($res, MYSQLI_ASSOC);

	// $sql = "SELECT * FROM car
	// 	LEFT JOIN cartype ON type_id = fk_cartype_id
	// 	LEFT JOIN car_location ON location_id = fk_location_id
	// 	LEFT JOIN car_status ON status_id = fk_status_id
	// 	LEFT JOIN office ON office_id = fk_office_id
	// 	ORDER BY car_id
	// 	";

	$allcars = "SELECT * FROM car
				LEFT JOIN car_type ON car.fk_car_type_id = car_type.car_type_id
				LEFT JOIN car_status ON car.fk_status_id = car_status.status_id
				LEFT JOIN car_location ON car.fk_location_id = car_location.location_id
				LEFT JOIN office ON car.fk_office_id = office.office_id
				";

	$result = mysqli_query($conn, $allcars);


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
		<div class="table-responsive">
			
			<table class="table">
				<thead>
					<tr>
						<th scope="col">ID</th>
						<th scope="col">Type</th>
						<th scope="col">Office</th>
						<th scope="col">Location</th>
						<th scope="col">Status</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						while ($row = mysqli_fetch_assoc($result)) {
							echo 
								" 
								<tr>
									<td scope='row'>".$row["car_id"]."</td>
									<td>".$row["type"]."</td>
									<td>".$row["adress"]."</td>
									<td>".$row["location"]."</td>
									<td>".$row["car_status"]."</td>
								</tr>
								";
						};
					?>
				</tbody>
			</table>
		</div>
	</div>
</body>
</html>

<?php ob_end_flush(); ?>