<?php
class ProduitManager {
	private $_db;
	// Instance de PDO

	public function __construct($db) {
		$this -> setDb($db);
	}

	public function add(Produit $unProduit) {
		$q = $this -> _db -> prepare('INSERT INTO produits SET nom_produit = :nom, code_produit = :code ');
		$q -> bindValue(':nom', $unProduit -> getNom());
		$q -> bindValue(':code', $unProduit -> getCode());
		$q -> execute();
		$unProduit -> setID($this -> _db -> lastInsertId());
	}

	public function delete(Produit $unProduit) {
		$this -> _db -> exec('DELETE FROM produits WHERE id_produit =' . $unProduit -> getID());
	}

	public function get($id) {
		$id = (int)$id;

		$q = $this -> _db -> query('SELECT id_produit, nom_produit, code_produit FROM produits WHERE id_produit = ' . $id);
		$donnees = $q -> fetch(PDO::FETCH_ASSOC);
		return new Produit($donnees);
	}
	public function getProduitAvecCode($code) {
		$code = (string)$code;
		$q = $this -> _db -> prepare('SELECT id_produit, nom_produit, code_produit FROM produits WHERE code_produit = ?');
		$q -> execute(array($code));
		$donnees = $q -> fetch(PDO::FETCH_ASSOC);
		return new Produit($donnees);
	}

	public function getList() {
		$produits = array();

		$q = $this -> _db -> query('SELECT id_produit, nom_produit, code_produit FROM produits ORDER BY id_produit');

		while ($donnees = $q -> fetch(PDO::FETCH_ASSOC)) {

			$produits[] = new Produit($donnees);
		}

		return $produits;
	}

	public function update(Produit $unProduit) {
		$q = $this -> _db -> prepare('UPDATE produits SET nom_produit = :nom, code_produit = :code WHERE id_produit = :id');

		$q -> bindValue(':nom', $unProduit -> getNom());
		$q -> bindValue(':code', $unProduit -> getCode());
		$q -> execute();
	}

	public function setDb(PDO $db) {
		$this -> _db = $db;
	}

}
?>