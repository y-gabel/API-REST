<?php

	require_once("lib/util.php");
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
		case "ControleurPartie":
			require_once("controleur/ControleurPartie.php");
			ControleurPartie::$action();

			break;
		case "ControleurZone":
			require_once("controleur/ControleurZone.php");
			ControleurZone::$action();

			break;
		case "ControleurSousZone":
			require_once("controleur/ControleurSousZone.php");
			ControleurSousZone::$action();

			break;
		case "ControleurCompetence":
			require_once("controleur/ControleurCompetence.php");
			ControleurCompetence::$action();

			break;
		default:
			echo(json_encode(Util::reponseNonTrouver()));
	}
?>