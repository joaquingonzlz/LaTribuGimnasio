<?php session_start();
require_once("api/php/functions.php");
if(!esProfesor($_SESSION['user'])) http_response_code(403);
else if(empty($_GET) || !isset($_GET['course'])) http_response_code(404);
else{
	$db = connectDB();
	$cID = getCourse($_GET['course']);
	$curso = $db->query("SELECT * FROM curso WHERE id = $cID")->fetch(PDO::FETCH_ASSOC);
	if(!$curso || empty($curso)) http_response_code(404);
	else{
		$clases = $db->query("SELECT * FROM clase WHERE curso = $cID")->fetchAll(PDO::FETCH_ASSOC);
		include_once("views/editar-curso-view.php");
	}
}
?>