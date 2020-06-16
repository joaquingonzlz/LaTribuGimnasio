<?php
if(isset($_SESSION['user'])){
	require_once("home.html");
}else{
	header("Location: login.html");
}

?>