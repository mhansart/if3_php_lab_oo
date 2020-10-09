<?php 
    require_once("Connexion.php");
    class Joueur extends Connexion 
    {
        public function create($_nom, $_prenom, $_email, $_position, $_niveau, $_role, $_mdp)
        {
            $requete = "INSERT INTO joueurs (joueur_nom,joueur_prenom,joueur_email,joueur_position,joueur_niveau,joueur_role,joueur_mdp,joueur_nom_user) VALUES (:nom,:prenom,:email,:position,:niveau,:roles,:mdp,CONCAT(LEFT(:prenom,2),LEFT(:nom,4)))";      

            $tabChamps= array(
                ":nom" => $_nom,
                ":prenom"=>$_prenom,
                ":email"=>$_email,
                ":position"=>$_position,
                ":niveau"=>$_niveau,
                ":roles"=>$_role,
                ":mdp"=>$_mdp
            );

            $this->execute($requete, $tabChamps);
        }

        public function readJoueurEvent()
        {
            $requete = "SELECT joueur_nom, joueur_prenom, entrainement_id, presence FROM joueurs JOIN joueurs_entrainements ON joueurs.joueur_id = joueurs_entrainements.joueur_id";

            return $this->execute($requete);
        }

        public function joueurId($_email)
        {
            $requete = "SELECT joueur_id FROM joueurs WHERE joueur_email = :email";

            $tabChamps = array(
                ":email" => $_email
            );
            return $this->execute($requete, $tabChamps);
        }

        public function read()
        {
            $requete = "SELECT joueur_id,joueur_nom,joueur_prenom,joueur_email,joueur_position,joueur_niveau,joueur_role,joueur_nom_user,UPPER(CONCAT(LEFT(joueur_prenom,1),LEFT(joueur_nom,1))) AS 'joueur_initiales' FROM `joueurs` ORDER BY joueur_id" ; 
            return $this->execute($requete);
        }

        public function infosJoueur($_email)
        {
            $requete = "SELECT joueur_nom_user, joueur_mdp,joueur_role,joueur_nom, joueur_prenom,joueur_position,joueur_niveau,joueur_email FROM joueurs WHERE joueur_email = :email";

            $tabChamps = array(
                ":email" => $_email
            );
            return $this->execute($requete, $tabChamps);
        }

        public function infosConnexion($_user)
        {
            $requete = "SELECT joueur_nom_user, joueur_mdp,joueur_role,joueur_nom, joueur_prenom,joueur_position,joueur_niveau,joueur_email FROM joueurs WHERE joueur_nom_user = :user";

            $tabChamps = array(
                ":user" => $_user
            );
            return $this->execute($requete, $tabChamps);
        }

        public function compteJoueur($user)
        {
            $requete = "SELECT joueur_id, joueur_nom,joueur_prenom,joueur_email,joueur_position,joueur_niveau,joueur_role,joueur_nom_user,UPPER(CONCAT(LEFT(joueur_prenom,1),LEFT(joueur_nom,1))) AS 'joueur_initiales' FROM `joueurs` WHERE joueur_nom_user = :nom_user";

            $tabChamps = array(
                ":nom_user" => $user
            );
            return $this->execute($requete, $tabChamps);
        }


        public function update($_nom, $_prenom, $_position, $_niveau, $_email, $_role, $_id)
        {
            $requete = "UPDATE joueurs SET joueur_nom = :nom, joueur_prenom = :prenom, joueur_position = :position,joueur_niveau = :niveau, joueur_email = :email, joueur_role = :role_joueur WHERE joueur_id= :update_id";

            $tabChamps= array(
                ":nom" => $_nom,
                ":prenom" => $_prenom,
                ":position" => $_position,
                ":niveau" => $_niveau,
                ":email" => $_email,
                ":role_joueur" => $_role,
                ":update_id" => $_id
            );

            return $this->execute($requete, $tabChamps);
        }

        public function deleteJoueur($_id)
        {
            $requete = "DELETE FROM `joueurs` where `joueurs`.`joueur_id`= :id";
            $tabChamps = array(
                ":id" => $_id
            );
            $this->execute($requete, $tabChamps);
        }
    }
?>