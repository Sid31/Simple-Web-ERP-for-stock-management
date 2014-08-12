
-- Replace all databaseName by your own database name
-- -----------------------------------------------------
-- Table `databaseName`.`dernier_stock`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `databaseName`.`dernier_stock` (
  `id_produit` INT(11) NOT NULL ,
  `stock` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`id_produit`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `databaseName`.`produits`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `databaseName`.`produits` (
  `id_produit` INT(11) NOT NULL AUTO_INCREMENT ,
  `nom_produit` VARCHAR(255) NULL DEFAULT NULL ,
  `code_produit` VARCHAR(255) NULL DEFAULT NULL ,
  `actif` VARCHAR(45) NOT NULL DEFAULT 'true' ,
  `visible` VARCHAR(45) NOT NULL DEFAULT 'true' ,
  PRIMARY KEY (`id_produit`) )
ENGINE = MyISAM
AUTO_INCREMENT = 860
DEFAULT CHARACTER SET = latin1
COMMENT = 'table des produits';


-- -----------------------------------------------------
-- Table `databaseName`.`prop`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `databaseName`.`prop` (
  `id_prop` INT(11) NOT NULL AUTO_INCREMENT ,
  `id_produit` VARCHAR(45) NULL DEFAULT NULL ,
  `id_propriete` INT(11) NULL DEFAULT NULL ,
  `valeur` VARCHAR(45) NULL DEFAULT NULL ,
  PRIMARY KEY (`id_prop`) ,
  INDEX `prop_index` (`id_propriete` ASC, `valeur` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 859
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `databaseName`.`proprietes`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `databaseName`.`proprietes` (
  `id_propriete` INT(11) NOT NULL AUTO_INCREMENT ,
  `nom_propriete` VARCHAR(45) NULL DEFAULT NULL ,
  `type_propriete` VARCHAR(45) NULL DEFAULT NULL ,
  PRIMARY KEY (`id_propriete`) )
ENGINE = MyISAM
AUTO_INCREMENT = 132
DEFAULT CHARACTER SET = latin1
COMMENT = 'table des propriétés des produits';


-- -----------------------------------------------------
-- Table `databaseName`.`stocks`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `databaseName`.`stocks` (
  `id_stock` INT(11) NOT NULL AUTO_INCREMENT ,
  `id_utilisateur` INT(11) NOT NULL DEFAULT '0' ,
  `date` DATETIME NULL DEFAULT NULL ,
  `etat_stock` INT(10) NULL DEFAULT '0' ,
  `id_produit` INT(10) NULL DEFAULT NULL ,
  PRIMARY KEY (`id_stock`) ,
  INDEX `index_stocks` (`date` ASC, `id_produit` ASC) )
ENGINE = MyISAM
AUTO_INCREMENT = 1408
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `databaseName`.`valeur`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `databaseName`.`valeur` (
  `id_valeur` INT(11) NOT NULL AUTO_INCREMENT ,
  `id_propriete` INT(11) NULL DEFAULT NULL ,
  `value` VARCHAR(1000) NULL DEFAULT NULL ,
  PRIMARY KEY (`id_valeur`) )
ENGINE = MyISAM
AUTO_INCREMENT = 370
DEFAULT CHARACTER SET = latin1;


