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
		echo '<input type="radio" name="'.$name.'" value="'.$elective['electiveid'].'">'.$elective['name'].'</input>';
	}

}


function insert_student_elective_opinion($id, $opinion1, $opinion2, $opinion3) {
	global $mysqli;
	$mysqli->query("INSERT INTO studentOpinion (studentid, elective1, elective2, elective3)
		VALUES ('$id', '$opinion1', '$opinion2', '$opinion3')");
}


function update_student_signed_up_status($id) {
	global $mysqli;
	$mysqli->query("UPDATE user SET signed_up=1 WHERE id='$id'");
}


function get_list_of_signedup_electives($id) {
	global $mysqli;
	$result = $mysqli->query("SELECT * 
							FROM user, studentOpinion, electiveInfo AS eIA, electiveInfo AS eIB, electiveInfo AS eIC
							WHERE studentid = '$id' AND id = studentid AND elective1 = eIA.electiveid AND elective2 = eIB.electiveid AND elective3 = eIC.electiveid");
	$result = mysqli_fetch_assoc($result);
	echo $result;
}



?>