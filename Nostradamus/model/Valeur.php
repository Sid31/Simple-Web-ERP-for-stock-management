<?php
class Valeur {
	//private $_idProp;
	private $_idValeur;
	private $_idPropriete;
	private $_valeur;
	
	function __construct($data){
		$this -> _idPropriete = $data['id_propriete'];
		$this -> _valeur = $data['valeur'];
		//$this -> $_idValeur = $data['idValeur'];
	}

	public function getIdPropriete() {
		return $this -> _idPropriete;
	}
	public function getIdValeur() {
		return $this -> _idValeur;
	}

	public function getValeur() {
		return $this -> _valeur;
	}

	public function setId($id) {
		// On vérifie si c'est un int ID
		$id = (int)$id;
		if ($id > 0) {
			$this -> _idValeur = $id;
		}
	}
	public function setIdPropriete($id) {
		// On vérifie si c'est un int ID
		$id = (int)$id;
		if ($id > 0) {
			$this -> _idPropriete = $id;
		}
	}
	public function setValeur($valeur) {
		// On vérifie si c'est un String
			$this -> _valeur = $valeur;
	}

}
?>