
<?php 

// Initialize session and connect to the user database.
include 'core/init.php';
include 'head.php';


if (!empty($_POST) === true) {
	$mail = $_POST['email'];
	$password = $_POST['password'];
	$admin_page = 'http://localhost/aavn/core/admin.php';
	$student_page = 'http://localhost/aavn/core/student.php';

	// echo $mail;
	// echo $password;

	if (empty($mail) === true || empty($password) === true) {
		echo 'error';

	// If the mail & password is there, check if they are correct.
	} else {

		// Check if the user exists in the database.
		if (user_exists($mail, $password) === false) {
			echo 'the user does not exist';
		
		// If the user exists in the database
		} else {

			// if the id is 1, redirects to the admin page.
			header('Location: '.$admin_page);

			// if the the id is other than 1, directs to student page.
			header('student_page: '.$student_page);

		}
	}
}

?>

