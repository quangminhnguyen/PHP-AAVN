<?php 

// Check if the user exists in the database.
function user_exists($email, $password) {
	global $mysqli;
	$result = $mysqli->query("SELECT * FROM user");	

	while($user = mysqli_fetch_assoc($result)) {
		if($user['email'] == $email && $user['password'] == md5($password)) {
			return True;
		} 
	}
	return False;
}

// Get a user id given an email address.
function get_user_id($email) {
	global $mysqli;
	// $email = $mysqli->real_escape_string($email);
	$result = $mysqli->query("SELECT id FROM user WHERE email = '$email' ");
	// echo 'num of rows: '.$result->num_rows;
	$user = mysqli_fetch_assoc($result);

	return $user['id'];
}


function construct_elective_dropdown($name) {
	global $mysqli;
	$result = $mysqli->query("SELECT * FROM electivesInfo");

	echo '<select name="'.$name.'">';
	while($elective = mysqli_fetch_assoc($result)) {
		echo '<option value="'.$elective['name'].'">'.$elective['name'].'</option>';
	}
	echo '</select>';
}


function construct_elective_checklist($name) {
	global $mysqli;
	$result = $mysqli->query("SELECT * FROM electivesInfo");

	while($elective = mysqli_fetch_assoc($result)) {
		echo '<input type="radio" name="'.$name.'" value="'.$elective['name'].'">'.$elective['name'].'</input>';
	}

}

?>