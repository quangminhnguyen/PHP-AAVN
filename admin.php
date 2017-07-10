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

<html>
	<body> 
		<?php include 'layout/header.php' ?>
		<div class="tab">
			<button> Class Assignment </button>
			<button> Electives Information </button>
			<button> Student Schedule By Class </button>
		</div>

		<div id="tab1" class="tabcontent"> 
			<h3> Class Assignment tab. </h3>
		</div>

		<div id="tab2" class="tabcontent">
			<h3> Elective Information tab. </h3>
		</div>

		<div id="tab3" class="tabcontent"> 
			<h3> Student Schedule By Class </h3>
		</div>

		<?php include 'layout/bottom.php' ?>
	</body>

</html>

<script type="text/javascript" src="script/admin.js"></script>