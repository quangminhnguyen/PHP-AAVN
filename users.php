<?php
	include 'core/init.php';
	
	$response_array = [];

	if ((isset($_POST) === true) && (isset($_POST['action']) === true)) {
		$action = $_POST['action'];
		// echo 'helo';

		/* Only the admin can perform this action. */
		if ($action == 'unenroll') {

			if (isset($_POST['student_id'])) {
				$student_id = $_POST['student_id'];
				
				/* Unassign all students. */
				if ($student_id == 'all') {
					unassign_all_user();
					$response_array['status'] = 'success';
				
				/* Unassign a specific student. */
				} else {
					if (user_exists_id($student_id) === true) { 
						unassign_a_user((int) $student_id);
						$response_array['status'] = 'success';
					} else {
						$response_array['status'] = 'error';
					}
				}

			} else {
				$response_array['status'] = 'error';	
			}

			/* Returns the response message. */
			header('Content-type: application/json');
			echo json_encode(($response_array));
		} 
	}
?>