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
				
			<button class="button_tab" id="tablink1">  <span class="glyphicon glyphicon-edit"></span> Electives Assignment  </button> 
			<button class="button_tab" id="tablink2"> <span class="glyphicon glyphicon-list-alt"></span> Electives Information </button>
			<button class="button_tab dropdown" id="tablink3"> <span class="glyphicon glyphicon-user"></span> Admin Tools </button>
			<a href="user_logout.php"> 
			<button class="button_tab"> <span class="glyphicon glyphicon-log-out"> </span> Sign out </button> 
			</a>
		</div>
		<div id="tab1" class="tabcontent"> 
			<?php include 'core/elective_assignment.php' ?>
		</div>

		<div id="tab2" class="tabcontent">
			<?php include 'core/elective_info.php' ?>
		</div>

		<div id="tab3" class="tabcontent">
			<div>
				<div class="btn-group" role="group">
				  <button type="button" class="btn btn-primary">Add new elective</button>
				  <button type="button" class="btn btn-primary">Edit elective information </button>
				  <button type="button" class="btn btn-primary">Remove elective</button>
				</div>

				<div class="btn-group" role="group">
				  <button type="button" class="btn btn-primary">Add new user</button>
				  <button type="button" class="btn btn-primary">Edit user information </button>
				  <button type="button" class="btn btn-primary">Remove user</button>
				</div>
			</div>
		</div>

		<?php include 'layout/bottom.php' ?>
	</body>

</html>

