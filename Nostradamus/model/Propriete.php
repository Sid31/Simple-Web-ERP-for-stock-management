<?php
class Propriete {
	private $_id;
	private $_nom;
	private $_type;
	private $_valeur;

	function __construct($data) {
		$this -> _nom = $data['nom_propriete'];
		$this -> _type = $data['type_propriete'];
		//this -> _valeur = $data['valeur_prop'];
		$this -> _id = $data['id_propriete'];
	}

	public function getType() {
		return $this -> _type;
	}

	public function getNom() {
		return $this -> _nom;
	}

	public function getID() {
		return $this -> _id;
	}

	public function setId($id) {
		// On vérifie si c'est un int ID
		$id = (int)$id;
		if ($id > 0) {
			$this -> _id = $id;
		}
	}

	public function setNom($nom) {
		// On vérifie si c'est un String
		if (is_string($nom)) {
			$this -> _nom = $nom;
		}
	}

	public function setType($type) {
		// On vérifie si c'est un String
		if (is_string($type)) {
			$this -> _type = $type;
		}
	}

	public function setValeur($valeur) {
		// On vérifie si c'est un String pour l'intant,
		/*
		 * to do: systeme gestion du type de la donnée valeur
		 */
		if (is_string($valeur)) {
			$this -> _type = $type;
		}
	}

	public function hydrate(array $donnees) {
		if (isset($donnees['id'])) {
			$this -> setId($donnees['id']);
		}
		if (isset($donnees['nom'])) {
			$this -> setNom($donnees['nom']);
		}
		if (isset($donnees['type'])) {
			$this -> setNom($donnees['type']);
		}
		if (isset($donnees['valeur'])) {
			$this -> setNom($donnees['valeur']);
		}
	}

}
?>