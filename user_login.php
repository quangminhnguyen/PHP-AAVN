
<?php 


// include 'core/init.php';
// include 'head.php';


if (!empty($_POST) === true) {
	$mail = $_POST['email'];
	$password = $_POST['password'];
	$login_page = 'aavn.php';
	$admin_page = 'admin.php';
	$student_page = 'student.php';
	$main_page = 'aavn.php';

	// echo $mail;
	// echo $password;

	if (empty($mail) === true || empty($password) === true) {
		// echo 'error';
		$error = 'You need to enter both user name and password';


	// If the mail & password is there, check if they are correct.
	} else {

		// Check if the user exists in the database.
		if (user_exists($mail, $password) === false) {
			
			echo $error = 'Invalid user id and password';
			// header('Location: '.$main_page);
			// exit();
		// If the user exists in the database
		} else {

			// Get the user id.
			$id = get_user_id($mail);	
			$_SESSION['id'] = $id;

			// if the id is 1, redirects to the admin page.
			if ($id == 1) {
				header('Location: '.$admin_page);

			// if the the id is other than 1, directs to student page.
			} else {

				header('Location: '.$student_page);
			}
			die();
		}
	}
}

?>

