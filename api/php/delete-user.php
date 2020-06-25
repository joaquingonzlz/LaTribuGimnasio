<?php session_start();
header("Content-type: application/json; charset=utf-8");
error_reporting(0);
require_once("functions.php");

if(!esProfesor($_SESSION['user'])) http_response_code(403);
else if(empty($_POST)) http_response_code(404);
else if($_SESSION['user'] == $_POST['student']) echo json_encode(["error"=>"No te puedes eliminar a tí mismo."]);
else{
	$est = limpiarInt($_POST['student']);
	$db = connectDB();
	$error = false;
	$error = $error || ($db->exec("DELETE FROM participantes WHERE estudiante = $est") === false);
	$error = $error || ($db->exec("DELETE FROM vistos WHERE estudiante = $est") === false);
	$error = $error || ($db->exec("DELETE FROM estudiante WHERE dni = $est") === false);
	$error = $error || ($db->exec("DELETE FROM profesor WHERE dni = $est") === false);
	$error = $error || ($db->exec("DELETE FROM usuario WHERE dni = $est") === false);
	if($error){
		http_response_code(500);
		echo json_encode(["error"=> "Ocurrió un error en la base de datos", "sqlstate"=>$db->errorInfo()]);
	}else{
		echo json_encode(["error"=>false]);
	}
}?>