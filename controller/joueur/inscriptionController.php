<?php 
    // récupérer les personnes et afficher
    if(isset($_POST["nom"],$_POST["prenom"], $_POST["email"], $_POST["position"], $_POST["niveau"], $_POST["role"], $_POST["mdp"]))
    {
        echo "hello";
        echo $_POST["niveau"];
        if(trim($_POST["nom"]) !== "" && trim($_POST["prenom"]) !== ""){ 

            $nom = $_POST["nom"];
            $prenom=$_POST["prenom"];
            $email=$_POST["email"];
            $position=$_POST["position"];
            $niveau=$_POST["niveau"];
            $role=$_POST["role"];
            $mdp=$_POST["mdp"];

            $p = new Joueur();
            $p->create($_POST["nom"],$_POST["prenom"], $_POST["email"], $_POST["position"], $_POST["niveau"], $_POST["role"], $_POST["mdp"]);

        $_SESSION["nom"] = $_POST["nom"];
        $_SESSION["prenom"] = $_POST["prenom"];
        $_SESSION["role"] = $_POST["role"];
        $_SESSION["niveau"] = $_POST["niveau"];
        $_SESSION["position"] = $_POST["position"];
        $_SESSION["email"] = $_POST["email"];

        $tab=$p->infosJoueur($email);
        // var_dump($tab);
        // die;
        $_SESSION['username']=$tab[0]['joueur_nom_user'];

        header("Location:?section=moncompte");
        }
    }


    // appeler la vue
    require_once("view/page/inscription.php"); 
?>