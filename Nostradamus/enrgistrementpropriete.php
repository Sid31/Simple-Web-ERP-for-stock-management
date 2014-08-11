<html>
	<head>
		<meta charset="utf-8">
		<title>Projet Nostradamus</title>
		<link href="css/foundation.css" rel="stylesheet" type="text/css">
		<script type="text/javascript"></script>
	</head>
	<body>
		<h1> Créer une propriété</h1>
		<nav class="top-bar" data-topbar>
			<ul class="title-area">
				<li class="name">
					<h1><a href="index.php">Accueil</a></h1>
				</li>
				<li class="toggle-topbar menu-icon">
					<a href="#">Menu</a>
				</li>
			</ul>
			<section class="top-bar-section">
				<!-- Right Nav Section -->
				<ul class="right"></ul>
				<!-- Left Nav Section -->
				<ul class="left">
					<li class="has-dropdown not-click">
						<a style="color: lightblue">Produit</a><!-- menu selectioné -->
						<ul class="dropdown">
							<li>
								<a href="AjoutProduit.html">Créer une Produit</a>
							</li>
							<li>
								<a href="proprietecreator.html">Créer une propriété</a>
							</li>
						</ul>
					</li>
					<li class="has-dropdown not-click">
						<a>Stock</a><!-- menu selectioné -->
						<ul class="dropdown">
							<li>
								<a href="GestionStock.php">Ajouter un produit</a>
							</li>
							<li>
								<a href="consultationBaseProduit.php">Consulter stock</a>
							</li>
							<li>
								<a href="consultationStockA.php">Tableau croisé</a>
							</li>
						</ul>
					</li>
					<li class="has-dropdown not-click">
						<a >Graphe</a><!-- menu selectioné -->
						<ul class="dropdown">
							<li>
								<a href="graphe.php">Graphe du stock</a>
							</li>							
						</ul>
					</li>
				</ul>
			</section>
		</nav>
		<div class="panel clearfix ">
			<?php
	$nomPropriete = $_REQUEST['nomPropriete'];
	if (!empty($nomPropriete)) {
		require 'model/Propriete.php';
		require 'control/ProprieteManager.php';
		require 'model/Prop.php';
		require 'model/Valeur.php';
		require 'control/ValeurManager.php';
		include "control/connexion.php";
		$type = $_REQUEST['radioButtons'];

		$managerPropriete = new ProprieteManager($connexion);
		$data = array('nom_propriete' => $nomPropriete, 'type_propriete' => $type);
		$unePropriete = new Propriete($data);
		if ($managerPropriete -> getIDPropriete($nomPropriete) == NULL) {
			$managerPropriete -> add($unePropriete);

			if ($type == "enum") {
				$idPropriete = $managerPropriete -> getIDPropriete($nomPropriete);
				$manageValeur = new ValeurManager($connexion);

				for ($i = 1; $i < sizeof($_REQUEST) - 1; $i++) {
					$valeur = null;
					$valeur = $_REQUEST["valeur" . $i];
					//echo $_REQUEST["valeur".$i].".....".$i;
					if ($valeur != null) {
						$data = array('valeur' => $_REQUEST["valeur" . $i], 'id_propriete' => $idPropriete);
						$manageValeur -> add(new Valeur($data));
					}
				}
				//echo "<h3>Création de la propriete \"" . $nomPropriete . "\" réussite.</h3></br>";
				echo "<table>
						<thead>
						<tr>
							<th>Numéro</th>
							<th> Valeur:</th>
						</tr><thead>
						<tbody>
						<tr>"
				;
				for ($i = 1; $i < sizeof($_REQUEST) - 2; ++$i) {
					echo "<tr>
							 <td>" . $i . "</td>
							 <td>" . $_REQUEST["valeur" . $i] . "</td>
			 			</tr>";
				}
				echo "</tr></tbody></table>";
			}
			echo "<h3>Création de la propriete \"" . $nomPropriete . "\" réussite.</h3></br>";
			echo '<a href="proprietecreator.html">← Retour à la création de proriété</a></br>';
			echo '<a href="AjoutProduit.html">← Retour à la création de produit</a>';
		}
	else {
		echo "<h3>Le produit \"" . $nomPropriete . "\" existe déja.Veuillez choisir un autre nom ou modifier la propriété existante.</h3>";
		echo '<a href="proprietecreator.html">← Retour à la création de proriété</a>';
	}
	} else {
		echo "<h3>Erreur lors de la création de la propriété, veuillez choisir un nom..</h3></br>";
		echo '<a href="proprietecreator.html">← Retour à la création de proriété</a>';
	}
?>
</div>
	</body>
</html>
