<?php session_start();
header("Content-type: application/json; charset=utf-8");
error_reporting(0);
require_once("functions.php");

if(esProfesor($_SESSION['user'])){
	if(!empty($_POST)){
		$titulo = limpiarString($_POST['title']);
		$video = getYoutubeID($_POST['video']);
		$curso = $_POST['course'] ?? 1;
		
		$duracion = getDuracion($video);
		$fecha = $_POST['date'];

		$db = connectDB();
		$ps = $db->prepare("INSERT INTO clase(titulo, curso, video, duracion, fecha)
		VALUES (:tit, :cur, :vid, $duracion, $fecha)");
		if(!$ps->execute([
			':cur'=>$curso,
			':vid'=>$video,
			':tit' => $titulo
		])){
			http_response_code(500);
			echo json_encode(['error'=>'Ocurrió un error en la base de datos', 'sqlstate'=>$ps->errorInfo()]);
		}else{
			$clase = $db->lastInsertId();
			echo json_encode(['error'=>false,'inserted'=>[
				$db->query("SELECT * FROM clase WHERE id = $clase", PDO::FETCH_ASSOC)->fetch()
			]]);
			$participantes = $db->query("SELECT estudiante FROM participantes WHERE curso = $curso")->fetchAll(PDO::FETCH_NUM);
			$values = '';
			foreach($participantes as $p){
				if(!empty($values)) $values .= ", ";
				$values .= "($curso, $clase, 0, ".$p[0].")";
			}
			//INSERT INTO vistos(curso, clase, visto, estudiante)
			if(!empty($values)){
				$db->query("INSERT INTO vistos(curso, clase, visto, estudiante) VALUES $values");
			}
		}
	}else{
		http_response_code(404);
	}
}else{
	http_response_code(403);
}
?>