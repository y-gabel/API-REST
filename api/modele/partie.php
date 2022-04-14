<?php 
	require_once("config/Connexion.php");
	class Partie {
		private $idPartie;
		private $datePartie;
		private $nbMaxJoueur;
		private $tempsLimite;
		private $enCours;
		private $finie;

		public function __construct($tab){
				$this->idPartie = $tab["idPartie"];
				$this->datePartie = $tab["datePartie"];
				$this->enCours = $tab["enCours"];
				$this->tempsLimite = $tab["tempsLimite"];
				$this->nbMaxJoueur = $tab["nbMaxJoueur"];
				$this->finie = $tab["finie"];
		}
		
		public function getIdPartie(){
				return $this->idPartie;
		}
		public function getDatePartie(){
				return $this->datePartie;
		}
		public function getNbMaxJoueur(){
				return $this->nbMaxJoueur;
		}
		public function getTempsLimite(){
				return $this->tempsLimite;
		}
		public function getEnCours(){
				return $this->enCours;
		}
		public function getFinie(){
			return $this->finie;
	}
	public function setIdPartie($idPartie){
		 $this->idPartie = $idPartie;
	}
	public function setDatePartie($datePartie){
		 $this->datePartie = $datePartie;
	}
	public function setNbMaxJoueur($nbMaxJoueur){
		 $this->nbMaxJoueur = $nbMaxJoueur;
	}
	public function setTempsLimite($tempsLimite){
		$this->tempsLimite = $tempsLimite;
	}
	public function setEnCours($enCours){
		$this->enCours = $enCours;
	}
	public function setFinie($finie){
		$this->finie = $finie;
	}
		//rend une partie par id
		public static function getPartieByIdPartie($i){
			$requetePreparee = "SELECT * FROM partie where idPartie = :i_tag";
			$req_prep = Connexion::pdo()->prepare($requetePreparee);
			$valeurs = array(
				"i_tag" => $i
			);
			$req_prep->execute($valeurs);
			$resultat = $req_prep->fetch(PDO::FETCH_ASSOC);
			
			return new Partie($resultat);
		}
		//rend un tableau de partie
		static function getAllParties(){
			$tab = array();
			$requete = "SELECT * FROM partie;";
			$resultat = Connexion::pdo()->query($requete);
			
			$tableau = $resultat->fetchAll(PDO::FETCH_ASSOC);
			
			foreach($tableau as $key => $val){
				$tab[] = new Partie($val);
			}
			
			return $tab;
		}
		// ajoute partie
		public static function insertPartie($idPartie,$nbMaxJoueur,$tempsLimite,$enCours,$estFinie){
			$requetePreparee = "INSERT INTO partie(idPartie,nbMaxJoueur,datePartie,tempsLimite,enCours,finie) VALUES (:id_tag,:max_tag,now(),:temps_tag,:enCours_tag,:estFinie_tag)";
			$req_prep = Connexion::pdo()->prepare($requetePreparee);
			$valeurs = array(
				"id_tag" => $idPartie,
				"max_tag" => $nbMaxJoueur,
				"temps_tag" => $tempsLimite,
				"enCours_tag" => $enCours,
				"estFinie_tag" => $estFinie
			);
			$req_prep->execute($valeurs);
		}	
		// supprr partie par id
		public static function deletePartie($i){
			$requetePreparee = "DELETE FROM voiture WHERE idPartie = :i_tag";
			$req_prep = Connexion::pdo()->prepare($requetePreparee);
			$valeurs = array(
				"i_tag" => $i
			);
			$req_prep->execute($valeurs);
		}
		//mettre a jour une partie nb
		public static function updatePartie($idPartie,$nbMaxJoueur,$tempsLimite,$enCours,$estFinie){	// ,$nbMaxJoueur,$tempsLimite,$enCours,$estFinie
			$requetePreparee = "UPDATE partie SET nbMaxJoueur = :nbMaxJoueur_tag,tempsLimite = :tempsLimite_tag,enCours = :enCours_tag,finie = :estFinie_tag, where idPartie = :idPartie_tag";
			$req_prep = Connexion::pdo()->prepare($requetePreparee);
			$valeurs = array(
				"idPartie_tag" => $idPartie,
				"nbMaxJoueur_tag" => $nbMaxJoueur,
				"tempsLimite_tag" => $tempsLimite,
				"enCours_tag" => $enCours,
				"estFinie_tag" => $estFinie
			);
			$req_prep->execute($valeurs);	
		}

		public static function getLesJoueurs($idPartie){
            $requetePreparee = "SELECT * FROM Joueur WHERE idJoueur in (select idJoueur from Participe WHERE idPartie = :i_tag);";
            $req_prep = Connexion::pdo()->prepare($requetePreparee);
            $valeurs = array("i_tag" => $idPartie);
            $req_prep->execute($valeurs);
            $resultat = $req_prep->fetchAll(PDO::FETCH_ASSOC);
            
            if ($req_prep->rowCount() == 0){
                return false;
            } else {
                $tab = array();
                foreach($resultat as $key => $val){
                    $tab[] = new Partie($val);
                }
                return $tab;
            }
		}

		public static function getDonneesPartieJoueur($idPartie,$idJoueur){
            $requetePreparee = "SELECT * FROM Participe WHERE idJoueur = :ij_tag and idPartie = :ip_tag;";
            $req_prep = Connexion::pdo()->prepare($requetePreparee);
            $valeurs = array(
            	"ij_tag" => $idJoueur,
            	"ip_tag" => $idPartie
            );
            $req_prep->execute($valeurs);
            $resultat = $req_prep->fetch(PDO::FETCH_ASSOC);
            
            if ($req_prep->rowCount() == 0){
                return false;
            } else {
            	return new Participe($resultat);
            }
		}
	}
?>