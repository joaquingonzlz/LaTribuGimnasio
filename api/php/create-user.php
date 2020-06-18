<?php session_start();
header("Content-type: application/json; charset=utf-8");
error_reporting(0);
require_once("functions.php");
if(esProfesor($_SESSION['user']) && !empty($_POST)){
	$nombre = limpiarString($_POST['firstname']);
	$apellido = limpiarString($_POST['surname']);
	$dni = limpiarInt($_POST['dni']);
	$tel = limpiarInt($_POST['phone'] ?? '');
	$pass = hash("SHA512" ,$_POST['passwd']);
	$email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
	$isProfe = boolval(limpiarInt($_POST['teacher']));

	$db = connectDB();
	$ps = $db->prepare("INSERT INTO usuario(dni, pass, email, nombre, apellido, telefono, es_profe)
	VALUES(:d, :p, :e, :n, :a, :t, :i)");

	if(!$ps->execute([
		":d"=>$dni,
		":p"=>$pass,
		":e"=>$email,
		":n"=>$nombre,
		":a"=>$apellido,
		":t"=>$tel,
		":i"=>$isProfe
	])){
		http_response_code(500);
		echo json_encode(["error"=>"Ocurrió un error en la base de datos", "sqlstate"=>$ps->errorInfo()]);
	}else{
		echo json_encode(["error"=>false, "nombre"=>$nombre, "apellido"=>$apellido]);
	}
}else{
	http_response_code(403);
}

?>