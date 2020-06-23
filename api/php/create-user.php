<?php session_start();
header("Content-type: application/json; charset=utf-8");
error_reporting(0);
require_once("functions.php");
if(esProfesor($_SESSION['user']) && !empty($_POST)){
	$nombre = limpiarString($_POST['firstname']);
	$apellido = limpiarString($_POST['surname']);
	$dni = limpiarInt($_POST['dni']);
	$pass = hash("SHA512" , "latribu".($dni % 1000));
	$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
	$isProfe = boolval(limpiarInt($_POST['teacher'] ?? 0));
	$esHombre = boolval(limpiarInt($_POST['gender'] ?? 0));
	$db = connectDB();
	$ps = $db->prepare("INSERT INTO usuario(dni, pass, email, nombre, apellido, es_profe, sexo)
	VALUES(:d, :p, :e, :n, :a, :i, :s)");

	if(!$ps->execute([
		":d"=>$dni,
		":p"=>$pass,
		":e"=>$email,
		":n"=>$nombre,
		":a"=>$apellido,
		":i"=>$isProfe,
		":s"=>$esHombre
	])){
		echo json_encode(["error"=>"Ocurrió un error en la base de datos", "sqlstate"=>$ps->errorInfo()]);
		http_response_code(500);
	}else{
		echo json_encode(["error"=>false, "nombre"=>$nombre, "apellido"=>$apellido, "password"=>"latribu".($dni%1000)]);
	}
}else{
	http_response_code(403);
}

?>