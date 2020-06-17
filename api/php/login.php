<?php session_start();
header("Content-type: application/json; charset=UTF-8");
error_reporting(0);
require_once("functions.php");
if(!empty($_POST) && isset($_POST['user']) && isset($_POST['password'])){
	$user = limpiarString($_POST['user']);
	$pass = hash("SHA512", $_POST['password']);

	$db = connectDB();
	$ps = $db->prepare("SELECT 1 FROM usuario WHERE dni = :d AND pass = :p");
	if( !$ps->execute([':d' => $user, ':p' => $pass]) ){
		//Si ocurrió un error en la consulta (Por problemas en la base de datos, no por los datos en sí)
		echo json_encode(['error' => 'Ocurrió un problema en la base de datos', 'sqlstate' => $ps->errorInfo()]);
		exit;
	}
	$row = $ps->fetch();
	if($row !== false && $row[1] == 1){
		$_SESSION['user'] = $user;
		echo json_encode([
			'error'=>false,
			'user'=>$user
		]);
	}else{
		echo json_encode([
			'error'=>'Los datos que ingresaste son incorrectos'
		]);
	}
}?>