<?php

include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';

include_once 'app/Usuario.inc.php';
include_once 'app/Entrada.inc.php';
include_once 'app/Comentario.inc.php';

include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/RepositorioEntrada.inc.php';
include_once 'app/RepositorioComentario.inc.php';

Conexion::abrirConexion();

// Usuarios
for ($i = 0; $i < 100; $i++) {
	$nombre = stringAleatorio(10);
	$email = stringAleatorio(5) . '@' . stringAleatorio(3) . '.com';
	$clave = password_hash('123456', PASSWORD_DEFAULT);

	$usuario = new Usuario('', $nombre, $email, $clave, '', '');

	RepositorioUsuario::insertarUsuario(Conexion::obtenerConexion(), $usuario);
}

// Entradas
for ($i=0; $i < 100; $i++) {
	$titulo = stringAleatorio(15);
	$url = $titulo;
	$texto = lorem();
	$autor = rand(1, 100);

	$entrada = new Entrada('', $autor, $url, $titulo, $texto, '', '');

	RepositorioEntrada::insertarEntrada(Conexion::obtenerConexion(), $entrada);
}

// Comentarios
for ($i=0; $i < 100; $i++) {
	$titulo = stringAleatorio(15);
	$texto = lorem();
	$autor = rand(1, 100);
	$entrada = rand(1, 100);

	$comentario =  new Comentario('', $autor, $entrada, $titulo, $texto, '');

	RepositorioComentario::insertarComentario(Conexion::obtenerConexion(), $comentario);
}

function stringAleatorio($longitud) {
	$caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$numeroCaracteres = strlen($caracteres);
	$stringAleatorio = '';

	for ($i=0; $i < $longitud; $i++) {
		$stringAleatorio .= $caracteres[rand(0, $numeroCaracteres - 1)];
	}

	return $stringAleatorio;
}

function lorem() {
	return 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas bibendum sapien vel lacinia placerat. Nunc id suscipit ipsum. Morbi tempus malesuada quam, a ornare turpis hendrerit vitae. Morbi commodo eros ac odio varius, ut ultrices mauris mollis. Vestibulum vel lacus condimentum, sollicitudin neque at, pharetra orci. Vestibulum mollis libero a semper efficitur. Donec egestas viverra eros non suscipit. Praesent dapibus rutrum blandit. Cras convallis egestas odio, a varius nulla aliquet nec. Vestibulum placerat eget leo vitae molestie. Suspendisse vel luctus lacus, ut euismod orci. Vivamus ut lectus id sem rutrum mollis. Aliquam sagittis, leo eu cursus porta, ex nunc auctor justo, non molestie nisi est aliquam massa. Etiam id leo id arcu vestibulum ultrices id nec lectus. Praesent consectetur augue eu elit pretium, id iaculis mauris fringilla.

	Nam eget nunc tempus, sagittis ligula sed, euismod urna. Ut accumsan, erat sit amet iaculis tempus, elit metus porttitor quam, vitae convallis erat erat sit amet justo. Curabitur molestie nisi vitae enim interdum iaculis. Interdum et malesuada fames ac ante ipsum primis in faucibus. Phasellus euismod venenatis maximus. Morbi nec ultrices tellus. Nam nec felis eu ipsum egestas volutpat ac non massa. Nam sit amet risus elit. Donec quis consectetur nisl. Praesent mattis vulputate molestie. In hac habitasse platea dictumst. Maecenas elit eros, finibus sit amet mauris vel, eleifend porta neque.';
}