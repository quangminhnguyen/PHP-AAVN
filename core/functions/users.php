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
	global mysqli;
	$result = $mysqli->query("SELECT id FROM user WHERE user.email = $email");

	$user = mysqli_fetch_assoc($result);
	return $user['id'];
}


?>