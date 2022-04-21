<?php 
	require_once("config/Connexion.php");
    require_once("modele/joueur.php");

	class Partie {
		public $idPartie;
        public $datePartie;
        public $nbMaxJoueur;
        public $tempsLimite;
        public $enCours;
        public $finie;
        public $idZone;
        public $participants = array();

		public function __construct($tab){
				$this->idPartie = $tab["idPartie"];
                $this->enCours = $tab["enCours"];
				$this->datePartie = $tab["datePartie"];
                $this->finie = $tab["finie"];
                $this->nbMaxJoueur = $tab["nbMaxJoueur"];
				$this->tempsLimite = $tab["tempsLimite"];

				$this->idZone = $tab["idZone"];
				$this->participants = Partie::getLesJoueurs($this->idPartie);
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
		public function getFinie()
        {
            return $this->finie;
        }
		public function getIdZone(){
            return $this->idZone;
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
        public function setidZone($idZone){
            $this->idZone = $idZone;
        }
		//rend une partie par id
		public static function getPartieByIdPartie($idPartie){
			$requetePreparee = "SELECT * FROM PARTIE where idPartie = :id_tag";
			$req_prep = Connexion::pdo()->prepare($requetePreparee);
			$valeurs = array(
				"id_tag" => $idPartie
			);
			$req_prep->execute($valeurs);
			$resultat = $req_prep->fetch(PDO::FETCH_ASSOC);

			return new Partie($resultat);
		}
		//rend un tableau de partie
		static function getAllParties(){
			$tab = array();
			$requete = "SELECT * FROM PARTIE;";
			$resultat = Connexion::pdo()->query($requete);

			$tableau = $resultat->fetchAll(PDO::FETCH_ASSOC);

			foreach($tableau as $key => $val){
				$tab[] = new Partie($val);
			}

			return $tab;
		}
		/*
		 *
		 * 				$this->idPartie = $tab["idPartie"];
                $this->enCours = $tab["enCours"];
				$this->datePartie = $tab["datePartie"];
                $this->finie = $tab["finie"];
                $this->nbMaxJoueur = $tab["nbMaxJoueur"];
				$this->tempsLimite = $tab["tempsLimite"];
		 */
		// ajoute partie
		public static function insertPartie($idPartie,$enCours,$datePartie,$estFinie,$nbMaxJoueur,$tempsLimite){
			$requetePreparee = "INSERT INTO PARTIE(idPartie, enCours, datePartie, finie, nbMaxJoueur, tempsLimite) VALUES(:id_tag,:enCours_tag,:datePartie_tag,:finie_tag,:nbMaxJoueur_tag,:tempsLimite_tag);";
			$req_prep = Connexion::pdo()->prepare($requetePreparee);
			$valeurs = array(
				"id_tag" => $idPartie,
				"enCours_tag" => $enCours,
				"datePartie_tag" => $datePartie,
				"finie_tag" => $estFinie,
				"nbMaxJoueur_tag" => $nbMaxJoueur,
				"tempsLimite_tag" => $tempsLimite
			);
			$req_prep->execute($valeurs);
		}
		// supprr partie par id
		public static function deletePartie($idPartie){
			$requetePreparee = "DELETE FROM PARTIE WHERE idPartie = :id_tag;";
			$req_prep = Connexion::pdo()->prepare($requetePreparee);
			$valeurs = array(
				"id_tag" => $idPartie
			);
			$req_prep->execute($valeurs);
		}
		//mettre a jour une partie nb
		public static function updatePartie($idPartie,$enCours,$datePartie,$estFinie,$nbMaxJoueur,$tempsLimite){
			$requetePreparee = "UPDATE PARTIE SET enCours = :enCours_tag, datePartie = :datePartie_tag, finie = :finie_tag,nbMaxJoueur = :nbMaxJoueur_tag, tempsLimite = :tempsLimite_tag where idPartie = :id_tag";
			$req_prep = Connexion::pdo()->prepare($requetePreparee);
			$valeurs = array(
                "id_tag" => $idPartie,
                "enCours_tag" => $enCours,
                "datePartie_tag" => $datePartie,
                "finie_tag" => $estFinie,
                "nbMaxJoueur_tag" => $nbMaxJoueur,
                "tempsLimite_tag" => $tempsLimite
			);
			$req_prep->execute($valeurs);
		}

		public static function getLesJoueurs($idPartie){
            $requetePreparee = "SELECT * FROM JOUEUR WHERE idJoueur in (select idJoueur from PARTICIPE WHERE idPartie = :id_tag);";
            $req_prep = Connexion::pdo()->prepare($requetePreparee);
            $valeurs = array("id_tag" => $idPartie);
            $req_prep->execute($valeurs);
            $resultat = $req_prep->fetchAll(PDO::FETCH_ASSOC);

            if ($req_prep->rowCount() == 0){
                return false;
            } else {
                $tab = array();
                foreach($resultat as $key => $val){
                    var_dump($val);
                    $tab[] = new Joueur($val);
                }
                return $tab;
            }
		}

		public static function getDonneesPartieJoueur($idPartie,$idJoueur){
            $requetePreparee = "SELECT * FROM PARTICIPE WHERE idJoueur = :idJoueur_tag and idPartie = :idPartie_tag;";
            $req_prep = Connexion::pdo()->prepare($requetePreparee);
            $valeurs = array(
            	"idPartie_tag" => $idPartie,
                "idJoueur_tag" => $idJoueur
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