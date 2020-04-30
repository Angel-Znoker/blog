<div class="form-group">
	<label>Nombre de usuario</label>
	<input type="text" class="form-control" name="nombre" placeholder="Nombre_Usuario" <?php $validador -> mostrarNombre() ?>>
	<?php
	$validador -> mostrarErrorNombre();
	?>
</div>

<div class="form-group">
	<label>Email</label>
	<input type="email" class="form-control" name="email" placeholder="usuario@servidor.com" <?php $validador -> mostrarEmail() ?>>
	<?php
	$validador -> mostrarErrorEmail();
	?>
</div>

<div class="form-group">
	<label>Contraseña</label>
	<input type="password" class="form-control" name="clave1">
	<?php
	$validador -> mostrarErrorClave1();
	?>
</div>

<div class="form-group">
	<label>Repite la contraseña</label>
	<input type="password" class="form-control" name="clave2">
	<?php
	$validador -> mostrarErrorClave2();
	?>
</div>
<br>
<button type="reset" class="btn btn-default">Limpiar formulario</button>
<button type="submit" class="btn btn-default" name="enviar">Enviar datos</button>