<?php

class RepositorioUsuario {

	public static function obtenerTodos($conexion) {
		$usuarios = array();

		if (isset($conexion)) {
			try {
				include_once 'Usuario.inc.php';

				$sql = "SELECT * FROM usuarios";

				$sentencia = $conexion -> prepare($sql);
				$sentencia -> execute();

				$resultado = $sentencia -> fetchAll();

				if (count($resultado)) {
					foreach ($resultado as $fila) {
						$usuarios[] = new Usuario($fila["id"], $fila["nombre"], $fila["email"], $fila["password"], $fila["fecha_registro"], $fila["activo"]);
					}
				} else {
					print "No hay usuarios";
				}
			} catch (PDOException $e) {
				print "ERROR: " . $e -> getMessage();
			}
		}

		return $usuarios;
	}

	public static function obtenerNumeroUsuarios($conexion) {
		$totalUsuarios = null;

		if (isset($conexion)) {
			try {
				$sql = "SELECT COUNT(*) as total FROM usuarios";

				$sentencia = $conexion -> prepare($sql);
				$sentencia -> execute();
				$resultado = $sentencia -> fetch();

				$totalUsuarios = $resultado['total'];
			} catch (PDOException $e) {
				print "ERROR: " . $e -> getMessage();
			}
		}

		return $totalUsuarios;
	}

	public static function insertarUsuario($conexion, $usuario) {
		$usuarioInsertado = false;

		if (isset($conexion)) {
			try {
				$sql = "INSERT INTO usuarios(nombre, email, password, fecha_registro, activo) VALUES(:nombre, :email, :password, NOW(), 0)";
				$sentencia = $conexion -> prepare($sql);

				$tmp = $usuario -> getNombre();
				$sentencia -> bindParam(':nombre', $tmp, PDO::PARAM_STR);

				$tmp1 = $usuario -> getEmail();
				$sentencia -> bindParam(':email', $tmp1, PDO::PARAM_STR);

				$tmp2 = $usuario -> getPassword();
				$sentencia -> bindParam(':password', $tmp2, PDO::PARAM_STR);

				$usuarioInsertado = $sentencia -> execute();
			} catch (PDOException $e) {
				print 'ERROR: ' . $e -> getMessage();
			}
		}

		return $usuarioInsertado;
	}

	public static function nombreExiste($conexion, $nombre) {
		$nombreExiste = true;

		if (isset($conexion)) {
			try {
				$sql = "SELECT * FROM usuarios WHERE nombre = :nombre";

				$sentencia = $conexion -> prepare($sql);
				$sentencia -> bindParam(':nombre', $nombre, PDO::PARAM_STR);
				$sentencia -> execute();
				$resultado = $sentencia -> fetchAll();

				if (count($resultado)) {
					$nombreExiste = true;
				} else {
					$nombreExiste = false;
				}
			} catch (PDOException $e) {
				print 'ERROR: ' . $e -> getMessage();
			}
		}

		return $nombreExiste;
	}

	public static function emailExiste($conexion, $email) {
		$emailExiste = true;

		if (isset($conexion)) {
			try {
				$sql = "SELECT * FROM usuarios WHERE email = :email";

				$sentencia = $conexion -> prepare($sql);
				$sentencia -> bindParam(':email', $email, PDO::PARAM_STR);
				$sentencia -> execute();
				$resultado = $sentencia -> fetchAll();

				if (count($resultado)) {
					$emailExiste = true;
				} else {
					$emailExiste = false;
				}
			} catch (PDOException $e) {
				print 'ERROR: ' . $e -> getMessage();
			}
		}

		return $emailExiste;
	}

	public static function obtenerUsuarioPorEmail($conexion, $email) {
		$usuario = null;

		if (isset($conexion)) {
			try {
				include_once 'Usuario.inc.php';

				$sql = "SELECT * FROM usuarios WHERE email = :email";

				$sentencia = $conexion -> prepare($sql);
				$sentencia->bindParam(':email', $email, PDO::PARAM_STR);
				$sentencia->execute();

				$resultado = $sentencia->fetch();

				if (!empty($resultado)) {
					$usuario = new Usuario($resultado['id'], $resultado['nombre'], $resultado['email'], $resultado['password'], $resultado['fecha_registro'], $resultado['activo']);
				}
			} catch (PDOException $e) {
				print "ERROR: " . $e->getMessage();
			}
		}

		return $usuario;
	}
}