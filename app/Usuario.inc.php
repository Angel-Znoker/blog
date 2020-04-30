<?php

class Usuario {
	private $id;
	private $nombre;
	private $email;
	private $password;
	private $fecha_registro;
	private $activo;

	public function __construct($id, $nombre, $email, $password, $fecha_registro, $activo) {
		$this->id = $id;
		$this->nombre = $nombre;
		$this->email = $email;
		$this->password = $password;
		$this->fecha_registro = $fecha_registro;
		$this->activo = $activo;
	}

	public function getId() {
		return $this->id;
	}

	public function getNombre() {
		return $this->nombre;
	}

	public function getEmail() {
		return $this->email;
	}

	public function getPassword() {
		return $this->password;
	}

	public function getFecha() {
		return $this->fecha_registro;
	}

	public function estaActivo() {
		return $this->activo;
	}

	public function setNombre($nombre) {
		$this->nombre = $nombre;
	}

	public function setEmail($email) {
		$this->email = $email;
	}

	public function setPassword($password) {
		$this->password = $password;
	}

	public function setActivo($activo) {
		$this->activo = $activo;
	}

}