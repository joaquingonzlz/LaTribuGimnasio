<?php
$timezone = new DateTimeZone("America/Argentina/Buenos_Aires");
setlocale(LC_ALL, 'es_AR', 'esp_ARG');
function connectDB() : PDO {
	try {
		$prefix = 'u464982645_';
		$db = new PDO("mysql:host=localhost; dbname=${prefix}latribu", $prefix.'angelo', 'SUfU4995...');
		$db->exec("SET lc_time_names = es_AR");
	} catch (PDOException $e) {
		echo 'Error: '.$e->getMessage();
		exit(1);
	}
	return $db;
}
function comprobarSesion(){
	if(!isset($_SESSION['usuario'])){
		header("Location: index.php");
	}
}
function limpiarString(string $input): string{
	return filter_var(htmlspecialchars(trim($input)), FILTER_SANITIZE_STRING);
}
function limpiarInt(string $input): int{
	return intval(filter_var(htmlspecialchars(trim($input)), FILTER_SANITIZE_NUMBER_INT));
}
?>