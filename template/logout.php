<?php
	include_once '../config/dbconfig.php';
	session_start();
	session_destroy();
	unset($_SESSION['user_session']);
	$user->redirect('../index');
?>