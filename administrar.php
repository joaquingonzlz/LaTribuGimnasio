<?php session_start();
require_once("api/php/functions.php");
if(!esProfesor($_SESSION['user'])) http_response_code(403);
else{
	$db = connectDB();
	$cursos = $db->query("SELECT id, nombre FROM curso")->fetchAll(PDO::FETCH_ASSOC);
	$users = $db->query("SELECT dni, nombre, apellido, es_profe FROM usuario")->fetchAll(PDO::FETCH_ASSOC);
	include_once("views/administracion-view.php");
}
?>