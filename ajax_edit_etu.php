<?php
    include 'config.php';
    //si on recoit un $ post    
    if(isset($_POST['matri']) && isset($_POST['nom_name']) && isset($_POST['prenom_name']) && isset($_POST['tuteur-name'])){
        $nom=htmlspecialchars(addslashes($_POST['nom_name']));
        $prenom=htmlspecialchars(addslashes($_POST['prenom_name']));
        $mat=$_POST['matri'];
        $tut=$_POST['tuteur-name'];
        
        //test existance etudiant
        $requete="UPDATE etu SET etu_prenom = '$prenom', etu_nom = '$nom', ens_mat = '$tut' WHERE etu_mat=$mat";
        
        $tab = $connexion->insert($requete);
       
        $donneeJSON=$tab;       
        echo $donneeJSON;
    }else{
       header('Location: index.php');
    }
?>