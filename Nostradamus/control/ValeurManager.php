<?php
class ValeurManager
{
  private $_db; // Instance de PDO

  public function __construct($db)
  {
    $this->setDb($db);
  }
  public function add(Valeur $uneValeur)
  {
  	// insertion dans la table propriete
    $q = $this->_db->prepare('INSERT INTO valeur SET id_propriete = :id_propriete, value = :valeur');
    $q->bindValue(':id_propriete', $uneValeur->getIdPropriete());
	$q->bindValue(':valeur', $uneValeur->getValeur());
    $q->execute();	
	$uneValeur->setId( $this->_db->lastInsertId());
  }
    public function getValeur($idPropriete) // récupére les valeur de la propriete du produit
  {
    $id = (int) $id;
    $q = $this->_db->query('SELECT value FROM valeur WHERE id_propriete = '.$idPropriete.'and id_produit = '.$idProduit);
    $donnees = $q->fetch(PDO::FETCH_ASSOC);
    return $donnees;
  }

  public function setDb(PDO $db)
  {
    $this->_db = $db;
  }
}
?>