<?php 
	class Competence {
        public $idCompetence;
        public $nom;
        public $description;
        public $cooldown;
        public $scoreMinimal;
        public $prix;
		
		public function __construct($tab){
				$this->idCompetence = $tab["idSousZone"];
				$this->nom = $tab["nom"];
				$this->description = $tab["description"];
				$this->cooldown = $tab["cooldown"];
				$this->scoreMinimal = $tab["scoreMinimal"];
				$this->prix = $tab["prix"];
		}
		
		public function getIdCompetence(){		return $this->idCompetence; 		}
		public function getNom(){		return $this->nom; 	}
		public function getDescription(){		return $this->description; 	}
		public function getCooldown(){ return $this->cooldown; }
		public function getScoreMinimal(){ return $this->scoreMinimal; }
		public function getPrix(){ return $this->prix; }
		
		public function setIdCompetence($idCompetence){ $this->idCompetence = $idCompetence;}
		public function setNom($nom){ $this->nom = $nom;}
		public function setDescription($description){ $this->description = $description;}
		public function setCooldown($cooldown){ $this->cooldown = $cooldown;}
		public function setScoreMinimal($scoreMinimal){ $this->scoreMinimal = $scoreMinimal;}
		public function setPrix($prix){ $this->prix = $prix;}


		
		public static function getCompetencByID($id){
			$requetePreparee = "SELECT * FROM COMPETENCE WHERE idCompetence = :i_tag";
			$req_prep = Connexion::pdo()->prepare($requetePreparee);
			$valeurs = array(
				"i_tag" => $id
			);
			$req_prep->execute($valeurs);
			$resultat = $req_prep->fetch(PDO::FETCH_ASSOC);
			
			if ($req_prep->rowCount() == 0){
				return false;
			} else {
				return new Competence($resultat);
			}
		}
		public static function getAllCompetences(){
			$tab = array();
			$requete = "SELECT * FROM Competence;";
			$resultat = Connexion::pdo()->query($requete);
			
			$tableau = $resultat->fetchAll(PDO::FETCH_ASSOC);
			
			foreach($tableau as $key => $val){
				$tab[] = new Competence($val);
			}
			
			return $tab;
		}
		
	}
?>