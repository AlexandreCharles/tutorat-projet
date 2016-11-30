<?php
    include 'config.php';
    //si on recoit un $ post    
    if(isset($_POST['val'])){
        $val=$_POST['val'];
        //requete preparé
        $requete='SELECT etu.*,ens_nom,ens_prenom FROM etu INNER JOIN ens ON etu.ens_mat=ens.ens_mat WHERE etu_nom LIKE :val ORDER BY etu_mat;';
        $param=array(':val'=>"%".$val."%");
        $tab = $connexion->prepare_select($requete,$param);
        //si ces un tableau
        if(is_array($tab)){
            //on encode en json et on affiche
            $donneeJSON=json_encode($tab);
            echo $donneeJSON;
        }
    }else{
        header('Location: index.php');
    }
?>