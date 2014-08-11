<?php
class Prop {
	//private $_idProp;
	private $_idProduit;
	private $_idPropriete;
	private $_valeur;
	private $_idProp;
	function __construct($data) {
		$this -> _idPropriete = $data['id_propriete'];
		$this -> _valeur = $data['valeur'];
		$this -> _idProduit = $data['id_produit'];
	}

	public function getIdPropriete() {
		return $this -> _idPropriete;
	}

	public function getValeur() {
		return $this -> _valeur;
	}

	public function getIdProduit() {
		return $this -> _idProduit;
	}

	public function setIdProduit($id) {
		// On vérifie si c'est un int ID
		$id = (int)$id;
		if ($id > 0) {
			$this -> _idProp = $id;
		}
	}
		public function setId($id) {
		// On vérifie si c'est un int ID
		$id = (int)$id;
		if ($id > 0) {
			$this -> _idProduit = $id;
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