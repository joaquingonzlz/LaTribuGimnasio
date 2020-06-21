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
                <form>
                    <div class="row">
                        <div class="input-field col s12">
                          <i class="material-icons prefix">edit</i>
                          <input id="nombreclase" type="text" class="validate">
                          <label for="nombreclase">Título para la clase</label>
                        </div>
                        <div class="input-field col s12">
                          <i class="material-icons prefix">tv</i>
                          <input id="urlvideo" type="tel" class="validate">
                          <label for="urlvideo">URL del video</label>
                        </div>
						<div class="input-field col s12">
							<i class="material-icons prefix">date_range</i>
							<input id="fecha" type="text" class="datepicker">
							<label for="fecha">Fecha</label>
                    </div>
                    </div>
                    <div class="row" style="text-align: center;">
                        <button class="btn waves-effect waves-light" type="submit" name="action">Añadir clase</button>
                    </div>
                </form>
            </div>
            <div class="col s12 l6">
                <div class="cotenedor-fila">
					<?php foreach($clases as $c): ?>
                    <div class="row fila" id="<?php echo "clase_$c[id]"; ?>">
                        <div class="col s8 l10"><p class="truncate"><?php echo $c['nombre']; ?></p></div>
                        <div class="col s2 l1 iconos" style="height: 50px;"><a class="modal-trigger" href="#editarcurso"><i class="material-icons teal-text text-lighten-1">edit</i></a></div>
                        <div class="col s2 l1 iconos" style="height: 50px;"><a class="modal-trigger" href="#eliminarcurso"><i class="material-icons teal-text text-lighten-1">delete</i></a></div>
					</div>
					<?php endforeach; ?>
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

    <script src="/js/materialize.min.js"></script>
	<script>
        // M.AutoInit();
        
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.datepicker');
            var instances = M.Datepicker.init(elems, {
				autoClose: true
			});
        });
	</script>
	<script src="/js/editar-curso.js"></script>
</body>
</html>