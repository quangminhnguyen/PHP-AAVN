
<?php 

// Initialize session and connect to the user database.
include 'core/init.php';
include 'head.php';
?>

<!DOCTYPE html>
<html>
	<body>
		<?php include 'layout/header.php' ?>

		<div id="container">
			<h4> <?php include 'user_login.php'; ?> </h4>

			<form class="login" action="aavn.php" method="post">
				<div class="input">
					<input type="email" placeholder="Email" name="email" required/>
				</div>

				<div class="input">
					<input type="password" placeholder="Password" name="password" required/>
				</div>

				<button type="submit"> Login </button>
			</form>
		</div>


		<?php include 'layout/bottom.php' ?>
	</body>
</html>