<?php session_start();
header("Content-type: application/json; charset=utf-8");
// error_reporting(0);
require_once("functions.php");

if(esProfesor($_SESSION['user'])){
	if(!empty($_POST)){
		$update = '';
		$argUpd = [':id'=> $_POST['class']];

		if(isset($_POST['video'])){
			$update .= "video = :vid, duracion = :dur";
			$video = getYoutubeID($_POST['video']);
			$argUpd[':vid'] = $video;
			$argUpd[':dur'] = getDuracion($video);
		}
		if(isset($_POST['title'])){
			if(!empty($update)) $update .= ', ';
			$update .= "titulo = :tit";
			$argUpd[':tit'] = limpiarString($_POST['title']);
		}
		if(isset($_POST['date'])){
			if(!empty($update)) $update .= ', ';
			$update .= "fecha = :dat";
			$argUpd[':dat'] = $_POST['date'];
		}
		if(!empty($update)){
			$db = connectDB();
			$ps = $db->prepare("UPDATE clase SET $update WHERE id = :id");
			if(!$ps->execute($argUpd)){
				http_response_code(500);
				echo json_encode(["error"=>"Ocurrió un error en la base de datos", "sqlstate"=>$ps->errorInfo()]);
			}else{
				echo json_encode(["error"=>false, "updated"=>$argUpd]);
			}
		}else http_response_code(404);
	}else http_response_code(404);
}else http_response_code(403);