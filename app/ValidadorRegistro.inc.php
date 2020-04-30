<?php

include_once 'RepositorioUsuario.inc.php';

class ValidadorRegistro{

	private $avisoInicio;
	private $avisoCierre;

	private $nombre;
	private $email;
	private $clave;

	private $errorNombre;
	private $errorEmail;
	private $errorClave1;
	private $errorClave2;

	// funcion constructor
	function __construct($nombre, $email, $clave1, $clave2, $conexion) {
		$this -> avisoInicio = "<br><div class='alert alert-danger' role='alert'>";
		$this -> avisoCierre = "</div>";

		$this -> nombre = "";
		$this -> email = "";
		$this -> clave = "";

		$this -> errorNombre = $this -> validarNombre($conexion, $nombre);
		$this -> errorEmail = $this -> validarEmail($conexion, $email);
		$this -> errorClave1 = $this -> validarClave1($clave1);
		$this -> errorClave2 = $this -> validarClave2($clave1, $clave2);

		if ($this -> errorClave1 === "" && $this -> errorClave2 === "") {
			$this -> clave = $clave1;
		}
	}

	// se verifican si las variables tienen contenido
	private function variableIniciada($variable) {
		if (isset($variable) && !empty($variable)) {
			return true;
		} else {
			return false;
		}
	}

	// Se valida que el nombre sea correcto
	private function validarNombre($conexion, $nombre) {
		if (!$this -> variableIniciada($nombre)) {
			return "Debes de escribir un nombre de usuario";
		} else {
			$this -> nombre = $nombre;
		}

		if (strlen($nombre) < 6) {
			return "El nombre debe tener más de 6 carácteres";
		}

		if (strlen($nombre) > 24) {
			return "El nombre no debe tener más de 24 carácteres";
		}

		if (RepositorioUsuario::nombreExiste($conexion, $nombre)) {
			return "Este nombre de usuario existe. Prueba con otro.";
		}

		return "";
	}

	// Se valida que el email sea correcto
	private function validarEmail($conexion, $email) {
		if (!$this -> variableIniciada($email)) {
			return "Debes proporcionar un email";
		} else {
			$this -> email = $email;
		}

		if (RepositorioUsuario::emailExiste($conexion, $email)) {
			return "Este email ya esta en uso. Pruebe con otro o <a href='#'>intente recuperar su contraseña</a>";
		}

		return "";
	}

	// Se valida que la contraseña se haya escrito
	private function validarClave1($clave1) {
		if (!$this -> variableIniciada($clave1)) {
			return "Debes escribir una contraseña";
		}

		return "";
	}

	// Se verifica que la segunda contraseña sea correcta
	private function validarClave2($clave1, $clave2) {
		if (!$this -> variableIniciada($clave1)) {
			return "Debes llenar el campo Contraseña";
		}

		if (!$this -> variableIniciada($clave2)) {
			return "Debes repetir tu contraseña";
		}

		if ($clave1 !== $clave2) {
			return "Ambas contraseñas deben coincidir";
		}

		return "";
	}

	// getters
	public function getNombre() {
		return $this -> nombre;
	}

	public function getEmail() {
		return $this -> email;
	}

	public function getClave() {
		return $this -> clave;
	}

	public function getErrorNombre() {
		return $this -> errorNombre;
	}

	public function getErrorEmail() {
		return $this -> errorEmail;
	}

	public function getErrorClave1() {
		return $this -> errorClave1;
	}

	public function getErrorClave2() {
		return $this -> errorClave2;
	}

	// Mostrar en página registro.php
	public function mostrarNombre() {
		if ($this -> nombre !== "") {
			echo 'value="' . $this -> nombre . '"';
		}
	}

	public function mostrarErrorNombre() {
		if ($this -> errorNombre !== "") {
			echo $this -> avisoInicio . $this -> errorNombre . $this -> avisoCierre;
		}
	}

	public function mostrarEmail() {
		if ($this -> email !== "") {
			echo 'value="' . $this -> email . '"';
		}
	}

	public function mostrarErrorEmail() {
		if ($this -> errorEmail !== "") {
			echo $this -> avisoInicio . $this -> errorEmail . $this -> avisoCierre;
		}
	}

	public function mostrarErrorClave1() {
		if ($this -> errorClave1 !== "") {
			echo $this -> avisoInicio . $this -> errorClave1 . $this -> avisoCierre;
		}
	}

	public function mostrarErrorClave2() {
		if ($this -> errorClave2 !== "") {
			echo $this -> avisoInicio . $this -> errorClave2 . $this -> avisoCierre;
		}
	}

	// Validación de no errores
	public function registroValido() {
		if ($this -> errorNombre === "" &&
			$this -> errorEmail === "" &&
			$this -> errorClave1 === "" &&
			$this -> errorClave1 === "") {
			return true;
		} else {
			return false;
		}
	}

}