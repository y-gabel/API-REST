<?php 
	class Participe {
        public $idJoueur;
        public $idPartie;
        public $duree;
        public $score;
        public $estMort;
        public $longitudeJoueur;
        public $latitudeJoueur;
		
		public function __construct($tab){
				$this->idJoueur = $tab["idJoueur"];
				$this->idPartie = $tab["idPartie"];
				$this->duree = $tab["duree"];
				$this->score = $tab["score"];
				$this->estMort = $tab["estMort"];
				$this->longitudeJoueur = $tab["longitude"];
				$this->latitudeJoueur = $tab["latitude"];
		}
		
		public function getIdJoueur(){		return $this->idJoueur; 		}
		public function getIdPartie(){		return $this->idPartie; 		}
		public function getDuree(){		return $this->duree; 		}
		public function getScore(){		return $this->score; 		}
		public function getEstMort(){		return $this->estMort; 		}
		public function getLongitude(){		return $this->longitudeJoueur; 		}
		public function getLatitude(){		return $this->latitudeJoueur; 		}
		
		public function setIdJoueur($idJoueur){	 $this->idJoueur; 		}
		public function setIdPartie($idPartie){	 $this->idPartie; 		}
		public function setDuree($duree){	     $this->duree; 		}
		public function setScore($score){		 $this->score; 		}
		public function setEstMort($estMort){	 $this->estMort; 		}
		public function setLongitude($longitude){	 $this->longitudeJoueur; 		}
		public function setLatitude($latitude){	 $this->latitudeJoueur; 		}

	}
?>