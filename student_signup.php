<?php
	include 'core/init.php';
	include 'head.php';
	
	if (!empty($_POST) === true) {
		$opinion1 = $_POST['opinion1'];
		$opinion2 = $_POST['opinion2'];
		$opinion3 = $_POST['opinion3'];
		$id =  $_SESSION['id'];
	
		echo $id;
		echo $opinion1;
		echo $opinion2;
		echo $opinion3;
		

		insert_student_elective_opinion($id, $opinion1, $opinion2, $opinion3);

		update_student_signed_up_status($id);

		header('Location: student_view_signed_up.php');
		die();
	}
?>