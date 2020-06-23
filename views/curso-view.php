<?php $title = "Curso | $datos_curso[nombre]";
include_once("views/header.php") ?>
<!-- <link rel="stylesheet" href="/css/curso.css"> -->
<div class="row" style="margin: 0;">
	<div class="col s12 l9" style="padding: 0;">
		<div class="video-container">
			<iframe id="video-player" width="1025" height="414" src="https://www.youtube.com/embed/<?php echo $ultimo_visto; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		</div>
		<section class="row" style="padding: 20px; min-height:300px;">
			<ul id="tabs-swipe-demo" class="tabs">
				<li class="hide-on-large-only tab col s3"><a href="#test-swipe-4">Contenido del curso</a></li>
				<li class="tab col s3"><a href="#test-swipe-1" id="tab-descripcion" class="active">Descripción</a></li>
				<!-- <li class="tab col s3"><a href="#test-swipe-2">Preguntas y respuestas</a></li> -->
				<li class="tab col s3"><a href="#test-swipe-3">Anuncios</a></li>
			</ul>
			<div id="test-swipe-4" class="col s12 " style="overflow: auto;">
				<!-- UL del sidebar pasa aquí cuando la pantalla es chica -->
			</div>
			<div id="test-swipe-1" class="col s12">
				<section class="container">
					<div class="section">
						<h5>Descripción</h5>
						<p>
							<?php echo $datos_curso['descripcion']; ?>
						</p>
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
				<section class="container">
					<div class="section">
						<h5>Anuncio</h5>
						<p>
							<?php echo $datos_curso['anuncio']; ?>
						</p>
					</div>
				</section>
			</div>

		</section>
		<?php include_once("views/footer-view.php"); ?>
	</div>

	<div id="sidebar-clases" class="col s12 l3 hide-on-med-and-down" style="padding: 0; height: 100vh; overflow: auto; position: sticky; top:0;">
		<ul class="collection" style="margin: 0">
			<li class="collection-header" style="padding: 0 10px; position:sticky; top:0;">
				<h6>
					<?php echo $datos_curso['nombre']; ?>
				</h6>
			</li>
			<?php for($i = 0; $i < count($clases); $i++): ?>
			<li class="collection-item grey-text text-darken-4 <?php echo$clases[$i]['video'] == $ultimo_visto ? "seleccionado" : '';?>" id="<?php echo $clases[$i]['id']; ?>">
				<div class="row">
					<a href="#!" name="class-selector" data-video="<?php echo $clases[$i]['video']; ?>" class="col s12 grey-text text-darken-4">
						<span class="row">
							<div class="col s1">
								<p>
									<?php echo $i+1; ?>
								</p>
							</div>
							<div class="col s11">
								<p>
									<?php echo $clases[$i]['titulo']; ?>
								</p>
							</div>
						</span>
					</a>
					<div class="col s6">
						<label class="secondary-content grey-text text-darken-4" style="float: none;">
							<input type="checkbox" <?php if(isset($vistos) && $vistos[$i]['visto']) echo "checked" ?>>
							<span>Visto</span>
						</label>
					</div>
					<div class="col s6">
						<span class="right"><?php echo toReadableTime($clases[$i]['duracion']); ?></span>
					</div>
				</div>
				<style>
					.collection-item.seleccionado{
						background-color: #00897b50;
					}
				</style>
			</li>
			<?php endfor; ?>
		</ul>
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
<script>
	document.addEventListener("DOMContentLoaded", function(){
		let elems = document.querySelectorAll(".tabs");
		let instance = M.Tabs.init(elems,{});
	})
</script>
<script src="/js/curso.js"></script>
