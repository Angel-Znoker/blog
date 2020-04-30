<?php

include_once 'app/config.inc.php';
include_once 'app/Conexion.inc.php';

include_once 'app/Usuario.inc.php';
include_once 'app/Entrada.inc.php';
include_once 'app/Comentario.inc.php';

include_once 'app/RepositorioUsuario.inc.php';
include_once 'app/RepositorioEntrada.inc.php';
include_once 'app/RepositorioComentario.inc.php';

	$componentesUrl = parse_url($_SERVER['REQUEST_URI']);

	$ruta = $componentesUrl['path'];

	$partesRuta = explode('/', $ruta); // Divide un array con el caracter indicado
	$partesRuta = array_filter($partesRuta); // Los strings vacios se convierten en null
	$partesRuta = array_slice($partesRuta, 0); // Elimina indices vacios de un array

	$rutaElegida = 'vistas/404.php';

	if ($partesRuta[0] == 'blog') {
		if (count($partesRuta) == 1) {
			$rutaElegida = 'vistas/home.php';
		} else if (count($partesRuta) == 2) {
			switch ($partesRuta[1]) {
				case 'login':
					$rutaElegida = 'vistas/login.php';
					break;

				case 'logout':
					$rutaElegida = 'vistas/logout.php';
					break;

				case 'registro':
					$rutaElegida = 'vistas/registro.php';
					break;

				case 'relleno-blg':
					$rutaElegida = 'vistas/scriptRelleno.php';
					break;
			}
		} else if (count($partesRuta) == 3) {
			if ($partesRuta[1] == 'registro-correcto') {
				$nombre = $partesRuta[2];
				$rutaElegida = 'vistas/registroCorrecto.php';
			}

			if ($partesRuta[1] == 'entrada') {
				$url = $partesRuta[2];

				Conexion::abrirConexion();
				$entrada = RepositorioEntrada::obtenerEntradaPorUrl(Conexion::obtenerConexion(), $url);

				if ($entrada != null) {
					$rutaElegida = 'vistas/entrada.php';
				}
			}
		}
	}

	include_once $rutaElegida;
