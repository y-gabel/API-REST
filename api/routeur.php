<?php

	require_once("config/Connexion.php");
	
	if ($_SERVER['REQUEST_METHOD'] != 'POST'){
		echo(json_encode(Util::reponseNonAutorise()));
		return;
	}
	if (!Util::verifPostArgs("controleur","action")){
		echo(json_encode(Util::reponseMauvaiseRqt()));
		return;
	}
	
	$controleur = $_POST['controleur'];
	$action = $_POST['action'];
	
	switch ($controleur){
		case "controleurJoueur":
			require_once("controleur/controleurJoueur.php");
			controleurJoueur::$action();

			break;
		case "controleurPartie":
			require_once("controleur/controleurPartie.php");
			ControleurPartie::$action();

			break;
		case "controleurZone":
			require_once("controleur/controleurZone.php");
			ControleurZone::$action();

			break;
		case "controleurCompetence":
			require_once("controleur/controleurCompetence.php");
			ControleurCompetence::$action();

			break;
		default:
			echo(json_encode(Util::reponseNonTrouver()));
	}
?>