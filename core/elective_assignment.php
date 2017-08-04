<!-- PART 1: Handle assignment (server side) -->
<?php

//clear_user();
//clear_student_opinion();
//clear_student_assignment();


/* Handle elective assignment. */
if (!empty($_POST) === true) {
	// print_r($_POST);
	clear_student_assignment();
	foreach($_POST as $studentid => $electiveid) {
		make_assignment($studentid, $electiveid);
	}
}

?>

<!-- PART 2: Construct Assignment form -->
<form action="admin.php" method="post">

<?php 
$electives = get_list_of_electives();
// print_r($electives);

/* Construct a list of table headers which are name of the electives. */
$electives_str = '';
foreach($electives as $tuple) {
	$electives_str .= '<th>'.ucfirst($tuple['name']).'</th>';
}
echo '<div class = "panel panel-group">';
$collapse_id = 0;
foreach($electives as $tup) {
	// print_r(get_student_assignment($tup['electiveid'],1));
	echo '<div class="panel panel-primary">
				<div class="panel-heading"> 
					<h4 class="panel-title">
						<a data-toggle="collapse" href="#collapse'.$collapse_id.'"> '.$tup['name'].' </a>
					</h4>
				</div>'; /* Close the panel heading. */

	echo '      <div id="collapse'.$collapse_id.'" class="panel panel-body collapse panel-collapse">';
	$table_body = '';

	/* Get list of students who select this elective as their First choice. */
	$student_list = get_list_of_students($tup['electiveid'], 1);


	# Counting number of student selects this elective as their first choice.
	$num_student = 0; 

	# Count number of student was reassigned.
	$num_of_reassignment = 0;

	foreach($student_list as $student) {
		$num_student += 1;

		/* $student_status indicates whether the student's selected elective has been confirmed. */
		$student_status = '&#10060';
		if ($student['elective_confirm'] == 1) {
			$student_status = '&#9989';
		}

		$table_body .= '<tr test="alo">
							<td align="center">'.$student_status.'</td>
							<td>'.$student['first_name'].'</td>
							<td>'.$student['nick_name'].'</td>
							<td>'.$student['email'].'</td>
							<td>'.$student['class'].'</td>';

		foreach($electives as $tuple) {
			$electiveid = $tuple['electiveid'];
			if (($electiveid == $student['elective1']) ||  ($electiveid == $student['elective2']) || ($electiveid == $student['elective3'])) {

				$temp = $student['elective1'];
				if (elective_has_been_confirmed($student['id'])) {
					$temp = get_assign_elective($student['id']);
					// echo 'test'.$temp;
				}

				if ($electiveid == $temp) {
					/* If the elective that the students were assigned to are different from the student's first choice, it mean that the students have been reassigned. */
					if ($electiveid != $student['elective1']) {
						$num_of_reassignment += 1;
					} 
					$table_body .= '<td align="center"> <input type="radio" name="'.$student['id'].'" value= '.$electiveid.' checked> </td>';
				} else {
					$table_body .= '<td align="center"> <input type="radio" name="'.$student['id'].'" value= '.$electiveid.'> </td>';
				}


			} else {
				$table_body .= '<td align="center"> <input type="radio" name="'.$student['id'].'" value= '.$electiveid.' disabled> </td>';
			}
		}

		$table_body .= '</tr>';

	}

	echo '
		<table class="table table-hover table-responsive">
			<thead>
				<tr> 
				<th> Confirm </th>
				<th> First Name </th>
				<th> Nick Name </th>
				<th> Email </th>
				<th> Class </th>
				'.$electives_str.'</tr>
			</thead>
			<tbody>'. $table_body. 
			'</tbody>
		</table>
		';

	echo '</div>'; /* Close the panel-body*/

	$info1 = '';
	if ($num_student == 0) {
		$info1 .= 'No students selected this elective as their first choice.';
	} elseif ($num_student == 1) {
		$info1 .= '1 student selected this elective as their first choice. ';
	} else {
		$info1 .= $num_student.' students selected this elective as their first choice. ';
	}

	$info2 = '';
	if ($num_student == 1) {
		$info2 .= 'No students were reassigned.';
	} elseif ($num_of_reassignment == 1) {
		$info2 .= '1 student was reassigned.';
	} else {
		$info2 .= $num_of_reassignment.' students were reassigned.';
	}

	echo '<div class="panel-footer">
			<div class="row">  
				<div class="col-sm-3"> Instructed by '.$tup['teacher_name'].' </div>
				<div class="col-sm-6"> '.$info1.''.$info2.'</div>
				<div class="col-sm-3"> 
					<a data-toggle="collapse" href="#collapse'.$collapse_id.'"> 
						<span class="pull-right glyphicon glyphicon-chevron-down"> </span>
					</a>
				</div>
			</div>
		 </div>';
	echo '</div>'; /* Close the panel. */

	$collapse_id += 1;
}
echo '</div>'; /* Close the panel group. */
?>

<button class='btn btn-primary btn-lg btn-block' type="submit"> <span class="glyphicon glyphicon-save
"></span> Save Assignment </button>
</form>
