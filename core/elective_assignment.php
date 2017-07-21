
<form>
<?php 
$electives = get_list_of_electives();
print_r($electives);

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
						<a data-toggle="collapse" href="#collapse'.$collapse_id.'"> '.$tup['name'].' </a>
					</h4>
				</div>'; /* Close the panel heading. */

	echo '      <div id="collapse'.$collapse_id.'" class="panel panel-body collapse panel-collapse">';
	$table_body = '';
	$student_list = get_list_of_students($tup['electiveid'], 1);
	// print_r($student_list);
	$num_student = 0; 
	foreach($student_list as $student) {
		$num_student += 1;
		$table_body .= '<tr>
							<td>'.$student['name'].'</td>
							<td>'.$student['name'].'</td>
							<td>'.$student['nick_name'].'</td>
							<td>'.$student['email'].'</td>
							<td>'.$student['class'].'</td>';

		foreach($electives as $tuple) {
			$electiveid = $tuple['electiveid'];
			if (($electiveid == $student['elective1']) ||  ($electiveid == $student['elective2']) || ($electiveid == $student['elective3'])) {

				if ($electiveid == $student['elective1']) {
					$table_body .= '<td> <input type="radio" name="'.$student['name'].'" value= '.$electiveid.' checked> </td>';
				} else {
					$table_body .= '<td> <input type="radio" name="'.$student['name'].'" value= '.$electiveid.'> </td>';
				}


			} else {
				$table_body .= '<td> <input type="radio" name="'.$student['name'].'" value= '.$electiveid.' disabled> </td>';
			}
		}

		$table_body .= '</tr>';

	}

	echo '
		<table class="table table-hover table-responsive">
			<thead>
				<tr> 
				<th> First Name </th>
				<th> Last Name </th>
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
	echo '<div class="panel-footer">
			<div class="row">  
				<div class="col-sm-4"> Instructor: '.$tup['teacher_name'].' </div>
				<div class="col-sm-4"> '.$num_student.' students </div>
				<div class="col-sm-4"> col3 </div>
			</div>
		 </div>';
	echo '</div>'; /* Close the panel. */

	$collapse_id += 1;
}
echo '</div>'; /* Close the panel group. */
?>
</form>
