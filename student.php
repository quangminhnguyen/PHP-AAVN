<?php 
include 'core/init.php';
include 'head.php';

echo 'I am student';

if (isset($_SESSION['id'])) {
	echo 'Logged in';
} else {
	echo 'Not logged in';
}
?>