<?php if(!isset($_POST['class'])) http_response_code(404);
try{
	require_once("functions.php");
	$db = connectDB();
	$class = $_POST['class'];
	$classInfo = $db->query("SELECT * FROM clase WHERE id = $class")->fetch();
} catch (Exception $e) {
	echo json_encode(['error'=>$e->getMessage()]);
}
echo json_encode($classInfo);
?>