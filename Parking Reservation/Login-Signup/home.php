<?php 
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['id']) || !isset($_SESSION['fname'])) {
    // Redirect to error page
    header('Location: error.php');
    exit;
}
	// Check if the user is logged in
if (isset($_SESSION['id']) && isset($_SESSION['fname'])) {

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="d-flex justify-content-center align-items-center vh-100">
    	
    	<div class="shadow w-450 p-3 text-center">
            <h3 class="display-4 ">Hello, <?=$_SESSION['fname']?></h3>

			<a href="Park.php" class="btn btn-primary">Go to Table Map</a>    
			<a href="http://localhost/reserve/" class="btn btn-primary">Go to Reservation</a>    

            <a href="logout.php" class="btn btn-warning">
            	Logout
            </a>
		</div>
		
	</div>
</body>
</html>

<?php }else {
	header("Location: login.php");
	exit;
}

?>






