<?php 
$messageMdp="";
    if(!(isset($_SESSION["tentatives"])))
    {
        $_SESSION["tentatives"]=0;
    }
    if(isset($_POST["username"], $_POST["mdpUser"]))
    {
        if($_POST['username']!="" && $_POST['mdpUser']!="")
        {
            $user =$_POST['username'];
            $mdpUser=$_POST['mdpUser'];
            $p = new Joueur();
            $tabInfos = $p->infosConnexion($user);
            //var_dump($tabInfos);
            if($tabInfos[0]['joueur_mdp'] ==$mdpUser ){
                $_SESSION['nom'] = $tabInfos[0]["joueur_nom"];
                $_SESSION['prenom'] = $tabInfos[0]["joueur_prenom"];
                $_SESSION['email'] = $tabInfos[0]["joueur_email"];
                $_SESSION['role'] = $tabInfos[0]["joueur_role"];
                $_SESSION['position'] = $tabInfos[0]["joueur_position"];
                $_SESSION['niveau'] = $tabInfos[0]["joueur_niveau"];
                $_SESSION['username'] = $tabInfos[0]["joueur_nom_user"];
        
                header("Location:?section=moncompte");
            }else{
                if($_SESSION["tentatives"] == 2 && $tabInfos[0]['joueur_mdp'] !==$mdpUser){
                    header("Location:?section=comptebloque");
                }else{
                $messageMdp="Cet utilisateur ou ce mot de passe n'est pas correct";
                $_SESSION["tentatives"]++;
                echo $_SESSION["tentatives"];
                }

            }
        }
       
    }










    

                require_once("view/page/connexion.php");
?>