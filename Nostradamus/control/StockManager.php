<?php
class StockManager {
	private $_db;
	// Instance de PDO

	public function __construct($db) {
		$this -> setDb($db);
	}

	public function add(Stock $unStock) {
		$now = new DateTime();
		$now->format('Y-m-d H:i:s');    // MySQL datetime format
		 
		$q = $this -> _db -> prepare('INSERT INTO stocks SET etat_stock = :etatStock, date = :date, id_produit= :idProduit');
		$q -> bindValue(':etatStock', $unStock -> getEtatStock());
		$q -> bindValue(':date',date('Y-m-d H:i:s'));
		$q -> bindValue(':idProduit', $unStock -> getIDProduit());
		$q -> execute();
		$unStock -> setID($this -> _db -> lastInsertId());
	}

	public function delete(Stock $unStock) {
		$this -> _db -> exec('DELETE FROM stocks WHERE id_stock =' . $unStock -> getID());
	}
	
	public function get($idProduit){
		$id = (int)$id;		
		$q = $this -> _db -> prepare('SELECT id_utilisateur, etat_stock, date,id_stocks   FROM stocks WHERE id_produit = ?');
		$q->execute(array($idProduit));
		$q -> fetch(PDO::FETCH_ASSOC);
		return new Produit($donnees);
	}
		public function getEtatStock($idProduit){
		$id = (int)$id;		
		$q = $this -> _db -> query('SELECT  t1.etat_stock  FROM stocks t1 WHERE date=(SELECT max(t2.date)
        FROM stocks t2
       WHERE  t2.id_produit = ' . $idProduit.')');
		$donnees = $q -> fetch(PDO::FETCH_ASSOC);
		if($donnees["etat_stock"]==""){
			$donnees["etat_stock"]=0;
		}
		return $donnees["etat_stock"];
	}

	public function setDb(PDO $db) {
		$this -> _db = $db;
	}

}
?>