<?php 
	class Joueur {

 		/*------------------------------------------------------------------------------------------------------------------------------
		/////////////////                                         ATTRIBUTS                                            ///////////////// 
		------------------------------------------------------------------------------------------------------------------------------*/

		public $idJoueur;
        public $mail;
        public $password;
        public $dateInscription;
        public $pseudo;
        public $solde;

        /*------------------------------------------------------------------------------------------------------------------------------
		/////////////////                                         GETTERS                                              ///////////////// 
		------------------------------------------------------------------------------------------------------------------------------*/

        public function getIdJoueur(){ return $this->idJoueur; }
        public function getMail(){ return $this->mail; }
        public function getPassword(){ return $this->password; }
        public function getDateInscription(){ return $this->dateInscription; }
        public function getPseudo(){ return $this->pseudo; }
        public function getSolde(){ return $this->solde; }

        /*------------------------------------------------------------------------------------------------------------------------------
		/////////////////                                         SETTERS                                              ///////////////// 
		------------------------------------------------------------------------------------------------------------------------------*/

        public function setIdJoueur($idJoueur){ $this->idJoueur = $idJoueur;}
        public function setMail($mail){ $this->mail = $mail;}
        public function setPassword($password){ $this->password = $password;}
        public function setDateInscription($dateInscription){ $this->dateInscription = $dateInscription;}
        public function setPseudo($pseudo){ $this->pseudo = $pseudo;}
        public function setSolde($solde){ $this->solde = $solde;}

        /*------------------------------------------------------------------------------------------------------------------------------
		/////////////////                                         CONSTRUCTORS                                         ///////////////// 
		------------------------------------------------------------------------------------------------------------------------------*/

        public function __construct($tab){
            $this->idJoueur = $tab["idJoueur"];
            $this->mail = $tab["mail"];
            $this->password = $tab["password"];
            $this->dateInscription = $tab["dateInscription"];
            $this->pseudo = $tab["pseudo"];
            $this->solde = $tab["solde"];
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

            $tabJoueur = $req_prep->fetch(PDO::FETCH_ASSOC);
            return new Joueur($tabJoueur);
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

            $tabJoueur = $req_prep->fetch(PDO::FETCH_ASSOC);
		    return  new Joueur($tabJoueur);
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

        public static function insertJoueur($idJoueur, $mail, $password, $dateInscription, $pseudo, $solde) {

            $requetePreparee = "INSERT INTO JOUEUR (idJoueur, mail, password, dateInscription, pseudo, solde) 
            VALUES (:id_tag, :mail_tag, :pass_tag, :dateInsc_tag, :pseudo_tag, :solde_tag );";
            $req_prep = Connexion::pdo()->prepare($requetePreparee);
            $valeurs = array(
                "id_tag" => $idJoueur,
                "mail_tag" => $mail,
                "pass_tag" => $password,
                "dateInsc_tag" => $dateInscription,
                "pseudo_tag" => $pseudo,
                "solde_tag" => $solde
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

        public static function updateJoueur($idJoueur, $mail, $password, $dateInscription, $pseudo, $solde){
            //$mdpHash = util::hash(mdp);
            $requetePreparee = "UPDATE JOUEUR SET mail = :mail_tag, password = :pass_tag, dateInscription = :dateInsc_tag, pseudo = :pseudo_tag, solde = :solde_tag
            WHERE idJoueur = :id_tag;";
            $req_prep = Connexion::pdo()->prepare($requetePreparee);
            $valeurs = array(
                "id_tag" => $idJoueur,
                "mail_tag" => $mail,
                "pass_tag" => $password,
                "dateInsc_tag" => $dateInscription,
                "pseudo_tag" => $pseudo,
                "solde_tag" => $solde
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

        public static function checkMDP($idJoueur,$password) {
            $requetePreparee = "SELECT * FROM JOUEUR WHERE idJoueur = :id_tag and password = :pass_tag;";
            $req_prep = connexion::pdo()->prepare($requetePreparee);
            $valeurs = array("id_tag" => $idJoueur, "pass_tag" => $password);
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
            $requetePreparee = " SELECT * FROM COMPETENCE WHERE idCompetence in (select idCompetence from ADebloque WHERE idJoueur = :id_tag);";
            $req_prep = Connexion::pdo()->prepare($requetePreparee);
            $valeurs = array("id_tag" => $idJoueur);

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
            $requetePreparee = " SELECT * FROM COMPETENCE WHERE idCompetence not in (select idCompetence from ADebloque WHERE idJoueur = :id_tag);";
            $req_prep = Connexion::pdo()->prepare($requetePreparee);
            $valeurs = array("id_tag" => $idJoueur);

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
        /*public static function getLesCompetencesUtilise($idJoueur)
        {
            $requetePreparee = " SELECT * FROM COMPETENCE WHERE idCompetence in (select idCompetence from ADebloque WHERE idJoueur = :id_tag and utilise = 1);";
            $req_prep = Connexion::pdo()->prepare($requetePreparee);
            $valeurs = array("id_tag" => $idJoueur);

            $req_prep->execute($valeurs);
            $resultat = $req_prep->fetch(PDO::FETCH_ASSOC);
            
            if ($req_prep->rowCount() == 0){
                return false;
            } else {
                new Competence($resultat);
            }
        }*/
}