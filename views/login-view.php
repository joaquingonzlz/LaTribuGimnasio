<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>La Tribu Gimnasio</title>
	<link rel="stylesheet" href="/css/materialize.css">
	<!-- <link rel="stylesheet" href="/css/index.css"> -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body style="min-height: 100vh;">
	<div class="row section center-align" style="padding: 0 !important; margin: 0 !important">
		<div class="col s12 l8" style="height: 100vh; margin: 0 !important; background: linear-gradient(135deg, rgba(76,207,157,1) 0%, rgba(63,176,174,1) 50%, rgba(0,137,123,1) 100%); display: flex;flex-direction: column; justify-content: center; align-items: center">
			<div class="contenedor-imagen" style="width:200px !important">
				<img src="/img/logo.svg" class="responsive-img">
			</div>
			<h2 class="white-text">La Tribu</h2>
		</div>
		<div class="col s12 l4" class="center" style="height: 100vh; margin: 0 !important">
			<form class="col s12" id="login-form" style="height: 100vh;display: flex; flex-direction: column; justify-content: center;">
				<h4>Ingresá</h4>
				<div class="section row" style="display: flex; justify-content: center; flex-wrap: wrap; margin: 0 !important">
					<div class="input-field col s8" style="margin-left:0 !important">
						<label for="username">Documento</label>
						<input name="user" id="username" type="text" class="validate" autocomplete="username" autofocus>
					</div>
					<div class="input-field col s8" style="margin-left:0 !important">
						<label for="password">Contraseña</label>
						<input name="password" id="password" type="password" class="validate" autocomplete="current-password">
					</div>
					<div class="col s8" style="margin-top: 20px;margin-left:0 !important">
						<button class="btn waves-effect waves-light" type="submit" name="action">Entrar
							<i class="material-icons right">send</i>
						</button>
					</div>
					<!-- <div class="row">
						<div class="section col s12">
							<a href="#">¿Olvidó su nombre de usuario o contraseña?</a>
						</div>
					</div> -->
				</div>
			</form>
		</div>

	</div>
	
	<script src="/js/materialize.js"></script>
	<script type="module" src="/js/login.js"></script>
</body>

</html>