<?php
class Stock
{
	private $_date;
	private $_id;
	private $_idProduit;
	private $_idUtilisateur;
	private $_etatStock;
	
	function __construct($data) {
	   $this->_id=$data['id_stock'];
	   $this->_idProduit=$data['id_produit'];
	   $this->_idUtilisateur=$data['id_utilisateur'];	 
	   $this->_etatStock=$data['etat_stock'];  
    }

	public function getEtatStock()
	{
	    return $this->_etatStock;
    }
	public function setEtatStock($newEtatStock)
	{
	  
      	$this->_etatStock = $newEtatStock;
	}         
	public function getDate()
	{
	    return $this->_date;
    }
	public function getID()
	{
	    return $this->_idProduit;
    }
	public function getIDProduit()
	{
	    return $this->_idProduit;
    }
 
 	public function setId($id)
  	{
   	// On vérifie si c'est un int ID
    	$id = (int) $id; 
    	if ($id > 0)
    	{      
     		 $this->_id = $id;
    	}
 	 }
  
}
?>