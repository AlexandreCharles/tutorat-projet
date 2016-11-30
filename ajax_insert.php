<?php
    include 'config.php';
    //si on recoit un $ post    
    if(isset($_POST['tuteur']) && $_POST['prenom'] && $_POST['nom']){
        $nom=htmlspecialchars(addslashes($_POST['nom']));
        $prenom=htmlspecialchars(addslashes($_POST['prenom']));
        $tut=$_POST['tuteur'];    
        //test existance etudiant
        $requete='SELECT etu_mat FROM etu WHERE etu_nom=:nom and etu_prenom=:prenom;';
        $param=array(':nom'=>$nom,':prenom'=>$prenom);
        $tab = $connexion->prepare_select($requete,$param);
        $nb=count($tab);
        if($nb==0){
            
            $requete='INSERT INTO etu(etu_nom,etu_prenom,ens_mat) VALUES ("'.$nom.'","'.$prenom.'",'.$tut.');';
            $tab = $connexion->insert($requete);

            $donneeJSON=$tab;
        }else{
             $donneeJSON="etudiant existant";
        }
       
        echo $donneeJSON;
    }else{
        header('Location: index.php');
    }
?>