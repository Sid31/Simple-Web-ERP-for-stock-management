<?php
class PropManager
{
  private $_db; // Instance de PDO

  public function __construct($db)
  {
    $this->setDb($db);
  }

  public function add(Prop $uneProp)
  {
  	// insertion dans la table propriete
    $q = $this->_db->prepare('INSERT INTO prop SET id_propriete = :id_propriete, id_produit = :id_produit, valeur = :valeur');
    $q->bindValue(':id_propriete', $uneProp->getIdPropriete());
    $q->bindValue(':id_produit', $uneProp->getIdProduit());
	$q->bindValue(':valeur', $uneProp->getValeur());
    $q->execute();	
	$uneProp->setID( $this->_db->lastInsertId());
  }
    public function getValeur($idPropriete,$idProduit ) // récupére la valeur de la propriete du produit
  {
    $id = (int) $id;
    $q = $this->_db->query('SELECT valeur FROM prop WHERE id_propriete = '.$idPropriete.'and id_produit = '.$idProduit);
    $donnees = $q->fetch(PDO::FETCH_ASSOC);
    return $donnees;
  }

  public function setDb(PDO $db)
  {
    $this->_db = $db;
  }
}
?>