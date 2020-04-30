<?php
include_once 'app/Conexion.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/EscritorEntradas.inc.php';

$titulo = "Blog (Proyecto web)";

include_once 'plantillas/documentoApertura.inc.php';
include_once 'plantillas/navbar.inc.php';
?>

<!-- contenido -->

<div class="container">
	<div class="jumbotron">
		<h1>Angel Hernández | Blog</h1>
		<p>Blog dedicado a la programación y el desarrollo</p>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-4">
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<span class="glyphicon glyphicon-search" aria-hidden="true"></span> Búsqueda
						</div>

						<div class="panel-body">
							<div class="form-group">
								<input type="search" class="form-control" placeholder="¿Qué buscas?">
							</div>
							<button class="form-control">Buscar</button>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<span class="glyphicon glyphicon-filter" aria-hidden="true"></span> Filtro
						</div>

						<div class="panel-body">

						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-heading">
							<span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Archivo
						</div>

						<div class="panel-body">

						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-md-8">
			<?php
				EscritorEntradas::escribirEntradas();
			?>
		</div>
	</div>
</div>

<?php
include_once 'plantillas/documentoCierre.inc.php';
?>