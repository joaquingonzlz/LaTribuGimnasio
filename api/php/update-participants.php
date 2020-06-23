<?php session_start();
header("Content-type: application/json; utf=8");
error_reporting(0);
require_once("functions.php");
if(!isset($_SESSION['user'])) http_response_code(403);
else if(empty($_POST) || !isset($_POST['course'])) http_response_code(404);
else if(esProfesor($_SESSION['user'])) {echo json_encode(['error'=>false]); exit;}
else{
	$user = $_SESSION['user'];
	$curso = getCourse($_POST['course']);
	$upd = '';
	$argUpd = [':dni' => $user, ':cur'=>$curso];
	if(isset($_POST['last-seen'])){
		$video = $_POST['last-seen'];
		$upd .= "ultimo_visto = :uv";
		$argUpd[':uv'] = $video;
	}
	if(isset($_POST['clear_new'])){
		if(!empty($upd)) $upd .= ", ";
		$upd .= "anuncio = 0";
	}
	if(isset($_POST['seen'])){
		$seen = limpiarInt($_POST['seen']);
		$class = getCourse($_POST['video']);
		$updVistos = "UPDATE vistos SET visto = $seen WHERE estudiante = $user AND clase = :class";

		$db = connectDB();
		$db->prepare($updVistos)->execute([':class'=>$class]);
		$vistas = $db->query("SELECT COUNT(1) FROM vistos WHERE estudiante = $dni AND visto = 1 AND curso = $cur")->fetchColumn();
		if($vistas === false) $vistas = 0;
		$clases = $db->query("SELECT COUNT(1) FROM clase WHERE curso = $cur")->fetchColumn();
		$progreso = intdiv(100*$vistas, $clases);
		if(!empty($upd)) $upd .= ", ";
		$upd .= "progreso = :prg";
		$argUpd[':prg'] = $progreso;
	}
	if(!empty($upd)){
		$db = connectDB();
		$ps = $db->prepare("UPDATE participantes SET $upd WHERE estudiante = :dni AND curso = :cur");
		if(!$ps->execute($argUpd)){
			http_response_code(500);
			echo json_encode(["error"=>"Ocurrió un error en la base de datos", "sqlstate"=>$ps->errorInfo()]);
		}else{
			echo json_encode(["error"=>false, 'updated'=>$argUpd]);
		}
	}
}
?>