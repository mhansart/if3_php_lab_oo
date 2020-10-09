<?php 
        $listeInfos="" ;
        $inputHidden="";
        $niveauDebutant="";
        $niveauAvance="";
        $positionHandler="";
        $positionCutter="";
        $roleCoach="";
        $roleJoueur="";
        if($_SESSION['niveau'] =='Avancé'){
            $niveauAvance="selected";
        }else{
                $niveauDebutant="selected";
        }
        if($_SESSION['position'] == 'Handler'){
                $positionHandler="selected";
        }else{
                $positionCutter="selected";
        }
        if($_SESSION['role'] == 'Coach'){
                $roleCoach="selected";
        }else{
                $roleJoueur="selected";
        }
        $user =$_SESSION['username'];
        $p = new Joueur();
        $tabInfos = $p->compteJoueur($user);
        //var_dump($tabInfos);
        $inputHidden = "<input type='hidden' name='update' value='". $tabInfos[0]['joueur_id']."'>";
        $listeInfos.=
            "<div class='oneJoueur'>
                    <p class='initiales'>".$tabInfos[0]['joueur_initiales']."</p>
                    <div class='p-flex'>
                        <div class='propriete'>
                            <p class='bold nomPrenom'>".$_SESSION['prenom']." ".$_SESSION['nom']."</p>
                        </div>
                        <div class='propriete'>
                            <p>Nom d'utlisateur:</p> <p class='bold'>".$_SESSION['username']."</p>
                        </div>
                        <div class='propriete'>
                            <p>E-mail: </p><p class='bold'>".$_SESSION['email']."</p>
                        </div>
                        <div class='propriete'>
                            <p>Sur le terrain: </p><p class='bold'>".$_SESSION['position']."</p>
                        </div>
                        <div class='propriete'>
                            <p>Niveau: </p><p class='bold'>".$_SESSION['niveau']."</p>
                        </div>
                        <div class='propriete'>
                            <p>Rôle: </p><p class='bold'>".$_SESSION['role']."</p>
                        </div>
                    </div>
            </div>";

        if(isset($_POST["update"]))
        {
            $p = new Joueur();
            $p->update($_POST["nom"],$_POST["prenom"], $_POST["position"], $_POST["niveau"], $_POST["email"], $_POST["role"], $_POST["update"]);

            $_SESSION['nom'] =  trim($_POST["nom"]);
            $_SESSION['prenom'] =  trim($_POST["prenom"]); 
            $_SESSION['position'] = trim($_POST["position"]);
            $_SESSION['niveau'] = trim($_POST["niveau"]);
            $_SESSION['role'] = trim($_POST["role"]);
            $_SESSION['email'] = trim($_POST["email"]);

            header("Location:?section=moncompte");
        }
         
    
        require_once("view/page/moncompte.php");
?> 
     