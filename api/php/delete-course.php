<?php session_start();
header("Content-type: application/json; charset=utf-8");
error_reporting(0);
require_once("functions.php");

if(!esProfesor($_SESSION['user'])) http_response_code(403);
else if(empty($_POST)) http_response_code(404);
else{
	$pass = hash("SHA512", $_POST['pass']);
	$db = connectDB();
	if(!$db->query("SELECT 1 FROM usuario WHERE dni = $_SESSION[user] AND pass = $pass")->fetchColumn()){
		http_response_code(403);
		exit;
	}
	$curso = getCourse($_POST['course']);
	$error = false;
	$error = $error || ($db->exec("DELETE FROM participantes WHERE curso = $curso") === false);
	$error = $error || ($db->exec("DELETE FROM vistos WHERE curso = $curso") === false);
	$error = $error || ($db->exec("DELETE FROM clases WHERE curso = $curso") === false);
	$error = $error || ($db->exec("DELETE FROM curso WHERE id = $curso") === false);
	if($error){
		http_response_code(500);
		echo json_encode(["error"=> "Ocurrió un error en la base de datos", "sqlstate"=>$ps->errorInfo()]);
	}else{
		echo json_encode(["error"=>false]);
	}
}