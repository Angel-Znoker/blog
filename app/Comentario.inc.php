<?php

class Comentario{
	private $id;
	private $autorId;
	private $entradaId;
	private $titulo;
	private $texto;
	private $fecha;

	public function __construct($id, $autorId, $entradaId, $titulo, $texto, $fecha) {
		$this->id = $id;
		$this->autorId = $autorId;
		$this->entradaId = $entradaId;
		$this->titulo = $titulo;
		$this->texto = $texto;
		$this->fecha = $fecha;
	}

	public function getId() {
		return $this->id;
	}

	public function getAutorId() {
		return $this->autorId;
	}

	public function getEntradaId() {
		return $this->entradaId;
	}

	public function getTitulo() {
		return $this->titulo;
	}

	public function getTexto() {
		return $this->texto;
	}

	public function getFecha() {
		return $this->fecha;
	}

	public function setTitulo($titulo) {
		$this->titulo = $titulo;
	}

	public function setTexto($texto) {
		$this->texto = $texto;
	}
}