<?php session_start();
require_once("api/php/functions.php");
if(!esParticipante($_SESSION['user'], getCourse($_GET['course']))) http_response_code(403);
else if(empty($_GET) || !isset($_GET['curso'])) http_response_code(404);
else{
	$curso = getCourse($_GET['course']);
	$db = connectDB();
	$ps = $db->prepare("SELECT * FROM curso WHERE id = :id");
	if(!$ps->execute([':id'=>$curso])) {
		http_response_code(500);
		exit;
	}
	$res = $ps->fetchAll(PDO::FETCH_ASSOC);
	if(count($res) !== 1) {
		http_response_code(404);
		exit;
	}
	$datos_curso = $res[0];

	//Buscar las clases de este curso
	$ps = $db->prepare("SELECT * FROM clase WHERE curso = :curso ORDER BY id");
	if(!$ps->execute([':curso'=>$curso])){
		http_response_code(500);
		exit;
	}
	$clases = $ps->fetchAll(PDO::FETCH_ASSOC);

	// Ver si cada clase fue vista por el alumno ingresado
	if(!esProfesor($_SESSION['user'])){
		$ps = $db->prepare("SELECT  clase, visto FROM vistos WHERE estudiante = :est AND curso = :cur ORDER BY clase");
		if(!$ps->execute([':cur'=>$curso, ':est'=>$_SESSION['user']])){
			http_response_code(500);
			exit;
		}
		$vistos = $ps->fetchAll(PDO::FETCH_ASSOC);
	}
	include_once("views/curso-view.php");
}
?>