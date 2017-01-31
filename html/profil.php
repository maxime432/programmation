<?php
	include("include/connexion.php") ;

	$requete_select = $bdd->prepare('SELECT nom, prenom, nom_utilisateur, adresse_mail FROM membres LIMIT 1');
	$requete_select->execute() ;
	$donnees_profil = $requete_select->fetch() ;

	$name = $donnees_profil['nom'] ;
	$firstname = $donnees_profil['prenom'] ;
	$nickname = $donnees_profil['nom_utilisateur'];
	$mail = $donnees_profil['adresse_mail'] ;
?>
<!DOCTYPE html>
<html>
	<head>
	<link rel="stylesheet" href="style-adept.css" />
	<title>ADEPT - Mon profil</title>
	</head>
	<body>

		<hearder>
		</hearder>
		<?php include("menus.php"); ?>

		<section>
			<p>
				<label for="name"> <?php echo $name . " " ; echo $firstname ?>	</label><br />
				<label for="nickname"> <?php echo $nickname; ?></label><br />
				<label for="mail"> <?php echo $mail; ?></label><br />
			</p>

			<form method="POST" action="edit_profil.php">
				<button type="submit" value="Editer" />
			</form>
		</section>

		<footer>
		</footer>
	</body>
</html>
