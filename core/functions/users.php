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


/* Returns list of electives. */
function get_list_of_electives() {
	$electives = array();

	global $mysqli;
	$result = $mysqli->query("SELECT electiveid, name
								FROM electivesInfo");
	while($elective_name = mysqli_fetch_assoc($result)) {
		array_push($electives, $elective_name);
	} 
	return $electives;
}


/* get list of students who select $elective as their choice number $choice_num*/
function get_list_of_students($elective, $choice_num) {
	global $mysqli;									

	$col_name = '';
	
	if ($choice_num == 1) {
		$col_name = 'elective1';
	} else if ($choice_num == 2) {
		$col_name = 'elective2';
	} else if ($choice_num == 3) {
		$col_name = 'elective3';
	}


	$result = $mysqli->query("SELECT *
								FROM studentOpinion, user
								WHERE id = studentid 
								AND $col_name = '$elective'");
	
	// print_r($result);
	// echo 'num rows: '.mysqli_num_rows($result);


	$student_list = [];
	while ($student = mysqli_fetch_assoc($result)) {
		array_push($student_list, $student);
	}

	return $student_list;
}


/* Adds new user to the user table. */
function add_new_user($email, $password, $name, $nick_name, $class) {
	global $mysqli;

	$mysqli->query("INSERT INTO user (email, password, name, nick_name, class)
		VALUES('$email', '$password', '$name', '$nick_name', '$class')");
}


/* Adds k new users and select their electives randomly. */
function random_create_new_user($k) {
	$char = "0123456789abcdefghijklmnopqrstuvwxyz";
	$len = mt_rand(10, 15);
	for ($i = 1; $i <= $k; $i++) {

		/* Randomly generate email. */
		$email = random_email_generator();
		
		/* Randomly generate password. */
		$password = md5('password');

		/* Randomly generate name. */
		$name = random_name_generator();
		$nick_name = random_name_generator();

		/* Randomly pick a class*/
		$a = array('10A', '10B', '11W', '11C', '12A', '9A');
		$random_keys = array_rand($a , 1);
		$class = $a[$random_keys];

		/* Add user to the database. */
		add_new_user($email, $password, $name, $nick_name, $class);


		/* Randomly pick the electives. */
		$id = get_user_id($email);
		$a = array(1, 2, 3, 4);
		shuffle($a);
		$random_keys = array_rand($a , 3);
		insert_student_elective_opinion($id, $a[$random_keys[0]], $a[$random_keys[1]], $a[$random_keys[2]]);

	}

}

/* Random email generator */
function random_email_generator() {
	$char = '0123456789abcdefghijklmnopqrstuvwxyz';
  	$len = mt_rand(5, 10); /* random length */
  	$address = '';
  	for ($i = 1; $i <= $len; $i++) {
    	$address .= substr($char, mt_rand(0, strlen($char)), 1);
  	}
	$address .= '@aavn.edu.vn';
	return $address;
}


/* random name generator. */
function random_name_generator() {
	$char = 'ab cdef ghij klmn opqr stuv wxyz';
  	$len = mt_rand(10, 20); /* random length */
  	$name = '';
  	for ($i = 1; $i <= $len; $i++) {
    	$name .= substr($char, mt_rand(0, strlen($char)), 1);
  	}

  	return $name;
}


?>