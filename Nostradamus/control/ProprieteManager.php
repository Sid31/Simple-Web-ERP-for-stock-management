<?php
class ProprieteManager
{
  private $_db; // Instance de PDO

  public function __construct($db)
  {
    $this->setDb($db);
  }

  public function add(Propriete $unePropriete)
  {
  	// insertion dans la table propriete
    $q = $this->_db->prepare('INSERT INTO proprietes SET nom_propriete = :nom, type_propriete = :type ');
    $q->bindValue(':nom', $unePropriete->getNom());
    $q->bindValue(':type', $unePropriete->getType());
    $q->execute();	
	$unePropriete->setID( $this->_db->lastInsertId());
  }

  public function delete(Propriete $unePropriete)
  {
    $this->_db->exec('DELETE FROM proprietes WHERE id_propriete ='.$unePropriete->getID()); // suppression de la propriete de la table propriete
	$this->_db->exec('DELETE FROM prop WHERE id_propriete ='.$unePropriete->getID()); // suppression des valeurs de propriete de la table prop
  }

  public function getPropriete($id) // récupére la proprieté general
  {
      $id = (int) $id;
    $q = $this->_db->query('SELECT id_propriete, nom_propriete, type_propriete FROM proprietes WHERE id_propriete = '.$id);
    $donnees = $q->fetch(PDO::FETCH_ASSOC);
    return new Propriete($donnees);
  }
    public function getIDPropriete($nom) // récupére la proprieté general
  {      
    //$q = $this->_db->query('SELECT id_propriete FROM proprietes WHERE nom_propriete = '.$nom);
	$q = $this->_db->prepare('SELECT id_propriete FROM proprietes WHERE nom_propriete = ?');
    $donnees = $q->execute(array($nom));
	$donnees = $q->fetch(); 
    return ($donnees[0]);
  }
    public function getValeur($idPropriete,$idProduit ) // récupére la valeur de la propriete du produit
  {
    $id = (int) $id;
    $q = $this->_db->query('SELECT valeur FROM prop WHERE id_propriete = '.$idPropriete.'and id_produit = '.$idProduit);
    $donnees = $q->fetch(PDO::FETCH_ASSOC);
    return new Propriete($donnees);
  }

  public function getList() // renvoi la liste de toutes les proprietes de la base
  {
    $proprietes = array();

    $q = $this->_db->query('SELECT id_propriete, nom_propriete, type_propriete FROM proprietes ORDER BY id_propriete');

    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {    	
      $proprietes[] = new Propriete($donnees);
    }
    return $proprietes;
  }
    public function getListProprieteDunProduit($idProduit) // renvoi la liste de toutes les proprietes d'un produit
  {
    $proprietes = array(); // todo : test de la requete
    $q = $this->_db->query('SELECT p1.nom_propriete	FROM propriete p1, prop p2	WHERE p2.id_produit='.$idProduit.'AND p2.id_propriete=p1.propriete');

    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
    	
      $proprietes[] = new Propriete($donnees);
    }
    return $proprietes;
  }

  public function update(Propriete $unePropriete)
  {
    $q = $this->_db->prepare('UPDATE proprietes SET nom_propriete = :nom, type_propriete = :type WHERE id_propriete = :id');
    $q->bindValue(':nom', $unePropriete->getNom());
    $q->bindValue(':type', $unePropriete->getType());
	$q->bindValue(':id', $unePropriete->getID());
    $q->execute();
  }

  public function setDb(PDO $db)
  {
    $this->_db = $db;
  }
}
?>