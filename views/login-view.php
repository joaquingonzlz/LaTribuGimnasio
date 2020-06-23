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
		<div class="col s12 l8 hide-on-med-and-down" style="height: 100vh; margin: 0 !important; background: linear-gradient(135deg, rgba(76,207,157,1) 0%, rgba(63,176,174,1) 50%, rgba(0,137,123,1) 100%); display: flex;flex-direction: column; justify-content: center; align-items: center">
			<div class="contenedor-imagen" style="width:200px !important">
				<img src="/img/logo.svg" class="responsive-img">
			</div>
			<h2 class="white-text">La Tribu</h2>
		</div>
		<div class="col s12 l4" class="center" style="height: 100vh; margin: 0 !important">
			<form class="col s12" id="login-form" style="height: 100vh;display: flex; flex-direction: column; justify-content:center;align-items: center">
				<div style="width: 125px;margin-bottom: 20px !important" class="hide-on-large-only">
					<svg xmlns="http://www.w3.org/2000/svg" xml:space="preserve"  version="1.1" style="shape-rendering:geometricPrecision; text-rendering:geometricPrecision; image-rendering:optimizeQuality; fill-rule:evenodd; clip-rule:evenodd"
						viewBox="0 0 934 1391"
						xmlns:xlink="http://www.w3.org/1999/xlink">
						<defs>
						<style type="text/css">
						<![CDATA[
							.fil0 {fill: #26a69a}
						]]>
						</style>
						</defs>
						<g id="Capa_x0020_1">
						<metadata id="CorelCorpID_0Corel-Layer"/>
						<path class="fil0" d="M526 785c3,-2 28,-32 33,-38 17,-19 22,-11 24,-20 6,-18 -2,-36 61,12 37,14 44,-64 98,-94 15,-9 34,-14 48,-19 12,-68 15,-117 12,-148 -3,-28 -15,-35 -3,-36 37,-5 97,-51 135,-101l0 -30c-35,39 -97,87 -141,105l-13 -17c56,-65 106,-257 88,-331l-29 -9c-11,0 -2,204 -89,328 -22,-3 -32,-11 -32,-19 0,-6 7,-11 10,-22 19,-84 18,-63 20,-156 0,-21 8,-161 -32,-184l-51 21c22,73 17,217 7,299 -4,35 -8,46 -15,50 -6,1 -14,-7 -35,-7 -19,0 5,-81 4,-107 -2,-64 -1,-146 -39,-200 -18,-26 -31,-57 -39,-62l-21 25c8,39 12,168 24,187 16,26 19,161 14,174l-34 -2c2,-27 2,-52 -48,-129 -29,-44 -92,-76 -106,-66l-10 31c58,70 108,170 113,211 4,26 -21,-13 -90,10l3 50c0,0 57,-34 93,4 -121,72 -156,146 -161,157 -91,-86 -194,25 -309,-3 -45,14 20,61 13,82 11,29 39,-1 27,-29 93,-2 191,-47 240,-1 -62,146 -76,283 -23,411 -45,85 -102,-6 -189,-34 -38,-12 -29,-26 -34,15 -9,69 1,132 4,188 3,67 61,74 47,2 6,-32 12,-64 18,-95 79,53 143,57 191,5 35,56 80,100 134,134 34,-27 56,-44 110,-27 54,18 59,36 74,74 79,27 153,25 218,-26 31,-24 34,-74 -25,-50 -64,26 -79,10 -122,28 22,-92 -111,-138 -214,-121 -33,-71 -42,-137 -11,-202 15,-33 6,-36 49,-23 59,17 135,52 168,46 41,-7 112,-52 171,-80 27,-10 60,-1 67,-21 8,-24 -39,-42 -56,-79l-18 29c21,36 20,9 -143,81 -49,21 -56,15 -98,-11 -47,-24 -126,-62 -132,-72 -5,-10 30,-59 44,-88zm-44 -215c-245,238 -236,450 -73,644 10,-11 19,-23 29,-35 -76,-213 -19,-393 115,-552 -24,-19 -47,-38 -71,-57zm-4 -20c-262,261 -241,492 -69,690 10,-13 37,-44 47,-56 -79,-225 -23,-394 119,-562 -25,-20 -73,-52 -97,-72zm95 -66c65,-60 174,-16 182,84 -55,2 -85,12 -102,27 -31,-34 -61,-69 -80,-111zm-21 -10c79,-74 215,-20 225,104 -69,2 -105,15 -127,33 -39,-42 -76,-85 -98,-137z"/>
						</g>
					</svg>
				</div>
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