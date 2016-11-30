<?php
    include 'config.php';
    //si on recoit un $ post    
    if(isset($_POST['nom_ens']) && isset($_POST['prenom_ens']) && isset($_POST['login_ens'])){
        $nom=htmlspecialchars(addslashes($_POST['nom_ens']));
        $prenom=htmlspecialchars(addslashes($_POST['prenom_ens']));
        $login=htmlspecialchars(addslashes($_POST['login_ens'])); 
        $mat=$_SESSION['ens_mat'];
        //test existance etudiant
        $requete="UPDATE ens SET ens_prenom = '$prenom', ens_nom = '$nom', ens_login = '$login'WHERE ens_mat=$mat";
        
        $tab = $connexion->insert($requete);
        if($tab==""){
            $_SESSION['ens_login']=$login;
            $_SESSION['ens_prenom']=$prenom;
            $_SESSION['ens_nom']=$nom;
        }
        $donneeJSON=$tab;       
        echo $donneeJSON;
    }else{
        header('Location: index.php');
    }
?>