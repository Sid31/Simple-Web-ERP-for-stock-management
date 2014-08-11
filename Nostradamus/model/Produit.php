<?php
class Produit
{
	private $_nom;
	private $_code;
	private $_id;
	private $_proprietes;
	
	function __construct($data) {
		
       $this->_nom=$data['nom_produit'];
	   $this->_code=$data['code_produit'];
	   $this->_id=$data['id_produit'];	 	 
	     
    }

	public function getPropriete()
	{
	    return $this->_propriete;
    }
	public function setPropriete($propriete)
	{
	   if (is_string($propriete))
    	{
      	$this->_propriete = $propriete;
    	}
	}         
	public function getCode()
	{
	    return $this->_code;
    }
	public function getNom()
	{
	    return $this->_nom;
    }
	public function getID()
	{
	    return $this->_id;
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
  
	public function setNom($nom)
  	{
    	// On vérifie si c'est un String
    	if (is_string($nom))
    	{
      	$this->_nom = $nom;
    	}
	}
		public function setCode($code)
  		{
	    	// On vérifie si c'est un String
	    	if (is_string($code))
	    	{
	      	$this->_nom = $nom;
    	}
	}
		public function hydrate(array $donnees)
		{
			if (isset($donnees['id']))
			{
		    	$this->setId($donnees['id']);
			}		
		  	if (isset($donnees['nom']))
		  	{
		    	$this->setNom($donnees['nom']);
	  		}
			if (isset($donnees['code']))
		  	{
		    	$this->setNom($donnees['code']);
	  		}			
		}
}
?>