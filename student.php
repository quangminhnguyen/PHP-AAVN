<?php 
include 'core/init.php';
include 'head.php';

echo 'I am student';

if (isset($_SESSION['id'])) {
	echo 'Logged in';
} else {
	echo 'Not logged in';
}
?>

<html>
	<body> 
		<?php include 'layout/header.php' ?>
		

		<form name="select_activity">	
			<div>
				<?php  construct_elective_checklist('opinion1'); ?>
			</div>
			
			<div>
				<?php  construct_elective_checklist('opinion2'); ?>
			</div>
			
			<div>
				<?php  construct_elective_checklist('opinion3'); ?>
			</div>
			<button type="button"> Submit  </button>
			<button type="button" id="reset_but"> Reset </button> 
		</form>

		<?php include 'layout/bottom.php' ?>
	</body>
</html>



