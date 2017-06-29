
<?php 

// Initialize session and connect to the user database.
include 'core/init.php';

?>

<!DOCTYPE html>
<html>
<head> 
	<title> AAVN website </title>

</head>

<body>
	
	<header>
	</header>
	

	<div id="container">

		<form class="login">

			<div class="input">
				<input type="email" placeholder="Email" required />
			</div>


			<div class="input">
				<input type="password" placeholder="Password" required />
			</div>

			<button type="submit" class="submit"> Login </button>
		
		</form>
	</div>



	<footer>
	</footer>
</body>