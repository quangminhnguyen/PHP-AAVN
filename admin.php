<?php 
include 'core/init.php';
include 'head.php';

echo 'I am admin';
echo $_SESSION['id'];

if (isset($_SESSION['id'])) {
	echo 'Logged in';
} else {
	echo 'Not logged in';
}
?>

<html>
	<body> 
		<?php include 'layout/header.php' ?>
			
		<?php include 'layout/bottom.php' ?>
	</body>
</html>