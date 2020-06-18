<?php
$db = connectDB();
$nombre = $db->query("SELECT nombre FROM usuario WHERE dni = $_SESSION[user]")->fetchColumn();
$notificaciones = $db->query("SELECT c.anuncio, c.id, c.nombre, c.fecha_anuncio FROM curso c
INNER JOIN participantes p ON (c.id = p.curso)
WHERE p.anuncio = 0 AND p.estudiante = $_SESSION[user]")->fetchAll(PDO::FETCH_ASSOC);
$hayNot = count($notificaciones) > 0;
$cursos = esProfesor($_SESSION['user']) ?
$db->query("SELECT 0 as progreso, c.id, c.nombre, c.descripcion FROM curso c")->fetchAll(PDO::FETCH_ASSOC):
$db->query("SELECT p.progreso, c.id, c.nombre, c.descripcion
	FROM participantes p INNER JOIN curso c ON (p.curso = c.id)
	WHERE p.estudiante = $_SESSION[user]"
)->fetchAll(PDO::FETCH_ASSOC)
;
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $title; ?></title>
	<link rel="stylesheet" href="/css/materialize.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<script src="/js/materialize.min.js"></script>
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			var elems = document.querySelectorAll('.sidenav');
			var instances = M.Sidenav.init(elems);
		});

		document.addEventListener('DOMContentLoaded', function() {
			var elems = document.querySelectorAll('.collapsible');
			var instances = M.Collapsible.init(elems);
		});

		document.addEventListener('DOMContentLoaded', function() {
			var elems = document.querySelectorAll('.dropdown-trigger');
			var instances = M.Dropdown.init(elems, {
				constrainWidth: false,
				coverTrigger: false
			});
		});
	</script>
</head>

<body>
	<nav class="teal darken-1">
		<div class="nav-wrapper container">
			<a href="/" class="brand-logo">La Tribu</a>
			<a href="#!" data-target="menu-responsive" class="sidenav-trigger">
				<i class="material-icons">menu</i>
			</a>

			<ul class="right hide-on-med-and-down">
				<!-- Dropdown Trigger -->
				<li>
					<a class="dropdown-trigger" href="#!" data-target="list-curses">
						Mis cursos
						<i class="material-icons right">arrow_drop_down</i>
					</a>
				</li>
				<li>
					<a class="dropdown-trigger" href="#!" data-target="list-notification">
						<i class="material-icons <?php if($hayNot) echo "right";?>">notifications</i>
						<?php if($hayNot)
							echo "<span class=\"white-text badge new\">".count($notificaciones)."</span>"
						?>
					</a>
				</li>
				<li>
					<a class="dropdown-trigger" href="#!" data-target="list-count">
						<?php echo $nombre; ?>
						<i class="material-icons right">account_circle</i>
					</a>
				</li>

			</ul>
		</div>
	</nav>

	<!-- cursos -->

	<ul id="list-curses" class="dropdown-content">
		<?php foreach($cursos as $curso): ?>
		<li class="entrada">
			<a href="<?php echo "/curso.php?course=".urlencode(base64_encode($curso['id'])); ?>">
				<div class="entrada-imagen yellow"></div>
				<div class="entrada-body black-text">
					<p class="titulo"><?php echo $curso['nombre']; ?></p>
					<p class="contenido"><?php echo $curso['descripcion']; ?></p>
				</div>
				<div style="padding: 0 10px;">
					<div class="progress">
						<div class="determinate" style="width: <?php echo $curso['progreso']."%"; ?>"></div>
					</div>
				</div>
			</a>
		</li>
		<li class="divider"></li>
		<?php endforeach; ?>
	</ul>

	<!-- notificaciones -->
	<ul id="list-notification" class="dropdown-content">
		<?php if($hayNot): ?>
		<li>
			<p style="padding: 0 20px;">Notificaciones</p>
		</li>
		<?php $hoy = new DateTime();
		foreach($notificaciones as $nt): ?>
		<li class="divider"></li>
		<li class="entrada">
			<a href="<?php echo "/curso.php?course=".urlencode(base64_encode($nt['id'])); ?>">
				<div class="entrada-imagen yellow"></div>
				<div class="entrada-body black-text">
					<p class="titulo"><?php echo $nt['nombre']; ?></p>
					<p class="contenido"><?php echo $nt['anuncio']; ?></p>
					<div style="padding-top: 10px">
						<p class="left-align grey-text darken-1"><?php 
						$fechaAnuncio = new DateTime("@$nt[fecha_anuncio]");
						$dif = getDiferencia($hoy, $fechaAnuncio);
						if($dif[0]){ echo $dif[0]." dia"; if($dif[0]!=1) echo "s";}
						else if($dif[1]){ echo $dif[1]." hora"; if($dif[1]!=1) echo "s";}
						else if($dif[2]) {echo $dif[2]." minuto"; if($dif[2]!=1) echo "s";}
						else {echo $dif[3]." segundo"; if($dif[3]!=1) echo "s";}
						?></p>
					</div>
				</div>
			</a>
			<div id="<?php echo "clear_nt_$nt[id]"; ?>" class="clear"><i class="material-icons grey-text darken-1">clear</i></div>
		</li>
		<?php endforeach; ?>
		<?php endif; ?>
	</ul>
	<style>
		.entrada {
			padding: 0;
			position: relative;
		}
		
		.clear {
			position: absolute;
			bottom: 0px;
			right: 5px;
		}
		
		.clear i.material-icons {
			padding: 0;
			margin: 0;
			line-height: 30px;
			height: 30px;
		}
		
		.titulo {
			font-weight: 500;
			padding-bottom: 5px;
		}
		
		.entrada>a {
			padding: 0 !important;
		}
		
		.entrada>a:hover {
			background: none;
		}
		
		.entrada p {
			line-height: 20px;
			margin: 0 !important;
		}
		
		.entrada .entrada-body {
			padding: 10px;
			width: 400px;
		}
		
		.entrada .entrada-body .contenido {
			height: 40px;
			overflow: hidden;
		}
	</style>

	<!-- cuenta -->

	<ul id="list-count" class="dropdown-content">
		<li class="divider"></li>
		<li><a href="#">Cuenta</a></li>
		<li class="divider"></li>
		<li><a href="/logout.php">Cerrar sesión</a></li>
	</ul>

	<ul class="sidenav" id="menu-responsive">
		<div class="user-view" style="height: 200px;">
			<div class="background">
				<img src="/img/logo.jpg" class="responsive-img">
			</div>
		</div>
		<ul class="collapsible">
			<li>
				<div class="collapsible-header">
					<i class="material-icons">account_circle</i>
					<?php echo $nombre; ?>
				</div>
				<div class="collapsible-body">
					<ul>
						<li><a href="#">Cuenta</a></li>
						<li><a href="/logout.php">Cerrar sesión</a></li>
					</ul>
				</div>
			</li>
		</ul>
		<li>
			<a href="#">Notificaciones
			<?php if($hayNot)
				echo "<span class=\"white-text badge new\">".count($notificaciones)."</span>";
			?>
			</a>
		</li>
		<li><a href="#">Mis cursos</a></li>
	</ul>