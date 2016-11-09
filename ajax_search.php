<?php
    if(isset($_POST['val'])){
        $val=$_POST['val'];
        include 'BDD.php';
        $connexion=new BDD('tutorat');
        //$requete="select * from ens where ens_login=:login && ens_mdp=:mdp;";
    
        $requete='SELECT etu.*,ens_nom,ens_prenom FROM etu INNER JOIN ens ON etu.ens_mat=ens.ens_mat WHERE etu_nom LIKE :val ORDER BY ens_nom;';
        $param=array(':val'=>$val."%");
        $tab = $connexion->prepare_select($requete,$param);
        if(is_array($tab)){
            $donneeJSON=json_encode($tab);
            echo $donneeJSON;
        }
    }
?>