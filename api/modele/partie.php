<?php 
	require_once("config/Connexion.php");
	class Partie {
		public $idPartie;
        public $datePartie;
        public $nbMaxJoueur;
        public $tempsLimite;
        public $enCours;
        public $finie;
        public $idZone;

		public function __construct($tab){
				$this->idPartie = $tab["idPartie"];
                $this->enCours = $tab["enCours"];
				$this->datePartie = $tab["datePartie"];
                $this->finie = $tab["finie"];
                $this->nbMaxJoueur = $tab["nbMaxJoueur"];
				$this->tempsLimite = $tab["tempsLimite"];

				$this->idZone = $tab["idZone"];
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
		public static function getPartieByIdPartie($i){
			$requetePreparee = "SELECT * FROM PARTIE where idPartie = :i_tag";
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
			$requete = "SELECT * FROM PARTIE;";
			$resultat = Connexion::pdo()->query($requete);
			
			$tableau = $resultat->fetchAll(PDO::FETCH_ASSOC);
			
			foreach($tableau as $key => $val){
				$tab[] = new Partie($val);
			}
			
			return $tab;
		}
		// ajoute partie
		public static function insertPartie($i,$d,$n,$t,$e,$f){
			$requetePreparee = "INSERT INTO PARTIE VALUES (:i_tag,:d_tag,:n_tag,:t_tag,:e_tag,:f_tag)";
			$req_prep = Connexion::pdo()->prepare($requetePreparee);
			$valeurs = array(
				"i_tag" => $i,
				"d_tag" => $d,
				"n_tag" => $n,
				"t_tag" => $t,
				"e_tag" => $e,
				"f_tag" => $f
			);
			$req_prep->execute($valeurs);
		}	
		// supprr partie par id
		public static function deletePartie($i){
			$requetePreparee = "DELETE FROM PARTIE WHERE idPartie = :i_tag";
			$req_prep = Connexion::pdo()->prepare($requetePreparee);
			$valeurs = array(
				"i_tag" => $i
			);
			$req_prep->execute($valeurs);
		}
		//mettre a jour une partie nb
		public static function updatePartie($i,$d,$n,$t,$e,$f){	
			$requetePreparee = "UPDATE PARTIE SET datePartie = :d_tag,nbMaxJoueur = :n_tag,tempsLimite = :t_tag,enCours = :e_tag,datePartie = :d_tag,finie = :f_tag, where idPartie = :i_tag";
			$req_prep = Connexion::pdo()->prepare($requetePreparee);
			$valeurs = array(
				"d_tag" => $d,
				"n_tag" => $n,
				"t_tag" => $t,
				"e_tag" => $e,
				"f_tag" => $f
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