<?php 
	include 'core/init.php';
	include 'head.php';
?>

<html>
	<body>
		<?php include 'layout/header.php' ?>

		<div>
			<?php
				get_list_of_signedup_electives($_SESSION['id']);
				if (!elective_has_been_confirmed($_SESSION['id'])) {
					echo '<h3> Registration status: </h3> NOT CONFIRMED.';
				} else {
					echo '<h3> Registration status: </h3> CONFIRMED.';
				}
			?>
		</div>
		
		<?php include 'layout/bottom.php' ?>
	</body>
</html>