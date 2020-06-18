<?php session_start();
if(isset($_SESSION['user'])){
	header("Location: /");
} else
	include_once("views/login-view.php");
?>