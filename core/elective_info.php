
<?php 
$electives = get_list_of_electives();

/* Construct a list of table headers which are name of the electives. */
$electives_str = '';
foreach($electives as $tuple) {
	$electives_str .= '<th>'.ucfirst($tuple['name']).'</th>';
}

echo '<div class = "panel panel-group">';
$collapse_id = 0;
foreach($electives as $tup) {

	echo '<div class="panel panel-primary">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" href="#collapseb'.$collapse_id.'"> '.$tup['name'].' </a>
				</h4>
			</div>'; /* Close the panel heading. */

	echo '  <div id="collapseb'.$collapse_id.'" class="panel panel-body collapse panel-collapse">';

	// echo $tup['electiveid'];

	$student_elective = get_students_take_elective($tup['electiveid']);

	/* Counting the number of students who are in this class. */
	$num_student = 0;

	/* Table body. */
	$table_body = '<tbody>';
	foreach($student_elective as $student) {
		$num_student += 1;

		$table_body .= '<tr>
							<td>'.$student['first_name'].'</td>
							<td>'.$student['last_name'].'</td>
							<td>'.$student['nick_name'].'</td>
							<td>'.$student['email'].'</td>
							<td>'.$student['class'].'</td>';

		$table_body .= '</tr>';
	}
	$table_body .= '</tbody>';

	/* Table header. */
	$table_head = '<thead>
						<tr>
						<th> First Name </th>
						<th> Last Name </th>
						<th> Nick Name </th>
						<th> Email </th>
						<th> Class </th>
						</tr> 
					</thead>';

	echo '<table class="table table-hover table-responsive">'.$table_head.$table_body.'</table>';
	echo '	</div>'; /* Close the panel-body */

	$mess = '';
	if ($num_student <= 1) {
		$mess .= $num_student.' student enrolled in the class.';
	} else {
		$mess .= $num_student.' students enrolled in the class.';
	}

	echo '<div class="panel-footer">
			<div class="row">  
				<div class="col-sm-9"> Instructed by '.$tup['teacher_name'].' </div>
				
				<div class="col-sm-3">
					<text>
						'.$mess.'
					</text>
				</div>
			</div>
			<div>
				'.$tup['description'].' 
			</div>
			<div class="row">
				<div class="col-sm-9">
		
				</div>
				<div class="col-sm-3">
					<a data-toggle="collapse" href="#collapseb'.$collapse_id.'"> 
						<span class="pull-right glyphicon glyphicon-chevron-down"> </span>
					</a>
				</div>
			</div>
		 </div>';

	$collapse_id += 1;
	
	echo '</div>'; /* Close the panel for this elective. */
}

echo '</div>'; /* Close the panel group */
?>

<button class='btn btn-primary btn-block btn-lg' id="unenroll-btn"> <span class="glyphicon glyphicon-alert" > </span> Unenroll All Students </button>


