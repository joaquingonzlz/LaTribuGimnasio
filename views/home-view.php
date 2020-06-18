<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="/css/materialize.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>    
      <nav class="teal darken-2">
        <div class="nav-wrapper container">
          <a href="#" class="brand-logo">La Tribu</a>
          <a href="#" data-target="menu-responsive" class="sidenav-trigger">
            <i class="material-icons">menu</i>
          </a>

          <ul class="right hide-on-med-and-down">
            <li><a href="badges.html"></a></li>
            <!-- Dropdown Trigger -->
            <li><a class="dropdown-trigger" href="#!" data-target="list-curses">Mis cursos<i class="material-icons right">arrow_drop_down</i></a></li>
            <li><a class="dropdown-trigger" href="#!" data-target="list-notification"><i class="material-icons right">notifications</i><span class="white-text badge new">3</span></a></li>
            <li><a class="dropdown-trigger" href="#!" data-target="list-count">Joaquin<i class="material-icons right">account_circle</i></a></li>

          </ul>
        </div>
      </nav>

      <!-- cursos -->

      <ul id="list-curses" class="dropdown-content">
        <li class="entrada"><a href="#">
            <div class="entrada-imagen yellow"></div>
            <div class="entrada-body black-text">
                <p class="titulo">Nombre cursos</p>
                <p class="contenido">Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem suscipit harum error omnis saepe, ducimus dolor totam alias veniam accusamus quisquam vitae voluptatibus nobis ex quaerat temporibus quod sint excepturi?</p>
            </div>
            <div style="padding: 0 10px;">
                <div class="progress">
                    <div class="determinate" style="width: 70%"></div>
                </div>   
            </div>
            </a>  
        </li>
        <li class="divider"></li>
      </ul>

      <!-- notificaciones -->

      <ul id="list-notification" class="dropdown-content">

        <li><p style="padding: 0 20px;">Notificaciones</p></li>

        <li class="divider"></li>
        <li class="entrada"><a href="#">
            <div class="entrada-imagen yellow"></div>
            <div class="entrada-body black-text">
                <p class="titulo">Nombre cursos</p>
                <p class="contenido">Lorem ipsum dolor sit amet consectetur adipisicing elit. Exercitationem suscipit harum error omnis saepe, ducimus dolor totam alias veniam accusamus quisquam vitae voluptatibus nobis ex quaerat temporibus quod sint excepturi?</p>
                <div style="padding-top: 10px">
                    <p class="left-align grey-text darken-1">hace 5 horas</p>
                </div>
            </div>
            </a>
            <div class="clear"><i class="material-icons grey-text darken-1">clear</i></div>
        </li>
        
      </ul>

      <style>
          .entrada{
              padding: 0;
              position: relative;
          }

          .clear{
              position: absolute;
              bottom: 0px;
              right: 5px;
          }
          .clear i.material-icons{
              padding: 0;
              margin: 0;
              line-height: 30px;
              height: 30px;
          }

          .titulo{
              font-weight: 500;
              padding-bottom: 5px;
          }

          .entrada > a{
              padding: 0 !important;
          }
          .entrada > a:hover{
              background: none;
          }

          .entrada p{
              line-height: 20px;
              margin: 0 !important;
          }
          
          .entrada .entrada-body{
              padding: 10px;
              width: 400px;
          }

          .entrada .entrada-body .contenido{
              height: 40px;
              overflow: hidden;
          }
      </style>

      <!-- cuenta -->

      <ul id="list-count" class="dropdown-content">
        <li class="divider"></li>
        <li><a href="#">Cuenta</a></li>
        <li class="divider"></li>
        <li><a href="#">Cerrar sesión</a></li>
      </ul>

      <ul class="sidenav" id="menu-responsive">
          <div class="user-view" style="height: 200px;">
              <div class="background">
                  <img src="/img/logo.jpg" class="responsive-img">
              </div>
          </div>
          <ul class="collapsible">
            <li>
              <div class="collapsible-header"><i class="material-icons">account_circle</i>Joaquin</div>
              <div class="collapsible-body">
                  <ul>
                      <li><a href="#">Cuenta</a></li>
                      <li><a href="#">Cerrar sesión</a></li>
                  </ul>
              </div>
            </li>
          </ul>
          <li><a href="#">Notificaciones<span class="white-text badge new">3</span></a></li>
          <li><a href="#">Mis cursos</a></li>
      </ul>

      <!-- home -->
      <div class="container">
        <div class="row" style="padding: 10px 0;">
            <div class="col s12">
                <div class="slide" style="background: url(/img/home.jpg) center no-repeat; background-size: cover ;height: 200px; width: 100%;"></div>
            </div>
            <div class="col s12">
                <h4>Hola de nuevo, <?php echo $neverpony; ?></h4>
                <h6 class="grey-text" style="margin-bottom: 30px">¿Preparad<?php echo $hombre ? "o" : "a"; ?> para volver a entrenar?</h6>
            </div>
            <div class="row">
				<div class="col s12" style="overflow: hidden; background: #eee;">
		  			<?php foreach($cursos as $curso): ?>
                    <div class="col s12 l5 card horizontal">
                        <div class="card-image">
                            <img src="/img/logo.jpg">
                        </div>
                        <div class="card-stacked">
                            <div class="card-content" style="padding: 10 !important;">
                                <p class="titulo"><?php echo $curso['nombre']; ?></p>
                                <p class="contenido"><?php echo $curso['descripcion']; ?></p>
                                <div class="red" style="margin-top: 20px">
                                    <div class="progress">
                                        <div class="determinate" style="width: <?php echo $curso['progreso']."%"; ?>"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-action">
                                <a href="/curso.php?course=<?php echo urlencode(base64_encode($curso['id']));?>">Continuar con el curso</a>
                            </div>
                        </div>
					</div>
					<?php endforeach; ?>
                </div>
            </div>
        </div>  
      </div>
      <footer class="page-footer  teal lighten-1">
        <div class="container">
          <div class="row">
            <div class="col l6 s12">
              <h5 class="white-text">Footer Content</h5>
              <p class="grey-text text-lighten-4">You can use rows and columns here to organize your footer content.</p>
            </div>
            <div class="col l4 offset-l2 s12">
              <h5 class="white-text">Links</h5>
              <ul>
                <li><a class="grey-text text-lighten-3" href="#!">Link 1</a></li>
                <li><a class="grey-text text-lighten-3" href="#!">Link 2</a></li>
                <li><a class="grey-text text-lighten-3" href="#!">Link 3</a></li>
                <li><a class="grey-text text-lighten-3" href="#!">Link 4</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="footer-copyright teal darken-1">
          <div class="container">
          © 2014 Copyright Text
          <a class="grey-text text-lighten-4 right" href="#!">More Links</a>
          </div>
        </div>
      </footer>



      <style>
          .titulo{
              font-weight: 500;
          }

          .contenido{
              height: 40px;
              overflow: hidden;
          }
      </style>

      <script src="/js/materialize.min.js"></script>
      <script>
        //   M.AutoInit();
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
                constrainWidth:false,
                coverTrigger: false
            });
        });
      </script>
</body>
</html>