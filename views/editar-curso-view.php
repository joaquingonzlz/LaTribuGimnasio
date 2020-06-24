<?php $title = "Editar Curso | $datos_curso[nombre]";
include_once("views/header.php"); ?>
    <link rel="stylesheet" href="/css/gestion-usuario.css">

    <!-- contenido -->
    <div class="container" style="min-height: calc(100vh - 276.49px);padding: 20px 0;">
        <h5>Editar curso</h5>
        <div class="divider"></div>
        <form>
            <div class="row" style="margin-top: 20px;">
                <div class="input-field col s12 l6">
                  <i class="material-icons prefix">fitness_center</i>
                  <input id="nombrecurso" type="text" class="validate" value="<?php echo $datos_curso['nombre']; ?>">
                  <label for="nombrecurso">Nombre del curso</label>
              </div>
						<input required type="hidden" name=course value="<?php echo $datos_curso['id']; ?>">
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <i class="material-icons prefix">mode_edit</i>
                  <textarea id="descripcion" class="materialize-textarea"><?php echo $datos_curso['descripcion'] ?? ''; ?></textarea>
                  <label for="descripcion">Descripción</label>
                  <span class="helper-text">La nueva descripción reemplazará la descripción actual</span>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <i class="material-icons prefix">mode_edit</i>
                  <textarea id="anuncio" class="materialize-textarea"><?php echo $datos_curso['anuncio'] ?? ''; ?></textarea>
                  <label for="anuncio">Anuncio</label>
                  <span class="helper-text">El nuevo anuncio reemplazará el anuncio actual</span>
                </div>
              </div>
              <div class="row" style="text-align: center;margin-bottom: 40px !important;">
                <button class="btn waves-effect waves-light" type="submit" name="action">Guardar cambios</button>
              </div>
        </form>
        <h5>Añadir clases</h5>
        <div class="divider"></div>
        <div class="row" style="margin-top: 20px !important;">
            <div class="col s12 l6">
                <form id="form-create-class">
                    <div class="row">
                        <div class="input-field col s12">
                          <i class="material-icons prefix">edit</i>
                          <input name="title" id="nombreclase" type="text" class="validate" required>
                          <label for="nombreclase">Título para la clase</label>
						</div>
						<input required type="hidden" name=course value="<?php echo $datos_curso['id']; ?>">
                        <div class="input-field col s12">
                          <i class="material-icons prefix">tv</i>
                          <input name="video" id="urlvideo" type="url" class="validate">
                          <label for="urlvideo">URL del video</label>
                        </div>
						<div class="input-field col s12">
							<i class="material-icons prefix">date_range</i>
							<input name="date" id="fecha" type="text" class="datepicker">
							<label for="fecha">Fecha</label>
                    	</div>
                    </div>
                    <div class="row" style="text-align: center;">
                        <button class="btn waves-effect waves-light" type="submit">Añadir clase</button>
                    </div>
                </form>
            </div>
            <div class="col s12 l6">
                <div class="cotenedor-fila" style="max-height: 400px; overflow-y:auto;">
					<?php foreach($clases as $c): ?>
                    <div class="row fila" id="<?php echo "clase_$c[id]"; ?>">
                        <div class="col s8 l10"><p class="truncate"><?php echo $c['titulo']; ?></p></div>
                        <div class="col s2 l1 iconos" style="height: 50px;"><a class="modal-trigger" href="#editarcurso"><i class="material-icons teal-text text-lighten-1">edit</i></a></div>
                        <div class="col s2 l1 iconos" style="height: 50px;"><a class="modal-trigger" href="#eliminarcurso"><i class="material-icons teal-text text-lighten-1">delete</i></a></div>
					</div>
					<?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top: 20px; min-height: 250px;">
            <div class="col s12 l6">
				<div class="center"><h5>Añadir participantes</h5></div>
				<div class="divider"></div>
				<div id="list-usuarios" class="contenedor-fila" style="max-height: 400px; overflow: auto; margin-bottom: 20px;">
					<?php foreach ($usuarios as $u): ?>
					<div class="row" style="margin: 0;">
					<p>
						<label>
							<input id="_<?php echo $u['dni']; ?>" type="checkbox" style="position: static">
							<span><?php echo "$u[nombre] $u[apellido]"; ?></span>
						</label>
					</p>
					</div>
					<?php endforeach; ?>
                </div>
            </div>
            <div class="col s12 l6">
				<div class="center"><h5>Participantes del curso</h5></div>
				<div class="divider"></div>
				<div id="list-participantes" class="contenedor-fila" style="max-height: 400px; overflow-y: auto; margin-bottom: 20px;">
					<?php foreach($participantes as $p): ?>
					<div class="row fila">
						<div class="col s10"><p style="line-height: 50px; text-align:center">
							<?php echo "$p[nombre] $p[apellido]" ?>
						</p></div>
						<div id="_<?php echo $p['dni']; ?>" data-user="<?php echo "$p[nombre] $p[apellido]"; ?>" class="col s2" style="display: flex; justify-content: center; align-items: center;">
							<i style="cursor:pointer;" name="delete-participant" class="material-icons teal-text text-lighten-1">delete</i> 
						</div>
					</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col s12 center bottom-sheet">
				<div class="divider" style="margin-bottom: 20px;"></div>
				<div id="confirmar-participantes" class="waves-effect waves-light btn">
		            Confirmar cambios
				</div>
			</div>
		</div>
    </div>

    <div id="editarcurso" class="modal">
        <div class="modal-content">
          <h4>Editar clase</h4>
          <form>
            <div class="row">
                <div class="input-field col s12">
                  <i class="material-icons prefix">edit</i>
                  <input id="editarnombreclase" type="text" class="validate">
                  <label for="editarnombreclase">Título de la clase</label>
                </div>
                <div class="input-field col s12">
                  <i class="material-icons prefix">tv</i>
                  <input id="editarurlvideo" type="text" class="validate">
                  <label for="editarurlvideo">URL al video</label>
                </div>
				<div class="input-field col s12">
					<i class="material-icons prefix">date_range</i>
					<input id="editarfecha" type="text" class="datepicker">
					<label for="editarfecha">Fecha</label>
				</div>    
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <a href="#!" class="modal-close waves-effect waves-green btn-flat">Guardar cambios</a>
        </div>
    </div>

    <div id="eliminarcurso" class="modal">
        <div class="modal-content">
            <h4>¿Realmente desea eliminar esta clase?</h4>
            <p>Si elimina la clase, los usuarios ya no podrán acceder al contenido</p>
          </div>
          <div class="modal-footer">
            <a href="#!" class="btn modal-close waves-effect waves-green btn-flat">Si, eliminar</a>
          </div>
    </div>
<?php include_once("views/footer-view.php"); ?>

	<script>
        // M.AutoInit();
        
        document.addEventListener('DOMContentLoaded', function() {
            const dpElems = document.querySelectorAll('.datepicker');
            const datepickers = M.Datepicker.init(dpElems, {
				      autoClose: true,
              format: 'dd mmmm yyyy',
              i18n: {months: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ], 
                    cancel: "cerrar",
                    monthsShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Nov","Dic"],
                    weekdaysAbbrev: ["D", "L","M", "Mi", "J", "V", "S"],
                    weekdays: ["Domingo","Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado" ],
                    weekdaysShort: ["Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab"],
                    }
			});
			const modalElems = document.querySelectorAll(".modal"),
			modals = M.Modal.init(modalElems, {});
        });
	</script>
	<script src="/js/clases.js" type="module"></script>
</body>
</html>