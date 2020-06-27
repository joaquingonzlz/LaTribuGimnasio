<?php session_start();
header("Content-type: application/json; charset=utf-8");
// error_reporting(0);
require_once("functions.php");
if(!isset($_SESSION['user'])) http_response_code(403);
else if(!empty($_POST)){
	$update = "";
	$argUpd = [":user" => $_SESSION['user']];

	if(isset($_POST['firstname'])){
		$update .= "nombre = :n";
		$argUpd[':n'] = limpiarString($_POST['firstname']);
	}
	if(isset($_POST['surname'])){
		if(!empty($update)) $update .= ", ";
		$update .= "apellido = :a";
		$argUpd[':a'] = limpiarString($_POST['surname']);
	}
	if(isset($_POST['phone'])){
		if(!empty($update)) $update .= ", ";
		$update .= "telefono = :t";
		$argUpd[':t'] = limpiarInt($_POST['phone']);
	}
	if(isset($_POST['email'])){
		if(!empty($update)) $update .= ", ";
		$update .= "email = :e";
		$argUpd[':e'] = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
	}
	// Para actualizar la contraseña se necesita tanto la pwd como la confirm y que sean iguales
	if(isset($_POST['password']) && isset($_POST['confirm']) && $_POST['password'] === $_POST['confirm']){
		if(!empty($update)) $update .= ", ";
		$update .= "pass = :p";
		$argUpd[':p'] = hash("SHA512" ,$_POST['password']);
	}
	//TO-DO: Implementar carga de imagen para el perfil
	if(isset($_POST['picture'])){
		generarImagen($_FILES['picture']);
	}

	if(!empty($update)){
		$db = connectDB();
		$query = "UPDATE usuario SET $update WHERE dni = :user";
		if(isset($_POST['current'])){
			$query .= " AND pass = :password";
			$argUpd[':password'] = hash("SHA512", $_POST['current']);
		}
		$ps = $db->prepare($query);
		if(!$ps->execute($argUpd)){
			http_response_code(500);
			echo json_encode(["error"=>"Ocurrió un error en la base de datos", "sqlstate"=>$ps->errorInfo()]);
		}else{
			echo json_encode(["error"=>false, "result"=>$ps->fetch(PDO::FETCH_ASSOC)]);
		}
	}
}else{
	http_response_code(404);
}
?>