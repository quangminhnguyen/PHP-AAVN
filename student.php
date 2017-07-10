<?php 
include 'core/init.php';
include 'head.php';

echo 'I am student';

if (isset($_SESSION['id'])) {
	echo 'Logged in';

	/* If algready signed up. */
	if (has_signed_up($_SESSION['id'])) {
		header('Location: student_view_signed_up.php');
		die();
	} 

} else {
	echo 'Not logged in';
}
?>

<html>
	<body> 
		<?php include 'layout/header.php' ?>
		

		<form name="select_activity" action="student_signup.php" method="post">	
			<div>
				<?php  construct_elective_checklist('opinion1'); ?>
			</div>
			
			<div>
				<?php  construct_elective_checklist('opinion2'); ?>
			</div>
			
			<div>
				<?php  construct_elective_checklist('opinion3'); ?>
			</div>
			<button type="submit"> Submit  </button>
			<button type="button" id="reset_but"> Reset </button> 
		</form>

		<?php include 'layout/bottom.php' ?>
	</body>
</html>

<script type="text/javascript" src="script/student.js"></script>



