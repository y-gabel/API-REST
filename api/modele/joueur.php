<?php 
	class Joueur {

 		/*------------------------------------------------------------------------------------------------------------------------------
		/////////////////                                         ATTRIBUTS                                            ///////////////// 
		------------------------------------------------------------------------------------------------------------------------------*/       

		public $idJoueur;
        public $mdp;
        public $dateInscription;
        public $nom;
        public $prenom;
        public $mail;
        public $solde;
        public $niveau;

        /*------------------------------------------------------------------------------------------------------------------------------
		/////////////////                                         GETTERS                                              ///////////////// 
		------------------------------------------------------------------------------------------------------------------------------*/

        public function getIdJoueur(){ return $this->idJoueur; }
        public function getMdp(){ return $this->mdp; }
        public function getDateInscription(){ return $this->dateInscription; }
        public function getNom(){ return $this->nom; }
        public function getPrenom(){ return $this->prenom; }
        public function getMail(){ return $this->mail; }
        public function getSolde(){ return $this->solde; }
        public function getNiveau(){ return $this->niveau; }

        /*------------------------------------------------------------------------------------------------------------------------------
		/////////////////                                         SETTERS                                              ///////////////// 
		------------------------------------------------------------------------------------------------------------------------------*/

        public function setIdJoueur($idJoueur){ $this->idJoueur = $idJoueur;}
        public function setMdp($mdp){ $this->mdp = $mdp;}
        public function setDateInscription($dateInscription){ $this->dateInscription = $dateInscription;}
        public function setNom($nom){ $this->nom = $nom;}
        public function setPrenom($prenom){ $this->prenom = $prenom;}
        public function setMail($mail){ $this->mail = $mail;}
        public function setSolde($solde){ $this->solde = $solde;}
        public function setNiveau($niveau){ $this->niveau = $niveau;}

        /*------------------------------------------------------------------------------------------------------------------------------
		/////////////////                                         CONSTRUCTORS                                         ///////////////// 
		------------------------------------------------------------------------------------------------------------------------------*/

        public function __construct($tab){
            $this->idJoueur = $tab["idJoueur"];
            $this->password = $tab["mdp"];
            $this->dateInscription = $tab["dateInscription"];
            $this->nom = $tab["nom"];
            $this->prenom = $tab["prenom"];
            $this->mail = $tab["mail"];
            $this->thunasse = $tab["solde"];
            $this->niveau = $tab["niveau"];
        }

        /*------------------------------------------------------------------------------------------------------------------------------
		/////////////////                                         METHODES                                             ///////////////// 
		------------------------------------------------------------------------------------------------------------------------------*/

        /**
		 * Retourne une array contenant les informations passé en parametre
		 *
		 * @param Int $idJoueur id coresspondant au joueur dans la base de donnée
		 * 
		 * @author Gabel Yanis <yanis.gabel@universite-paris-saclay.fr>
		 * @return array contenant toutes les informations du joueur ayant pour id celui passé en paramètre (si joueur trouvé) sinon false.
		 * 					
		 */

        public static function getJoueurById($i){
            $requetePreparee = "SELECT * FROM JOUEUR where idJoueur = :i_tag";
            $req_prep = Connexion::pdo()->prepare($requetePreparee);
            $valeurs = array(
                "i_tag" => $i
            );
            $req_prep->execute($valeurs);
            if ($req_prep->rowCount() == 0) { return false;}

            $resultat = $req_prep->fetch(PDO::FETCH_ASSOC);
            return new Joueur($resultat);
        }
        /**
		 * Retourne le joueur ayant pour mail, le mail passé en paramètre
		 *
		 * @param String $mail mail d'un joueur passé en paramètre
         * 	
		 * @author Gabel Yanis <yanis.gabel@universite-paris-saclay.fr>
		 * @return tableau contenant le joueur correspondant à l'email passé en paramètre
		 * 					
		 */

        public static function getJoueurByMail($mail){
            $requetePreparee = "SELECT * FROM JOUEUR WHERE mail = :m_tag ;";
            $req_prep = Connexion::pdo()->prepare($requetePreparee);
            $valeurs = array("m_tag" => $mail);

            $req_prep->execute($valeurs);
            if ($req_prep->rowCount() == 0) { return false;}

            $req_prep->setFetchMode(PDO::FETCH_CLASS,"Joueur");
		    $tabJoueur = $req_prep->fetchAll();
		    return $tabJoueur;
        }

        /**
		 * Retourne une array contenant les informations passé en parametre
		 *
		 * @param Int $id correspondant à l'id du joueur
		 * @param String $mail correspondant au mail du joueur
		 * @param String $pass corespondant au mdp crypté du joueur
         * @param Date $dateInsc corespondant à la date d'inscription du joueur
         * @param String $nom corespondant au nom du joueur
         * @param String $pre corespondant au prenom du joueur
         * @param Int $thune corespondant à l'argent dans le jeu du joueur
         * @param Int $niv corespondant au niveau du joueur
		 * 
		 * @author Gabel Yanis <yanis.gabel@universite-paris-saclay.fr>
		 * @return bool true si le joueur a été inséré, sinon false
		 * 					
		 */

        public static function insertJoueur($id, $mdp, $dateInsc, $nom, $prenom, $mail, $solde, $niveau) {
            $passHash = util::hash($mdp);
            $requetePreparee = "INSERT INTO JOUEUR (idJoueur, mdp, dateInscription, nom, prenom, mail, solde, niveau) 
            VALUES (:id_tag, :mdp_tag, :dateInsc_tag, :nom_tag , :prenom_tag, :mail_tag, :solde_tag, :niveau_tag );";
            $req_prep = Connexion::pdo()->prepare($requetePreparee);
            $valeurs = array(
                "id_tag" => $id,
                "mdp_tag" => $mdp,
                "dateInsc_tag" => $dateInsc,
                "nom_tag" => $nom,
                "prenom_tag" => $prenom,
                "mail_tag" => $mail,
                "solde_tag" => $solde,
                "niveau_tag" => $niveau
            );

            try {
                $req_prep->execute($valeurs);
                return true;
            }   catch (PDOException $e) {
                echo "erreur : " .$e->getMessage(). "<br>";
                return false;
            }
        }


        /**
		 * Update un joueur dans la base de donnée
		 *
		 * @param Int $id correspondant à l'id du joueur
		 * @param String $mail correspondant au mail du joueur
		 * @param String $pass corespondant au mdp crypté du joueur
         * @param String $nom corespondant au nom du joueur
         * @param String $pre corespondant au prenom du joueur
         * @param Int $thune corespondant à l'argent dans le jeu du joueur
         * @param Int $niv corespondant au niveau du joueur
		 * 
		 * @author Gabel Yanis <yanis.gabel@universite-paris-saclay.fr>
		 * @return Bool true si le joueur a bien été update, false sinon
		 * 					
		 */

        public static function updateJoueur($id, $mdp, $nom, $prenom, $mail, $solde, $niveau){
            $mdpHash = util::hash(mdp);
            $requetePreparee = "UPDATE JOUEUR SET mdp = :mdp_tag, nom = :nom_tag , prenom = :prenom_tag, mail = :mail_tag, solde = :solde_tag, niveau = :niveau_tag 
            WHERE idJoueur = :id_tag";
            $req_prep = Connexion::pdo()->prepare($requetePreparee);
            $valeurs = array(
                "id_tag" => $id,
                "mdp_tag" => $mdpHash,
                "nom_tag" => $nom,
                "prenom_tag" => $prenom,
                "mail_tag" => $mail,
                "solde_tag" => $solde,
                "niveau_tag" => $niveau
            );

            try {
                $req_prep->execute($valeurs);
                return true;
            }   catch (PDOException $e) {
                echo "erreur : " .$e->getMessage(). "<br>";
                return false;
            }
        }

        /**
		 * Delete un joueur via son email
		 *
		 * @param String $mail 
		 * 
		 * @author Gabel Yanis <yanis.gabel@universite-paris-saclay.fr>
		 * @return Bool true si le joueur a bien été supprimé, false sinon  
		 * 					
		 */

        public static function deleteJoueurByMail($mail){
            $requetePreparee = "DELETE FROM JOUEUR WHERE mail = :mail_tag ;";
            $req_prep = Connexion::pdo()->prepare($requetePreparee);
            $valeurs = array("mail_tag" => $mail);
        
            try {
                $req_prep->execute($valeurs);
                return true;
            }   catch (PDOException $e) {
                echo "erreur : " .$e->getMessage(). "<br>";
                return false;
            }
        }


        public static function deleteJoueurByID($idJoueur){
            $requetePreparee = "DELETE FROM JOUEUR WHERE idJoueur = :id_tag ;";
            $req_prep = Connexion::pdo()->prepare($requetePreparee);
            $valeurs = array("id_tag" => $idJoueur);
        
            try {
                $req_prep->execute($valeurs);
                return true;
            }   catch (PDOException $e) {
                echo "erreur : " .$e->getMessage(). "<br>";
                return false;
            }
        }

        /**
		 * Retourne une array contenant les informations passé en parametre
		 *
		 * @param status code retour. Position [0].
		 * @param message message à transmettre . Position [1].
		 * @param data [facultatif] données facultatifs à inserer. Position [2...].
		 * 
		 * @author Gabel Yanis <yanis.gabel@universite-paris-saclay.fr>
		 * @return array contenant toutes les informations passé en paramètre  
		 * 					
		 */

        /**
		 * Vérifie si le mot de passe est bien celui inscrit sur la BDD
		 *
		 * @param Int $id correspondant à l'id du joueur
		 * @param String $pass corespondant au mdp crypté du joueur
		 * 
		 * @author Gabel Yanis <yanis.gabel@universite-paris-saclay.fr>
		 * @return Bool retourne vrai si le mdp passé en parametre correspopont bien à celui dans la base de donnée (crypté)
		 * 					
		 */

        public static function checkMDP($id,$mdp) {
            $requetePreparee = "SELECT * FROM JOUEUR WHERE idJoueur = :id_tag and mdp = :mdp_tag;";
            $req_prep = connexion::pdo()->prepare($requetePreparee);
            $valeurs = array("id_tag" => $id, "mdp_tag" => util::hash($mdp));
            $req_prep->execute($valeurs);
            $req_prep->setFetchMode(PDO::FETCH_CLASS,"utilisateur");
            $tabUtilisateurs = $req_prep->fetchAll();
            if (sizeof($tabUtilisateurs) == 1)
                return true;
            else
                return false;
        }



        public static function getLesParties($idJoueur){
            $requetePreparee = "SELECT * FROM PARTIE WHERE idPartie in (select idPartie from PARTICIPE WHERE idJoueur = :id_tag);";
            $req_prep = Connexion::pdo()->prepare($requetePreparee);
            $valeurs = array("id_tag" => $idJoueur);
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
        public static function getPartieActuel($idJoueur){
            $requetePreparee = "SELECT * FROM PARTICIPE JOIN PARTIE ON PARTIE.idPartie = PARTICIPE.idPartie WHERE PARTICIPE.idJoueur = :i_tag and enCours = 1;";
            $req_prep = Connexion::pdo()->prepare($requetePreparee);
            $valeurs = array("i_tag" => $idJoueur);
            $req_prep->execute($valeurs);
            $resultat = $req_prep->fetch(PDO::FETCH_ASSOC);
            
            if ($req_prep->rowCount() == 0){
                return false;
            } else {
                return new Partie($resultat);
            }
        }


        public static function getLesCompetencesDebloques($idJoueur)
        {
            $requetePreparee = " SELECT * FROM COMPETENCE WHERE idCompetence in (select idCompetence from ADebloque WHERE idJoueur = :i_tag);";
            $req_prep = Connexion::pdo()->prepare($requetePreparee);
            $valeurs = array("i_tag" => $idJoueur);

            $req_prep->execute($valeurs);
            $resultat = $req_prep->fetchAll(PDO::FETCH_ASSOC);
            
            if ($req_prep->rowCount() == 0){
                return false;
            } else {
                $tab = array();
                foreach($resultat as $key => $val){
                    $tab[] = new Competence($val);
                }
                return $tab;
            }
        }
        public static function getLesCompetencesNonDebloques($idJoueur)
        {
            $requetePreparee = " SELECT * FROM COMPETENCE WHERE idCompetence not in (select idCompetence from ADebloque WHERE idJoueur = :i_tag);";
            $req_prep = Connexion::pdo()->prepare($requetePreparee);
            $valeurs = array("i_tag" => $idJoueur);

            $req_prep->execute($valeurs);
            $resultat = $req_prep->fetchAll(PDO::FETCH_ASSOC);
            
            if ($req_prep->rowCount() == 0){
                return false;
            } else {
                $tab = array();
                foreach($resultat as $key => $val){
                    $tab[] = new Competence($val);
                }
                return $tab;
            }
        }
        public static function getLesCompetencesUtilise($idJoueur)
        {
            $requetePreparee = " SELECT * FROM COMPETENCE WHERE idCompetence in (select idCompetence from ADebloque WHERE idJoueur = :i_tag and utilise = 1);";
            $req_prep = Connexion::pdo()->prepare($requetePreparee);
            $valeurs = array("i_tag" => $idJoueur);

            $req_prep->execute($valeurs);
            $resultat = $req_prep->fetch(PDO::FETCH_ASSOC);
            
            if ($req_prep->rowCount() == 0){
                return false;
            } else {
                new Competence($resultat);
            }
        }
}