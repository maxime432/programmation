<?php

	$firstname ="Max";
	$name ="Beaudouin";

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
				<label for="name"> <?php echo $name ?>  <?php echo $firstname ?>	</label>
			</p>
		</section>

		<footer>
		</footer>
	</body>
</html>