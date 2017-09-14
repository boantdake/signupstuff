<?php 

include('includes/db.php');


?>

<!DOCTYPE html>
<html  lang="en">
		<head>
			<meta charset="UTF-8">
			<title>Collector Project</title>
 			
			<!-- bootstrap 3.3.7 cdn css -->
			<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
			<!-- stylesheet -->
			<link rel="stylesheet" type="text/css" href="css/custom.css">
		</head>

			<body>
			<div class="container">
				<form class="form-container" action="includes/receiver.php" method="POST" >
					<input type="hidden" name="formID" value="optin" />
					<input type="hidden" name="successredirecturl" value="Success.php"> <!-- this value is submitted with the form in case of success and the value tells php where to send the user -->
					<input type="hidden" name="rejectredirecturl" value="Fail.php"> <!-- this does the opposite of the prior -->
					<div class="form-title"><h2>Sign up!</h2></div>
					<div class="form-title">First Name</div>
						<input class="form-field" type="text" name="firstName" required/><br />
					<div class="form-title">Last Name</div>
						<input class="form-field" type="text" name="lastName" required/><br />
					<div class="form-title">Email</div>
						<input class="form-field" type="email" name="EMAIL" required/><br />
					<div class="submit-container">
						<input class="submit-button" type="submit" value="Submit" />
					</div>
				</form>
			</div>
		

			    <!-- Jquery CDN -->
	 			<script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
	 			<!-- <!-- bootstrap 3.3.7 cdn js 
				<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->
				<!-- javascript custom -->
				<script src="js/js1.js" type="text/javascript"></script>
			</body>

</html>
