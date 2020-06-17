<?php session_start();
header("Content-type: application/json; charset=utf-8");
error_reporting(0);
require_once("functions.php");

if(esProfesor($_SESSION['user'])){
	if(!empty($_POST)){
		$update = '';
		$argUpd = [':id'=> base64_decode($_GET['class_id'])];

		if(isset($_POST['video'])){
			$update .= "video = :vid, duracion = :dur";
			$video = getYoutubeID($_POST['video']);
			$argUpd[':vid'] = $video;
			$argUpd[':dur'] = getDuracion($video);
		}
		if(isset($_POST['description'])){
			if(!empty($update)) $update .= ', ';
			$update .= "descripcion = :des";
			$argUpd[':des'] = mb_strimwidth(limpiarString($_POST['description']),0, 255);
		}
		if(isset($_POST['course'])){
			if(!empty($update)) $update .= ', ';
			$update .= "curso = :cur";
			$argUpd[':cur'] = limpiarInt($_POST['course']);
		}
		if(!empty($update)){
			$db = connectDB();
			$ps = $db->prepare("UPDATE clases SET $update WHERE id = :id");
			if(!$ps->execute($argUpd)){
				json_encode(["error"=>"Ocurrió un error en la base de datos", "sqlstate"=>$ps->errorInfo()]);
			}else{
				json_encode(["error"=>false, "updated"=>$ps->fetch()]);
			}
		}else http_response_code(404);
	}else http_response_code(404);
}else http_response_code(403);