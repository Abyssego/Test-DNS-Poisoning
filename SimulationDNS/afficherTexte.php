<!DOCTYPE html>
<html>
<head>
	<title>Afficher le contenu de fichier texte</title>
</head>

<style>
	p {
		color: #95dbc5;
	}	
</style>

<body>

	<?php 

		include 'enTete.php'; 


		$tableau = file('fichierDNS.txt');   

		$nombreLigne = count($tableau);   //Avoir le nombre total de ligne du fichier texte

		$compteur = 0;

		while ($compteur < $nombreLigne) {        //Tant que mon compteur n'atteint pas le nombre total de ligne, on continue
			echo  "<p>" . $tableau[$compteur] . "</p>" ;  //Affiche chaque ligne du fichier texte en allant à la ligne
			$compteur = $compteur + 1;    //Agrémenter 1, à chaque tour de boucle
		}

	?>

</body>
</html>