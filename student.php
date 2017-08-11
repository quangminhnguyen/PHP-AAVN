<?php 
include 'core/init.php';
include 'head.php';

// echo 'I am student';

if (isset($_SESSION['id']) && !empty($_SESSION['id'])) {
	// echo 'Logged in';
	
	/* If algready signed up. 
	if (has_signed_up($_SESSION['id'])) {
		header('Location: student_view_signed_up.php');
		die();
	}  */

} else {
	echo 'Not logged in';
	header('Location: aavn.php');
	exit();
}
?>

<html>
	<body> 
		<?php include 'layout/header.php' ?>
		
		<!-- User tab -->
		<div class="tab">
			<button class="button_tab" id="student_tab_link1"> <span class="glyphicon glyphicon-ok-sign"> </span> Electives Selection </button>
			
			<button class="button_tab" id="student_tab_link2"> <span class="glyphicon glyphicon-list-alt"> </span>
			Electives Information </button>
			
			<button class="button_tab" id="student_tab_link3"> <span class="fa fa-user-circle fa-fw"> </span> Profile </button>
			
			<a href="user_logout.php"> 
				<button class="button_tab"> <span class="glyphicon glyphicon-log-out"> </span> Sign out </button>
			</a>
		</div>

		<!-- Tab contents-->
		<div class="main-content">

			<!-- Students sign up tab. -->
			<div id="student_tab1" class="tabcontent">
				
				<form name="select_activity">	
					<div class = "panel panel-group">
						<!-- Question 1-->
 						<div class="panel panel-primary">
							<div class="panel-heading">
								<h4 class="panel-title">  What is your most preferred elective? </h4>
							</div>
							
							<div class="panel panel-body">
								<?php  construct_elective_checklist('opinion1'); ?>
							</div>

						</div>

						<!-- Question 2-->
						<div class="panel panel-primary">
							<div class="panel panel-heading">
								<h4 class="panel-title"> What is your second most preferred elective? </h4>
							</div>

							<div class="panel panel-body">
								<?php  construct_elective_checklist('opinion2'); ?>
							</div>
						</div>

						<!-- Question 3-->
						<div class="panel panel-primary">
							<div class="panel panel-heading">
								<h4 class="panel-title"> What is your third most preferred elective? </h4>
							</div>

							<div class="panel panel-body">
								<?php  construct_elective_checklist('opinion3'); ?>
							</div>
						</div>
						<br>
						<button type="button" class="btn btn-danger btn-lg btn-block" id="erease_selection_btn"> <span class="glyphicon glyphicon-erase"> </span> Clear Selection </button>
						<a class="btn btn-primary btn-lg btn-block" id="submit_election_btn"> <span class="glyphicon glyphicon-ok"></span>  Submit  </a>
					</div>
				</form>

			</div>


			<!-- Elective information tab. -->
			<div id="student_tab2" class="tabcontent"> 
			</div>	


			<!-- Student Profile. -->
			<div id="student_tab3" class="tabcontent">
			</div>
		</div>

		<?php include 'layout/bottom.php' ?>
	</body>
</html>

<script type="text/javascript" src="script/student.js"></script>



