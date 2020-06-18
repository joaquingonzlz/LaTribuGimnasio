<?php session_start();
if(isset($_SESSION['user'])){
	require_once("api/php/functions.php");
	$db = connectDB();
	$cursos = esProfesor($_SESSION['user']) ?
		$db->query("SELECT 0 as progreso, c.id, c.nombre, c.descripcion FROM curso c")->fetchAll(PDO::FETCH_ASSOC):
		$db->query("SELECT p.progreso, c.id, c.nombre, c.descripcion
			FROM participantes p INNER JOIN curso c ON (p.curso = c.id)
			WHERE p.estudiante = $_SESSION[user]"
		)->fetchAll(PDO::FETCH_ASSOC)
	;
	$usuario = $db->query("SELECT nombre, sexo FROM usuario WHERE dni = $_SESSION[user]")->fetch(PDO::FETCH_NUM);
	$neverpony = $usuario[0];
	$hombre = $usuario[1];
	
	require_once("views/home-view.php");
}else{
	header("Location: login.php");
}
?>