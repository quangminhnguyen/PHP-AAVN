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