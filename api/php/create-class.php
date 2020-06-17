<?php session_start();
header("Content-type: application/json; charset=utf-8");
error_reporting(0);
require_once("functions.php");

if(esProfesor($_SESSION['user'])){
	if(!empty($_POST)){
		$video = getYoutubeID($_POST['video']);
		$curso = $_POST['course'] ?? 1;
		$descripcion = mb_strimwidth(limpiarString($_POST['description'] ?? ''),0,255);
		
		$duracion = getDuracion($video);
		$fecha = (new DateTime('now', $timezone))->format("Y-m-d");

		$db = connectDB();
		$ps = $db->prepare("INSERT INTO clases(curso, video, duracion, descripcion, fecha)
		VALUES (:cur, :vid, $duracion, :des, $fecha)");
		if(!$ps->execute([
			':cur'=>$curso,
			':vid'=>$video,
			':des'=>$descripcion
		])){
			echo json_encode(['error'=>'Ocurrió un error en la base de datos', 'sqlstate'=>$ps->errorInfo()]);
		}else{
			echo json_encode(['error'=>false,'inserted'=>[
				$ps->fetch()
			]]);
		}
	}else{
		http_response_code(404);
	}
}else{
	http_response_code(403);
}
?>