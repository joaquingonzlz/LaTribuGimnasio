<?php session_start();
header("Content-type: application/json; charset=utf-8");
error_reporting(0);
require_once("functions.php");

if(!esProfesor($_SESSION['user'])) http_response_code(403);
else if(empty($_POST)) http_response_code(404);
else{
	$curso = getCourse($_POST['course']);
	$i = 0;
	$values = '';
	$dnis = '';
	do {
		$dni = limpiarInt($_POST["part_$i"]);
		if(!empty($values)) $values .= ", ";
		$values .= "($dni, $curso)";
		$i++;
		if(!empty($dnis)) $dnis .= ", ";
		$dnis .= $dni;
	} while (isset($_POST["part_$i"]));
	$db = connectDB();
	$db->exec("DELETE FROM participantes WHERE curso = $curso AND estudiante NOT IN ($dnis)");
	if(!$db->query("INSERT IGNORE INTO participantes(estudiante, curso) VALUES $values")){
		http_response_code(500);
		echo json_encode(["error"=> "Ocurrió un error en la base de datos", "sqlstate"=>$db->errorInfo()]);
	}else{
		echo json_encode(["error"=>false]);
	}
}
?>