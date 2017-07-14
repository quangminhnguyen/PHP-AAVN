<?php 
include 'core/init.php';
include 'head.php';


// echo 'I am admin';
// echo $_SESSION['id'];

if (isset($_SESSION['id'])) {
	// echo 'Logged in';
} else {
	echo 'Not logged in';
	header('Location: aavn.php');
	exit();
}
?>
<script type="text/javascript" src="script/admin.js"></script>
<html>
	<body> 
		<?php include 'layout/header.php' ?>
		<div class="tab">
				
			<button class="button_tab" id="tablink1">  <span class="glyphicon glyphicon glyphicon-edit"></span> Electives Assignment  </button> 
			<button class="button_tab" id="tablink2"> <span class="glyphicon glyphicon glyphicon-list-alt"></span> Electives Information </button>
			<button class="button_tab" id="tablink3"> <span class="glyphicon glyphicon glyphicon-calendar"></span> Student Schedule By Class </button>

		</div>

		<div id="tab1" class="tabcontent"> 
			<h3> Class Assignment Tab. </h3>
			<?php
				random_create_new_user(20);

				$electives = get_list_of_electives();
				print_r($electives); 
				// echo $electives[0]['name'];
				echo '<br>';
				foreach($electives as $tuple) {
					echo $tuple['name'];
					echo '<br>';
					$student_list = get_list_of_students($tuple['electiveid'], 1);
					foreach($student_list as $student) {
						echo $student['name'].'<br>';
					}
					echo '-------------<br>';
				}
			?>

		</div>

		<div id="tab2" class="tabcontent">
			<h3> Elective Information Tab. </h3>
		</div>

		<div id="tab3" class="tabcontent"> 
			<h3> Student Schedule By Class </h3>
		</div>

		<?php include 'layout/bottom.php' ?>
	</body>

</html>

