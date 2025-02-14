<?php
$timezone = new DateTimeZone("America/Argentina/Buenos_Aires");
setlocale(LC_ALL, 'es_AR', 'esp_ARG');
$db = NULL;
function connectDB() : PDO {
	global $db;
	if($db === NULL){
		try {
			$prefix = 'u464982645_';
			$db = new PDO("mysql:host=localhost; dbname=${prefix}latribu", $prefix.'angelo', 'SUfU4995...');
			$db->exec("SET lc_time_names = es_AR");
		} catch (PDOException $e) {
			echo json_encode(['error' => "No se puede conectar a la base de datos", 'sqlstate' => $e->getMessage()]);
			http_response_code(500);
			exit(1);
		}
	}
	return $db;
}
function comprobarSesion(){
	if(!isset($_SESSION['usuario'])){
		header("Location: index.php");
	}
}
/**Aplica filtros para eliminar cualquier inconsistencia en el texto de entrada */
function limpiarString(string $input): string{
	return filter_var(htmlspecialchars(trim($input)), FILTER_SANITIZE_STRING);
}
/**Aplica filtros para retornar los dígitos dentro del texto de entrada */
function limpiarInt(string $input): int{
	return intval(filter_var(htmlspecialchars(trim($input)), FILTER_SANITIZE_NUMBER_INT));
}
function esProfesor(string $user): bool{
	$res = connectDB()->query("SELECT 1 FROM profesor WHERE dni = $user")->fetchColumn();
	return !!$res;
}
function esParticipante(string $user, int $curso):bool{
	if(esProfesor($user)) return true;
	return !!(connectDB()->query("SELECT 1 FROM participantes WHERE estudiante = $user AND curso = $curso")->fetchColumn());
}
function generarImagen($archivo): string{

	return '';
}
/**Para obtener la duración del video, hay que hacer todo este quilombo, debido a que el video está en youtube
* y gracias a Dios youtube provee información sobre el video, porque sino estamos sonados. */
function getDuracion(string $video): int{
	//Primero usamos la URL que provee youtube para obtener info del video
	$api_key = 'AIzaSyCZZMv3gl1_KiJVvWMgvS-pYs9AotN8fsE';
	$url = "https://www.googleapis.com/youtube/v3/videos?part=contentDetails&id=${video}&key=${api_key}";
	//Creamos una sesion cURL (See URL) y seteamos unos parámetros necesarios
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

	//Me guardo el resultado y cierro la sesión
	$resultado = curl_exec($ch);
	curl_close($ch);

	//Decodifico toda la wea que retorna, y hago un grep para conseguir la porción de texto que me interesa (duración del video)
	$resultado = json_decode(urldecode($resultado));
	$duracion = new DateInterval($resultado->items[0]->contentDetails->duration);
	$milisegundos = ($duracion->h*3600+$duracion->i*60+$duracion->s)*1000;
	// print_r($resultado);
	// return $str[0];
	return $milisegundos;
}
function getYoutubeID(string $url){
	//Separa por / por si es una url acortada "https://youtu.be/videoID" => [https: | youtu.be | videoID]
	$aux = explode("/", $url);
	// Busca por = por si lo que separé no era acortada y me quedó 
	// "https://youtube.com/watch?v=videoID" => [https: | youtube.com | watch?v=videoID]
	$aux = explode("=", $aux[count($aux)-1]);
	// Sea como sea, yo en este punto tengo separado el videoID del resto del url
	return $aux[count($aux)-1];
}
/**Decodifica, limpia y obtiene el id del curso */
function getCourse(string $course): int{
	$curso = base64_decode(urldecode($course));
	if(!$curso){
		http_response_code(404);
		exit;
	}
	return intval(limpiarInt($curso));
}
/**Obtiene la diferencia en dias, horas, minutos y segundos entre dos fechas */
function getDiferencia(DateTime $fecha1, DateTime $fecha2):array{
	$ts1 = $fecha1->getTimestamp();
	$ts2 = $fecha2->getTimestamp();
	$segundos = abs($ts2 - $ts1); //Obtengo la diferencia en segundos
	$dias = intdiv($segundos, 86400); //Dias de diferencia //86400 segundos hay en un dia
	$segundos %= 86400;
	$horas = intdiv($segundos, 3600);
	$segundos %= 3600;
	$minutos = intdiv($segundos, 60);
	$segundos %= 60;
	return [$dias, $horas, $minutos, $segundos];
}
function toReadableTime(int $millis):string{
	$seg = intdiv($millis,1000);
	$horas = intdiv($seg, 3600);
	$seg %= 3600;
	$mins = intdiv($seg, 60);
	$seg %= 60;
	$res = '';
	if($horas > 0) $res .= str_pad($horas, 2, "0", STR_PAD_LEFT) . ":";
	$res .= str_pad($mins, 2, "0", STR_PAD_LEFT) . ":" . str_pad($seg, 2, "0", STR_PAD_LEFT);
	return $res;
}
?>