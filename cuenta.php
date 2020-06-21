<?php session_start();
require_once("api/php/functions.php");
if(!isset($_SESSION['user'])) http_response_code(404);
else{
	$db = connectDB();
	$datos_personales = $db->query("SELECT * FROM usuario WHERE dni = $_SESSION[user]")->fetch(PDO::FETCH_ASSOC);
	if (!$datos_personales || empty($datos_personales)) http_response_code(404);
	else{
		include_once("views/cuenta-view.php");
	}
}
?>