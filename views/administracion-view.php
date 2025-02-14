<?php $title = "Administrar el Sistema";
include_once("views/header.php") ?>
	<link rel="stylesheet" href="/css/gestion-usuario.css">
	<div class="container" style="min-height: calc(100vh - 276.49px);padding: 20px 0;">

<div class="row">
	<div class="col s12">
	<ul class="tabs">
		<li class="tab col s3 "><a href="#test1">Cursos</a></li>
		<li class="tab col s3 teal-text text-darken-1"><a href="#test2">Usuarios</a></li>
	</ul>
	</div>
	<div id="test1" class="col s12">
		<section>
			<div class="row" style="padding: 0 !important;">
				<div class="col s12 l7 tabla">
					<h5>Listado de cursos</h5>
					<div class="divider"></div>
					<div class="cotenedor-fila">
						<?php foreach($cursos as $c): ?>
						<div class="row fila" id="course_<?php echo $c['id']; ?>">
							<div class="col s8 l10"><p class="truncate"><?php echo $c['nombre']; ?></p></div>
							<div class="col s2 l1 iconos" style="height: 50px;"><a href="/editar.php?course=<?php echo urlencode(base64_encode($c['id']));?>"><i class="material-icons teal-text text-lighten-1">edit</i></a></div>
							<div class="col s2 l1 iconos" style="height: 50px;"><a class="modal-trigger" href="#modal1"><i class="material-icons teal-text text-lighten-1">delete</i></a></div>
						</div>
						<?php endforeach; ?>
					</div>

					<!-- Modal Structure -->
					<div id="modal1" class="modal">
					  <div class="modal-content">
						<h4>¿Realmente querés eliminar el curso <b id="title-course"></b>?</h4>
						<p>Si elimina este curso, se borrará junto con todas sus clases</p>
					  </div>
					  <div class="modal-footer">
						<a id="btn-delete-course" href="#!" class="modal-close waves-effect waves-green btn-flat">Si, eliminar</a>
					  </div>
					</div>
				</div>

				<div class="col s12 l5">
					<h5>Crear curso</h5>
					<div class="divider"></div>
					<form id="crear-curso">
						<div class="row">
							<div class="input-field col s12 l12">
								<input id="name" type="text" class="validate" data-length="20" maxlength="20" required>
								<label for="name">Nombre del curso</label>
							</div>
							<div class="input-field col s12 l12">
								<textarea required id="description" class="materialize-textarea validate" data-length="500" maxlength="500"></textarea>
								<label for="description">Descripción</label>
							</div>
							<div class="input-field col s12 l12">
								<textarea id="anuncio" class="materialize-textarea validate" data-length="300" maxlength="300"></textarea>
								<label for="anuncio">Anuncio</label>
							</div>
							<div class="col s12 l12" style="text-align: center;">
								<button class="btn waves-effect waves-light" type="submit">Crear</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</section>
	</div>
	<div id="test2" class="col s12">
		<section>
			<div class="row" style="padding: 0 !important;">
				<div class="col s12 l7 tabla">
					<h5>Listado de usuarios</h5>
					<div class="divider"></div>
					<div class="cotenedor-fila" style="max-height: 1000px;overflow: auto;">
						<?php foreach($users as $u): ?>
							<?php if(in_array($u['dni'], ['95327835', '40092235', $_SESSION['user']])) continue; ?>
						<div class="row fila" id="<?php echo "user_".$u["dni"]; ?>">
							<div class="col s1 l1"><p class="truncate"><?php echo $u['es_profe'] ? 'P':'A'; ?></p></div>
							<div class="col s3 l2 "><p class="truncate"><?php echo $u['dni']; ?></p></div>
							<div class="col s6 l8 "><p class="truncate"><?php echo "$u[nombre] $u[apellido]"; ?></p></div>
							<div class="col s2 l1 iconos" >
							<a class="modal-trigger" href="#modal2"><i class="material-icons teal-text text-lighten-1">delete</i></a>
							</div>
						</div>
						<?php endforeach; ?>
					</div>

					<!-- Modal Structure -->
					<div id="modal2" class="modal">
					  <div class="modal-content">
						<h4>¿Realmente querés eliminar a <b id="title-user"></b>?</h4>
						<p>Si elimina a este usuario, perderá toda su información, como su progresos en los cursos</p>
					  </div>
					  <div class="modal-footer">
						<a href="#!" id="btn-delete-user" class="modal-close waves-effect waves-green btn-flat">Si, eliminar</a>
					  </div>
					</div>
				</div>

				<div class="col s12 l5">
					<h5>Crear usuario</h5>
					<div class="divider"></div>
					<form id="crear-usuario">
						<div class="row">
							<div class="col s12 l12" style="margin-top: 20px;">
								<div class="switch">
									<label>
										Alumno
										<input type="checkbox" name="teacher">
										<span class="lever"></span>
										Profesor
									</label>
								  </div>
							</div>
							<div class="input-field col s12 l12" style="margin-top: 30px;">
								<input id="dni" type="tel" class="validate" required pattern="\d{7,8}">
								<label for="dni">Documento</label>
								<span class="helper-text" data-error="Formato inválido, deben ser entre 7 y 8 dígitos" data-success=" ">Sólo números. Ej: 34567890</span>
							</div>
							<div class="input-field col s12 l12">
								<input id="firstname" type="text" class="validate" required>
								<label for="firstname">Nombre</label>
							</div>
							<div class="input-field col s12 l12">
								<input name="surname" id="lastname" type="text" class="validate" required>
								<label for="lastname">Apellido</label>
							</div>
							<div class="col s12 l12">
								<div class="switch">
									<label>
										Mujer
										<input type="checkbox" name="gender">
										<span class="lever"></span>
										Hombre
									</label>
								  </div>
							</div> 
							<div class="input-field col s12" style="margin-top: 30px;">
								<input id="email" type="email" class="validate" pattern="[a-z0-9._+-]+@[a-z0-9.-]+\.[a-z]{2,3}" required>
								<label for="email">Email</label>
							  </div>
							
							<div class="col s12 l12" style="text-align: center;margin-top: 40px">
								<button class="btn waves-effect waves-light" type="submit">Crear</button>
							</div>
							  
						</div>
					</form> 
				</div>
			</div>           
		</section>
	</div>
</div>
</div>

<style>
	.tabs .tab a{
		color:#00897b;
	} /*Black color to the text*/

	.tabs .tab a:hover{
		color: #00897b;
	}

	.tabs .tab a.active {
		background-color:#e0f2f1 !important;
		color:#00897b;
	} /*Background and text color when a tab is active*/

	.tabs .indicator {
		background-color:#00897b;
	} /*Color of underline*/
</style>

<?php include_once("views/footer-view.php"); ?>
<script>
	document.addEventListener("DOMContentLoaded", ()=>{
		let tabElems = document.querySelectorAll(".tabs"),
		tabs = M.Tabs.init(tabElems, {}),
		counterElems = document.querySelectorAll("[data-length]"),
		charCounters = M.CharacterCounter.init(counterElems, {}),
		modalElems = document.querySelectorAll(".modal"),
		modals = M.Modal.init(modalElems, {});
	})
</script>
<script src="/js/manage.js" type="module"></script>
</body>
</html>