<?php session_start();
if(isset($_SESSION['user'])){
	require_once("api/php/functions.php");
	$db = connectDB();
	$usuario = $db->query("SELECT nombre, sexo FROM usuario WHERE dni = $_SESSION[user]")->fetch(PDO::FETCH_NUM);
	$neverpony = $usuario[0];
	$hombre = $usuario[1];
	
	require_once("views/home-view.php");
}else{
	header("Location: login.php");
}
?>