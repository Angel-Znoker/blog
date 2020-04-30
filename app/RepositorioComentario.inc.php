<?php

include_once 'config.inc.php';
include_once 'Conexion.inc.php';
include_once 'Comentario.inc.php';

class RepositorioComentario{

	public static function insertarComentario($conexion, $comentario) {
		$comentarioInsertado = false;

		if (isset($conexion)) {
			try {
				$sql = "INSERT INTO comentarios(autor_id, entrada_id, titulo, texto, fecha) VALUES(:autor_id, :entrada_id, :titulo, :texto, NOW())";
				$sentencia = $conexion -> prepare($sql);

				$tmp = $comentario->getAutorId();
				$sentencia -> bindParam(':autor_id', $tmp, PDO::PARAM_STR);

				$tmp1 = $comentario->getEntradaId();
				$sentencia -> bindParam(':entrada_id', $tmp1, PDO::PARAM_STR);

				$tmp2 = $comentario -> getTitulo();
				$sentencia -> bindParam(':titulo', $tmp2, PDO::PARAM_STR);

				$tmp3 = $comentario -> getTexto();
				$sentencia -> bindParam(':texto', $tmp3, PDO::PARAM_STR);

				$comentarioInsertado = $sentencia -> execute();
			} catch (PDOException $e) {
				print 'ERROR: ' . $e -> getMessage();
			}
		}

		return $comentarioInsertado;
	}
}