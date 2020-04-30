<?php
include_once 'app/ControlSesion.inc.php';
include_once 'app/config.inc.php';

Conexion :: abrirConexion();

$totalUsuarios = RepositorioUsuario :: obtenerNumeroUsuarios(Conexion::ObtenerConexion());
?>

<nav class="navbar navbar-default navbar-static-top"> <!-- barra de navegación -->
	<div class="container"> <!-- conteneddor de propósito general -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-espanded="false" aria-controls="navbar">
				<span class="sr-only">Este botón despliega la barra de navegación</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>

			<a class="navbar-brand" href="<?php echo SERVIDOR; ?>">Angel Hernández</a>
		</div>

		<div id="navbar" class="navbar-collapse collapse">
			<ul class="nav navbar-nav"> <!-- lista desordenada -->
				<li><a href="<?php echo RUTA_ENTRADAS; ?>"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Entradas</a></li>
				<li><a href="<?php echo RUTA_FAVORITOS; ?>"><span class="glyphicon glyphicon-star" aria-hidden="true"></span> Favoritos</a></li>
				<li><a href="<?php echo RUTA_AUTORES; ?>"><span class="glyphicon glyphicon-education" aria-hidden="true"></span> Autores</a></li>
			</ul>

			<ul class="nav navbar-nav navbar-right">
				<?php
				if (ControlSesion::sesionIniciada()) {
				?>
					<li>
						<a href="#">
							<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
							<?php echo '' . $_SESSION['nombreUsuario']; ?>
						</a>
					</li>

					<li>
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
							<span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span> Gestor <span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li>
								<a href="#">Entradas</a>
							</li>
							<li>
								<a href="#">Comentarios</a>
							</li>
							<li>
								<a href="#">Usuarios</a>
							</li>
							<li>
								<a href="#">Favoritos</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="<?php echo RUTA_LOGOUT; ?>">
							<span class="glyphicon glyphicon-log-out" aria-hidden="true"></span> Cerrar sesión
						</a>
					</li>
				<?php
				} else {
				?>
					<li>
						<a href="#">
							<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
							<?php
							echo $totalUsuarios;
							?>
						</a>
					</li>
					<li><a href="<?php echo RUTA_LOGIN; ?>"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Iniciar sesión</a></li>
					<li><a href="<?php echo RUTA_REGISTRO; ?>"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Registro</a></li>
				<?php
				}
				?>
			</ul>
		</div>
	</div>
</nav>