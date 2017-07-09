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
	$result = $mysqli->query("SELECT eIA.name AS elective1, eIB.name AS elective2, eIC.name AS elective3, eIA.teacher_name as teach_elective1, eIB.teacher_name as teach_elective2, eIC.teacher_name as teach_elective3, eIA.description as description1, eIB.description as description2, eIC.description as description3
							FROM user, studentOpinion, electivesInfo AS eIA, electivesInfo AS eIB, electivesInfo AS eIC
							WHERE studentid = '$id' AND id = studentid AND elective1 = eIA.electiveid AND elective2 = eIB.electiveid AND elective3 = eIC.electiveid");

	echo '<h3> Selected electives: </h3>';
	echo '<br>';
	
	$record = mysqli_fetch_assoc($result); 
	echo 'Opinion 1: '.$record['elective1'];
	echo '<br>';

	echo 'Opinion 2: '.$record['elective2'];
	echo '<br>';

	echo 'Opinion 3: '.$record['elective3'];
	echo '<br>';
		
}


/* Returns whether the student has already signed up. */
function has_signed_up($id) {
	global $mysqli;
	$result = $mysqli->query("SELECT 1 
								FROM user 
								WHERE id = '$id' AND signed_up = 1");

	if ($result->num_rows == 1) {
		return True;
	}

	return False;
}



/* Returns whether the student elective selection has been confirmed.*/
function elective_has_been_confirmed($id){
	global $mysqli;
	$result = $mysqli->query("SELECT 1 
								FROM user 
								WHERE id = '$id' AND elective_confirm = 1");

	if ($result->num_rows == 1) {
		return True;
	}

	return False;
}



?>