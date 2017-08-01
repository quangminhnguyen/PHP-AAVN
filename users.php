<?php
	include 'core/init.php';
	include 'head.php';
	
	if ((isset($_POST) === true) && (isset($_POST['action']) === true)) {
		$action = $_POST['action'];
		// echo 'helo';

		/* Only the admin can perform this action. */
		if ($action == 'unenroll') {

			if (isset($_POST['student_id'])) {
				$student_id = $_POST['student_id'];
					
				if ($student_id == 'all') {
					unassign_all_user();
					echo 'success';
				} else {
					echo '';
				}

			} else {
				echo '';	
			}
		} 
	}
?>