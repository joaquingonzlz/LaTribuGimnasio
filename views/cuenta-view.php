<?php $title = "Mi Cuenta | $datos_personales[nombre]";
include_once("views/header.php"); ?>
<!-- home -->
    <div class="container" style="min-height: calc(100vh - 276.49px);padding: 20px 0;">
        <div class="section">
            <h5>Datos personales</h5>
            <div class="divider"></div>
            <div class="row">
                <form class="col s12">
                  <div class="row">
                    <div class="input-field col s12 l6">
                      <input id="first_name" type="text" class="validate" value="<?php echo $datos_personales['nombre'] ?? ''; ?>">
                      <label for="first_name">Nombre</label>
                    </div>
                    <div class="input-field col s12 l6">
                      <input id="last_name" type="text" class="validate" value="<?php echo $datos_personales['apellido'] ?? ''; ?>">
                      <label for="last_name">Apellido</label>
                    </div>
                  </div>
    
                  <div class="row">
                    
                    <div class="input-field col s12 l6">
                        <input id="email" type="email" class="validate" value="<?php echo $datos_personales['email'] ?? ''; ?>">
                        <label for="email">Email</label>
                      </div>
                      <div class="input-field col s12 l6">
                        <input id="phone" type="text" class="validate" pattern="\d+" minlength="8" data-length="11"  value="<?php echo $datos_personales['telefono'] ?? ''; ?>">
                        <label for="phone">Telefono</label>
                        <span class="helper-text" data-error="Verifique el número" data-success="El formato es correcto">Sin 0 ni 15, Ejemplo: 2284 456789</span>
                      </div>
                  </div>
                
                  <div class="row">
                    <div class="col s12" style="text-align: center;">
                        <button onclick="M.toast({html: 'I am a toast'})" class="btn waves-effect waves-light center" type="submit" name="action">
                            Guardar cambios
                        </button>
                    </div>
                  </div>
                </form>
              </div>    
        </div>
        <h5>Cambiar contraseña</h5>
        <div class="divider"></div>
        <div class="row">
          <form>
            <div class="input-field col s12 l6">
                <input id="password" type="password" class="validate">
                <label for="password">Contraseña actual</label>
              </div>
            <div class="input-field col s12 l6">
                <input id="confirmpassword" type="password" class="validate">
                <label for="password">Nueva contraseña</label>
            </div>
            <div class="input-field col s12 l6">
                <input id="confirmpassword" type="password" class="validate">
                <label for="password">Confirme nueva contraseña</label>
            </div>
            <div class="row">
                <div class="col s12" style="text-align: center;">
                    <button onclick="M.toast({html: 'I am a toast'})" class="btn waves-effect waves-light center" type="submit" name="action">
                        Guardar contraseña
                    </button>
                </div>
              </div>
          </form> 
        </div>
    </div>
	<?php include_once("views/footer-view.php"); ?>
<style>
	.titulo {
		font-weight: 500;
		line-height: 20px;
	}
	
	.contenido {
		height: 40px;
		overflow: hidden;
	}
	
	.of-cover {
		object-fit: cover;
	}
</style>

<script>
  document.addEventListener('DOMContentLoaded', function() {
		var elems = document.querySelectorAll('input#phone');
		var instances = M.CharacterCounter.init(elems);
	});

</script>
</body>

</html>