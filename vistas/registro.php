<?php
include_once 'app/Conexion.inc.php';
include_once 'app/Usuario.inc.php';
include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/ValidadorRegistro.inc.php';
include_once 'app/Redireccion.inc.php';

if (isset($_POST['enviar'])) {
	Conexion::abrirConexion();

	$validador = new ValidadorRegistro($_POST['nombre'], $_POST['email'], $_POST['clave1'], $_POST['clave2'], Conexion::obtenerConexion());

	if ($validador -> registroValido()) {
		$usuario = new Usuario('', $validador -> getNombre(), $validador -> getEmail(), password_hash($validador -> getClave(), PASSWORD_DEFAULT), '', '');
		$usuarioInsertado = RepositorioUsuario :: insertarUsuario(Conexion :: obtenerConexion(), $usuario);

		if ($usuarioInsertado) {
			// Redirigir a activación de cuenta
			Redireccion::redirigir(RUTA_REGISTRO_CORRECTO . '/' . $usuario -> getNombre());
		}
	}

	Conexion::cerrarConexion();
}

$titulo = "Registro";

include_once 'plantillas/documentoApertura.inc.php';
include_once 'plantillas/navbar.inc.php';
?>

<div class="container">
	<div class="jumbotron">
		<h1 class="text-center">Formulario de registro</h1>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-6 text-center">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Instrucciones</h3>
				</div>

				<div class="panel-body">
					<br>
					<p class="text-justify">
						Para unirte al blog introduce un nombre de usuario, tu email y una contraseña. El email que proporciones debe ser real ya que lo necesitarás para gestionar tu cuenta.
						Te recomendamos que uses una contraseña que contenga letras minúsculas, mayúsculas, números y símbolos.
					</p>
					<br>
					<a href="<?php echo RUTA_LOGIN; ?>">¿Ya tienes una cuenta? Inicia sesión</a>
					<br>
					<br>
					<a href="#">¿Olvidaste tu contraseña?</a>
				</div>
			</div>
		</div>

		<div class="col-md-6 text-center">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Introduce tus datos</h3>
				</div>

				<div class="panel-body">
					<form role="form" method="post" action="<?php echo RUTA_REGISTRO ?>">
						<?php
						if (isset($_POST['enviar'])) {
							include_once 'plantillas/registroValidado.inc.php';
						} else {
							include_once 'plantillas/registroVacio.inc.php';
						}
						?>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
include_once 'plantillas/documentoCierre.inc.php';
?>