<?php
    include 'config.php';
    //si on recoit un $ post    
    if(isset($_POST['nom_ens_add']) && isset($_POST['prenom_ens_add']) && isset($_POST['login_ens_add']) && isset($_POST['pass_ens_add']) ){
        $nom=htmlspecialchars(addslashes($_POST['nom_ens_add']));
        $prenom=htmlspecialchars(addslashes($_POST['prenom_ens_add']));
        $login=htmlspecialchars(addslashes($_POST['login_ens_add']));
        $pass=htmlspecialchars(addslashes($_POST['pass_ens_add']));
        $pass=password_hash($pass, PASSWORD_DEFAULT);
            
        $requete='INSERT INTO ens(ens_nom,ens_prenom,ens_login,ens_mdp) VALUES ("'.$nom.'","'.$prenom.'","'.$login.'","'.$pass.'");';
       $donneeJSON = $connexion->insert($requete);
   
        echo $donneeJSON;
    }else{
        header('Location: index.php');
    }
?>