<!DOCTYPE html>
<html>
<head>
	<title>Remplissage du fichier texte.</title>
</head>

<style>
	input  {
		font-size: 17px;
	}

	label {
		font-size: 20px;
		color: #95dbc5;
	}

	form {
		margin-left: 35%;
		margin-top: 5%;
	}
</style>

<body>
	<?php include 'enTete.php'; ?>

	<form method="post" action="creerFichierDNS.php">
		<label>Entrer le nombre de ligne du fichier texte :</label> <input type="text" name="nombre" placeholder="50">
		<br>
		<input type="submit" name="bouttonValider" value="Valider">
	</form>

	<?php

		if ($_SERVER["REQUEST_METHOD"] == "POST") {  //Vérifie que la demande est été envoyé

			file_put_contents('fichierDNS.txt', "");  // Vide le fichier texte pour pouvoir insérer les nouvelles données.

			$nombreEntrer = $_POST['nombre'];     //Recupere le nom rentre du formulaire

			$ouvert = fopen('fichierDNS.txt', 'a');      // Ouvre le fichier texte, en mode écriture
			if (is_writable('fichierDNS.txt')) {  // Vérifie si on peut bien écrire dans le fichier, sinon préciser qu'il y a une erreur avec "else"

				$compteur = 0;  //Création d'une variable compteur qui sert de condition pour la boucle

				$random = rand(1, $nombreEntrer);  // Bien toujours le mettre en dehors de la boucle, car sinon il va changer de valeur et tester à chaque tour de la boucle

				while ($compteur < $nombreEntrer) {
					$ip1 = rand(1, 254);	// Fonction rand pour avoir un nombre aléatoire :  rand(min, max)
					$ip2 = rand(1, 254);	// Pas de 0 ou 255, car ne connais pas le masque, et pas important pour la simulation
					$ip3 = rand(1, 254);
					$ip4 = rand(1, 254);

					$ipTotal = strval($ip1) . "." . strval($ip2) . "." . strval($ip3) . "." . strval($ip4);   // Créé l'adresse ip complète, exemple : 15.7.8.8

					fwrite($ouvert, $ipTotal . " " . "www.fake" . $compteur . ".com\n");  // Ecrit les lignes d'adresse non ciblé dans le fichier texte, pour simulé un vrai fichier DNS


					// Bout de code pour mettre dans le fichier texte, le vraie nom de domaine qui sera recherché

					
					if ($random == $compteur) {  // Condition pour écrire aléatoirement et une seule fois, le vraie nom de domaine dans le fichier DNS
						fwrite($ouvert, $ipTotal . " " . "www.google.com\n");  // Ecrie le nom de domaine que l'on visera dans la modification
					} //Faire un controle + F, dans le fichier texte pour retrouver le domaine google et voir si l'IP est bien changé, après la modification

					
					$compteur = $compteur + 1;   //Agrémenter 1, à chaque tour de boucle
				}		
			} else {
				echo "Il doit y avoir une erreur avec le fichier, car l'ardresse de google, n'a pas été trouvé";
			}
			fclose($ouvert);   //Ferme le fichier texte
		}
	?>

</body>
</html>