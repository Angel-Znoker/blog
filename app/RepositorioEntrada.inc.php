<?php

include_once 'config.inc.php';
include_once 'Conexion.inc.php';
include_once 'Entrada.inc.php';

class RepositorioEntrada {

	public static function insertarEntrada($conexion, $entrada) {
		$entradaInsertada = false;

		if (isset($conexion)) {
			try {
				$sql = "INSERT INTO entradas(autor_id, url, titulo, texto, fecha, activa) VALUES(:autor_id, :url, :titulo, :texto, NOW(), 0)";
				$sentencia = $conexion -> prepare($sql);

				$tmp = $entrada->getAutorId();
				$sentencia -> bindParam(':autor_id', $tmp, PDO::PARAM_STR);

				$aux = $entrada->getUrl();
				$sentencia -> bindParam(':url', $aux, PDO::PARAM_STR);

				$tmp1 = $entrada -> getTitulo();
				$sentencia -> bindParam(':titulo', $tmp1, PDO::PARAM_STR);

				$tmp2 = $entrada -> getTexto();
				$sentencia -> bindParam(':texto', $tmp2, PDO::PARAM_STR);

				$entradaInsertada = $sentencia -> execute();
			} catch (PDOException $e) {
				print 'ERROR: ' . $e -> getMessage() . "<br>";
			}
		}

		return $entradaInsertada;
	}

	public static function obtener_todas_por_fecha_descendiente($conexion) {
		$entradas = [];

		if (isset($conexion)) {
			try {
				$sql = "SELECT * FROM entradas ORDER BY fecha DESC LIMIT 5";
				$sentencia = $conexion->prepare($sql);
				$sentencia->execute();

				$resultado = $sentencia->fetchAll();

				if (count($resultado)) {
					foreach ($resultado as $fila) {
						$entradas[] = new Entrada($fila['id'], $fila['autor_id'], $fila['url'], $fila['titulo'], $fila['texto'], $fila['fecha'], $fila['activa']);
					}
				}
			} catch (PDOException $e) {
				print "ERROR: " . $e->getMessage();
			}
		}

		return $entradas;
	}

	public static function obtenerEntradaPorUrl($conexion, $url) {
		$entrada = null;

		if (isset($conexion)) {
			try {
				$sql = "SELECT * FROM entradas WHERE url LIKE :url";

				$sentencia = $conexion->prepare($sql);
				$sentencia->bindParam(':url', $url, PDO::PARAM_STR);
				$sentencia->execute();

				$resultado = $sentencia->fetch();

				if (!empty($resultado)) {
					$entrada = new Entrada($resultado['id'], $resultado['autor_id'], $resultado['url'], $resultado['titulo'], $resultado['texto'], $resultado['fecha'], $resultado['activa']);
				}
			} catch (PDOException $e) {
				print 'ERROR: ' . $e->getMessage();
			}
		}

		return $entrada;
	}
}