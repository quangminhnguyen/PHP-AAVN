<?php 
include 'core/init.php';
include 'head.php';


// echo 'I am admin';
// echo $_SESSION['id'];

if (isset($_SESSION['id'])) {
	// echo 'Logged in';
} else {
	// echo 'Not logged in';
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

