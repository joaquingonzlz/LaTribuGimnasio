<?php session_start();
header("Content-type: application/json; charset=utf-8");
error_reporting(0);
require_once("functions.php");

if(!esProfesor($_SESSION['user'])) http_response_code(403);
else if(empty($_POST)) http_response_code(404);
else{
	$nombre = limpiarString($_POST['name']);
	$descripcion = limpiarString($_POST['description']);
	$anuncio = empty($_POST['anuncio']) ? "Bienvenido al curso $nombre!" : limpiarString($_POST['anuncio']);

	$db = connectDB();
	$ps = $db->prepare("INSERT INTO curso(nombre, descripcion, anuncio, fecha_anuncio)
	VALUES (:n, :d, :a, ".date_create()->getTimestamp().")");
	if(!$ps->execute([':n'=>$nombre, ':d'=>$descripcion, ':a'=>$anuncio])){
		http_response_code(500);
		echo json_encode(["error"=> "Ocurrió un error en la base de datos", "sqlstate"=>$ps->errorInfo()]);
	}else{
		echo json_encode([
			"error"=>false, "inserted"=> [
				'nombre'=>$nombre,
				'id' => $db->lastInsertId()
			]
		]);
	}
}
?>