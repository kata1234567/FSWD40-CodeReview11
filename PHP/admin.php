<?php
session_start();

$title = "admin";

//if not logged in = redirect
if(empty($_SESSION['user'])){
    header('location: index.php');	
}
//if logged in but not admin = redirect
if($_SESSION['userType']!=='admin'){
    header('location: index.php');
}
?>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "cr11_kathrin_renz_php_car_rental";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin Area</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
  body{
  background-color: #d0d4db ;
}

table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
    border: 1px solid black;
    text-align: left;
    padding: 8px;
      width: 20%;
     background-color: white;
      text-align: center;
    
     
  }
  th{
    color: grey;
  }

tr:nth-child(even) {
    background-color: #dddddd;
}
img{
  width: 120px;
}

h1{
  color: black;
  padding: 40px;
  text-align: center;
}


h1{
  color: black;
  padding: 40px;
  text-align: center;
}

footer{
  padding: 5%;
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

         <li><a href="admin.php">Admin</a></li>
           <li><a href="office_list.php">Office List</a></li>
          <li><a href="cars_list.php">Car List</a></li>
         
       
          <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Car Locations
            <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="cars_locations.php">all</a></li>
              <li><a href="#">Wien Mitte</a></li>
              <li><a href="#">Karlsplatz</a></li>
              <li><a href="#">Westbahnhof</a></li>
              <li><a href="#">Hauptbahnhof</a></li>
            </ul>
          </li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
        </ul>
      </div>
    </div>
  </nav>  
    <div class="container">
      <div class="row">
        <?php
        // Create connection
        $tabelle = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($tabelle->connect_error) {
            die("Connection failed: " . $tabelle->connect_error);
        }
    
        $sql = "SELECT m.name,m.adress, m.city, m.zipCode, m.phone, m.locaEmail, COUNT(m.name) AS anzahl FROM location m, cars n WHERE m.locationId=n.fk_locationId GROUP BY m.name, m.adress, m.city, m.zipCode, m.phone, m.locaEmail";
        $result = mysqli_query($tabelle, $sql);

        echo "
          <h1>Office</h1>
            <table>
            <tr>
            <th>Name</th>
              <th>Adress</th>
              <th>City</th>
              <th>Zip-Code</th>
              <th>Phone</th>
              <th>Email</th>
              <th>Amount of Cars</th>
            </tr>";
        
        while($row = mysqli_fetch_assoc($result)) {

        echo"<tr>
              <td> ". $row["name"] ."</td>
              <td>". $row["adress"] ."</td>
              <td>". $row["city"] ."</td>
              <td>". $row["zipCode"]." </td>
              <td>". $row["phone"] ."</td>
              <td>". $row["locaEmail"] ."</td>
              <td>". $row["anzahl"] ."</td>
              </tr>
            
          ";
        } 
        echo"</table>";
    
        // Free result set
        mysqli_free_result($result);
        // Close connection
        mysqli_close($tabelle);
      ?> 

      </div>
    
    </div>


    
    <footer>
      <center class="container">
        <p class="m-0 text-center">Copyright © Kathrin Renz 2018</p>
      </center>
    </footer>
  </body> 
  <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
</html>