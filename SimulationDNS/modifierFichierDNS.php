<!DOCTYPE html>
<html>
<head>
	<title>Modifier l'adresse IP, du nom de domaine visé</title>
</head>

<style>
	input  {
		font-size: 17px;
	}

	label {
		font-size: 20px;
	}

	form {
		margin-left: 35%;
		margin-top: 5%;
	}
	p {
		color: #95dbc5;
	}
	label {
		color: #95dbc5;
	}
</style>

<body>

	<?php include 'enTete.php'; ?>

	<form method="post" action="modifierFichierDNS.php">
		<label>Entrer l'adresse ip du pirate : </label><input type="text" name="adresseIP" placeholder="75.75.75.75">
		<br>
		<input type="submit" name="bouttonValider" value="Valider">

	</form>

	<?php

		if ($_SERVER["REQUEST_METHOD"] == "POST") {       //Vérifie que la demande est été envoyé

			$ouvert = fopen('fichierDNS.txt', 'a');      // Ouvre le fichier texte, en mode écriture grâce au "a"

			$monIP = $_POST['adresseIP'];  // Créé une variable, qui contient l'adresse du prirate

			$tableau = file('fichierDNS.txt');  // Fait un tableau du fichier texte

			$nombreLigne = count($tableau);    // Compte le nombre d'élément dans le tableau, 1 élément = 1 ligne dans le fichier texte

			$compteur = 0;    // Créé une variable compteur inicié à 0
			echo count($ouvert);

			while ($compteur < $nombreLigne) {  // Boucle qui va s'arreter si le compteur atteint le nombre d'élément, donc quand il a parcouru tous les éléments du tableau

				if (stristr($tableau[$compteur], "www.google.com")) {    // Si pendant qu'il parcourt le tableau il trouve cette chaine de caractère dans une ligne, on éxècute le code pour remplacer l'adresse ip du nom de domaine ciblé

					$index = strpos($tableau[$compteur], "www.google.com");   //Recupere l'index de la première occurence de "www.google.com" 

					$adresseIPDomaine = substr($tableau[$compteur], 0, $index-1);    //Retourne l'adresse IP visé, ($index-1 pour ne pas prendre l'espace dans la modification)
					echo "<p>" . "Adresse IP originale du site visé : " . $adresseIPDomaine . "</p>";

					$remplacer = str_replace($adresseIPDomaine, $monIP, $tableau[$compteur]);   //str_replace("texteVisé", "texteVoulu", "variable où les modifications sont appliqué")
					$tableau[$compteur] = $remplacer;   // Remplace la ligne visé, par la ligne modifié
					echo "<p>" . "L'adresse, à bien été remplacer par :" . $remplacer . "</p>";

					file_put_contents('fichierDNS.txt', "");  // Vide le fichier texte pour pouvoir insérer les nouvelles données.

					echo "<p>" . "Exécution du code, pour remplacer réussie" . "</p>";  

				}

				$compteur = $compteur + 1;       //Agrémenter 1, à chaque tour de boucle
			}
			$row = "";
		    foreach($tableau as $k => $v){   //Boucle pour définir les variables, pour pouvoir les mettres dans le fichier texte
		        $row .= $v;   //    .=   est un opérateur pour concaténée
		    }
		    fwrite($ouvert, $row);    //Remplace le fichier texte, par le tableau des données, modifiés
		    fclose($ouvert);    //Ferme le fichier texte 
		}
	?>

</body>
</html>