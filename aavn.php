
<?php 

// Initialize session and connect to the user database.
include 'core/init.php';
include 'head.php';
// random_create_new_user(20);
?>

<!DOCTYPE html>
<html>
	<body>
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