<?php
	try {
		$bdd = new PDO('mysql:host=localhost;dbname=adept;charset=utf8', 'root', 'maxime');	
	} catch (Exception $e) {
		die ('Erreur : ' . $e->getMessage()) ;
	}
?>