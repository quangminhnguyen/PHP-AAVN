<?php 
session_start();
session_destroy();
header('Location: aavn.php');
exit();
?>