<?php session_start();
header("Content-type: application/json; charset=utf-8");
error_reporting(0);
require_once("functions.php");

if(!esProfesor($_SESSION['user'])) http_response_code(403);
else if(empty($_POST)) http_response_code(404);
else{
	$clase = $_POST['class'];
	$error = false;

	$db = connectDB();
	$error = $error || ($db->exec("DELETE FROM vistos WHERE clase = $clase") === false);
	$error = $error || ($db->exec("DELETE FROM clase WHERE id = $clase") === false);
	if($error){
		http_response_code(500);
		echo json_encode(["error"=> "Ocurrió un error en la base de datos", "sqlstate"=>$db->errorInfo()]);
	}else{
		echo json_encode(["error"=>false]);
	}
}