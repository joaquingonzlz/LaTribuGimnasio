<?php session_start();
header("Content-type: application/json; charset=utf-8");
// error_reporting(0);
require_once("functions.php");
if(!esProfesor($_SESSION['user'])) http_response_code(403);
else if(empty($_POST)) http_response_code(404);
else{
	$curso = $_POST['curso'];
	$update = '';
	$argUpd = [':id' => $curso];
	if(isset($_POST['description'])){
		$update .= "descripcion = :des";
		$argUpd[':des'] = $_POST['description'];
	}
	if(isset($_POST['new'])){
		if(!empty($update)) $update .= ", ";
		$update .= "anuncio = :an, fecha_anuncio = :fa";
		$argUpd[':an'] = $_POST['new'];
		$argUpd[':fa'] = date_create()->getTimestamp();
		$anuncios = "UPDATE participantes SET anuncio = 1 WHERE curso = $curso";
	}
	if(isset($_POST['name'])){
		if(!empty($update)) $update .= ", ";
		$update .= "nombre = :nom";
		$argUpd[':nom'] = limpiarString($_POST['name']);
	}
	if(!empty($update)){
		$db = connectDB();
		$ps = $db->prepare("UPDATE curso SET $update WHERE id = :id");
		if(!$ps->execute($argUpd)){
			echo json_encode(["error"=> "Ocurrió un error en la base de datos", "sqlstate"=>$ps->errorInfo()]);
			http_response_code(500);
		}else{
			echo json_encode(["error"=>false, "updated"=>$ps->fetchAll(PDO::FETCH_ASSOC)]);
			if(isset($anuncios)) $db->query($anuncios);
		}
	}
}
?>