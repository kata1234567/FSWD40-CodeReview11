<?php
	ob_start();
	session_start();
	require_once 'dbconnect.php';
	// if session is not set this will redirect to login page
	if( !isset($_SESSION['user']) ) {
		header("Location: index.php");
		exit;
	}
	// select logged-in users detail
	$res=mysqli_query($conn, "SELECT * FROM users WHERE userId=".$_SESSION['user']);
	$userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
	  body{
	  background-color: #d0d4db ;
	}
		.navbar{
			margin-bottom: 0px;
		}
		footer{
	  padding: 3%;
	}
  </style>
</head>
<body>

	<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>                        
	      </button>
	      <a class="navbar-brand" href="index.php">PHP Car Rental Agency</a>
	    </div>
	    <div class="collapse navbar-collapse" id="myNavbar">
	      <ul class="nav navbar-nav">

	        <li class="active"><a href="home.php">Home</a></li>
	        <?php if($_SESSION['userType']=='admin'){ ?>
        <li><a href="admin.php">Admin</a></li> 
        <?php } ?>
	       
	         <li><a href="office_list.php">Office List</a></li>
      		<li><a href="cars_list.php">Car List</a></li>
	       
	     
	        <li class="dropdown">
		        <a class="dropdown-toggle" data-toggle="dropdown" >Car Locations
		        <span class="caret"></span></a>
		        <ul class="dropdown-menu">
		          <li><a href="cars_locations.php">all</a></li>
	              <li><a href="cars_location1.php">Wien Mitte</a></li>
	              <li><a href="cars_location2.php">Karlsplatz</a></li>
	              <li><a href="cars_location3.php">Westbahnhof</a></li>
	              <li><a href="cars_location4.php">Hauptbahnhof</a></li>
		        </ul>
		      </li>
	      </ul>
	      <ul class="nav navbar-nav navbar-right">
	        <li><a class="nav-link" href="#">Hi <?php echo $userRow['userEmail']; ?></a></li>
	        <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
	      </ul>
	    </div>
	  </div>
	</nav>	
  
	
		<img src="img/travel.jpg" width="100%">
	

   		<footer>
			<center class="container">
				<p class="m-0 text-center">Copyright © Kathrin Renz 2018</p>
			</center>
		</footer>


    </body>
</html>
<?php ob_end_flush(); ?>