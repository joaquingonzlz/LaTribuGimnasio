<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La Tribu Gimnasio</title>
    <link rel="stylesheet" href="css/materialize.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <nav style="background: #29303b;">
        <div class="nav-wrapper container">
          <a href="#" class="brand-logo">La Tribu</a>
          <a href="#" data-target="menu-responsive" class="sidenav-trigger">
            <i class="material-icons">menu</i>
          </a>

          <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="sass.html">Mis Cursos</a></li>
            <li><a href="badges.html">Cuenta</a></li>
          </ul>
        </div>
    </nav>

    <ul class="sidenav" id="menu-responsive">
      <li>
        <div class="user-view">
          <div class="background">
            <img class="responsive-img" src="img/logo.jpg">
          </div>
        </div>

        <a href="#user"><img class="circle responsive-img" src="img/01.jpg"></a>
        <a href="#name"><span class="white-text name">John Doe</span></a>
        <a href="#email"><span class="white-text email">jdandturk@gmail.com</span></a>
      </li>

      <li><a href="sass.html">Mis Cursos</a></li>
      <li><a href="badges.html">Cuenta</a></li>
    </ul>

    <div class="row" style="margin: 0;">
      <div class="col s12 l9" style="padding: 0;">
		<div class="video-container">
          <iframe width="1025" height="414" src="https://www.youtube.com/embed/g0kfSyVYWoo" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        </div>
        <section style="padding: 20px;">
          <ul id="tabs-swipe-demo" class="tabs">
            <li class="tab col s3 show-on-medium-and-down"><a href="#test-swipe-4">Contenido del curso</a></li>
            <li class="tab col s3"><a href="#test-swipe-1" class="active">Descripción</a></li>
            <!-- <li class="tab col s3"><a href="#test-swipe-2">Preguntas y respuestas</a></li> -->
            <li class="tab col s3"><a href="#test-swipe-3">Anuncios</a></li>
          </ul>
          <div id="test-swipe-1" class="col s12">
            <section class="container">
              <div class="divider"></div>
                <div class="section">
				  <h5>Descripción</h5>
				  <p><?php echo $datos_curso['descripcion']; ?></p>
                </div>
            </section>
          </div>
          <!-- <div id="test-swipe-2" class="col s12">
            <section class="container">
              <div class="divider"></div>
              <div class="section">
                <h5>Preguntas y respuestas</h5>
                <p>Stuff</p>
              </div>
            </section>
          </div> -->
          <div id="test-swipe-3" class="col s12">
			  <p><?php echo $datos_curso['anuncio']; ?></p>
		  </div>
          
          <div id="test-swipe-4" class="col s12 ">
			  <!-- UL del sidebar pasa aquí cuando la pantalla es chica -->
          </div>
          
        </section>
      </div>

      <div id="sidebar-clases" class="col s12 l3 hide-on-med-and-down" style="padding: 0; height: calc(100vh - 63.99px); overflow: auto;position:fixed;right: 0;">
        <ul class="collection" style="margin: 0">
          <li class="collection-header" style="padding: 0 10px;"><h6><?php echo $datos_curso['nombre']; ?></h6></li>
          <?php for($i = 0; $i < count($clases); $i++): ?>
          <li class="collection-item">
            <div class="row">
              <div class="col s1">
                <p><?php echo $i; ?></p>
              </div>
              <div class="col s11">
                <p><?php echo $clases[$i]['titulo']; ?></p>
              </div>
              <div class="col s6">
                <form>
                  <p style="margin: 0;">
                    <label>
                      <input type="checkbox" <?php if(isset($vistos) && $vistos[$i]['visto']) echo "checked" ?>>
                      <span>Visto</span>
                    </label>
                  </p>
                </form>
              </div>
              <div class="col s6">
                <span class="right"><?php echo $clases[$i]['duracion']; ?></span>
              </div>
            </div>
		  </li>
		  <?php endfor; ?>
        </ul>
      </div>
    </div>
    
    <script src="js/materialize.min.js"></script>
    <script>
        M.AutoInit();
    </script>
</body>
</html>