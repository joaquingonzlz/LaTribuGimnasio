<?php $title = "Área principal";
	include_once("views/header.php"); ?>
	<!-- home -->
	<div class="container" style="min-height: calc(100vh - 276.49px);">
		<div class="row" style="padding: 10px 0;">
			<div class="col s12">
				<div class="slider" style="height: 200px; width: 100%;">
					<ul class="slides">
						<li>
							<img src="/img/photo01.png" class="responsive-img">
						</li>
						<li>
							<img src="/img/photo02.png" class="responsive-img">
						</li>
					</ul>
				</div>
			</div>
			<div class="col s12">
				<h4>Hola de nuevo, <?php echo $neverpony; ?>
				</h4>
				<h6 class="grey-text" style="margin-bottom: 30px">¿Preparad<?php echo $hombre ? "o" : "a"; ?> para volver a entrenar?</h6>
			</div>
			<div class="row" style="margin-top: 50px !important;">
				<div class="col s12" style="overflow: hidden; background: #eee;">
					<?php foreach($cursos as $curso): ?>
					<div class="col s12 l5 card horizontal" style="padding:0">
						<div class="card-image" style="height: 214.51px; width: 150px;">
							<img src="/img/logo.jpg" height="100%" class="of-cover">
						</div>
						<div class="card-stacked">
							<div class="card-content" style="padding: 5 !important;">
								<p class="titulo">
									<?php echo $curso['nombre']; ?>
								</p>
								<p class="contenido">
									<?php echo $curso['descripcion']; ?>
								</p>
								<div class="red" style="margin-top: 20px">
									<div class="progress">
										<div class="determinate" style="width: <?php echo $curso['progreso']." % "; ?>"></div>
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
	<style>
          .titulo{
              font-weight: 500;
              line-height: 20px;
          }

          .contenido{
              height: 40px;
              overflow: hidden;
          }

          .of-cover{
              object-fit: cover;
          }
      </style>
	<?php include_once("views/footer-view.php"); ?>
	
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			var elems = document.querySelectorAll('.slider');
			var instances = M.Slider.init(elems,{height:200,indicators:false,duration: 20});
		});

	</script>
    </body>
</html>