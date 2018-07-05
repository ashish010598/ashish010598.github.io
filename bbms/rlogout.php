<?php
	session_start();
	session_destroy();
	header('Location: reception.php');
?>
