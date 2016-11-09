<?php
    $titrePage="Etudiant";
    include 'haut.php';
if (isset($_GET['id'])){
    $id_etu=$_GET['id'];
    $requete='SELECT etu_nom,etu_prenom,etu_mat,ens_nom,ens_prenom FROM etu INNER JOIN ens ON etu.ens_mat=ens.ens_mat WHERE etu_mat='.$id_etu.';';
    $tab=$connexion->select($requete);
    $etu=$tab[0]['etu_nom']." ".$tab[0]['etu_prenom'];
    $tut=$tab[0]['ens_nom']." ".$tab[0]['ens_prenom'];
    $fiche_etu="<ul class='list-group'><li class='list-group-item'>Matricule: ".$id_etu."</li><li class='list-group-item'>Etudiant: ".$etu."</li><li class='list-group-item'>Tuteur: ".$tut."</li></ul>";
    //type=false -> etudiant, type=true -> famille
    //etu
    $requete='SELECT rdv_id,rdv_date,ens_nom,ens_prenom FROM rdv INNER JOIN ens ON rdv.ens_mat=ens.ens_mat WHERE etu_mat=:id_etu && rdv_type=false;';
    $param=array(':id_etu'=>$id_etu);
    $tab=$connexion->prepare_select($requete,$param);
    $nb=count($tab);
    if($nb!=0){
        $table_1='<table class="table col-md-8"><tr class="row"><th class="col-md-3">Numero</th><th class="col-md-3">Date</th><th class="col-md-3">Redacteur</th><th class="col-md-3">Visualisation</th></tr>';
        foreach($tab as $ligne){
            $num=$ligne['rdv_id'];
            $date=$ligne['rdv_date'];
            $redac=$ligne['ens_nom']." ".$ligne['ens_prenom'];
            $table_1=$table_1.'<tr class="row"><td class="col-md-3">'.$num.'</td><td class="col-md-3">'.$date.'</td><td class="col-md-3">'.$redac.'</td><td class="col-md-3"><a href="rapport_read.php?id='.$num.'"><span class="btn btn-large btn-success">Voir</span></a></td></tr>';
        }
        $table_1=$table_1."</table>";
    }else{
         $table_1='<table class="table col-md-8"><tr class="row"><th>Aucun rapport</th></tr></table>';
    }
    
    //famille
    $requete='SELECT rdv_id,rdv_date,ens_nom,ens_prenom FROM rdv INNER JOIN ens ON rdv.ens_mat=ens.ens_mat WHERE etu_mat=:id_etu && rdv_type=true;';
    $param=array(':id_etu'=>$id_etu);
    $tab=$connexion->prepare_select($requete,$param);
    $nb=count($tab);
    if ($nb!=0){
        $table_2='<table class="table col-md-8"><tr class="row"><th class="col-md-3">Numero</th><th class="col-md-3">Date</th><th class="col-md-3">Redacteur</th><th class="col-md-3">Visualisation</th></tr>';
        foreach($tab as $ligne){
            $num=$ligne['rdv_id'];
            $date=$ligne['rdv_date'];
            $redac=$ligne['ens_nom']." ".$ligne['ens_prenom'];
            $table_2=$table_2.'<tr class="row"><td class="col-md-3">'.$num.'</td><td class="col-md-3">'.$date.'</td><td class="col-md-3">'.$redac.'</td><td class="col-md-3"><a href="rapport_read.php?id='.$num.'"><span class="btn btn-large btn-success">Voir</span></a></td></td></tr>';
        }
        $table_2=$table_2."</table>";
    }else{
        $table_2='<table class="table col-md-8"><tr class="row"><th>Aucun rapport</th></tr></table>';
    }
    
}else{
    header("Location: index.php");
}
?>
<div class='row'>
    <h2 class='col-xs-12'><i class="fa fa-users" aria-hidden="true"></i> Etudiant</h2>
    <div class='col-xs-2'></div>
    <div class="col-xs-12">
    <?php echo $fiche_etu;?>
    </div>
    <div type="button" class='col-xs-12'><span class='col-md-8'></span><a href='rapport_add.php?id_etu=<?php echo $id_etu;?>' class='col-md-3 btn btn-large btn-primary' id='button'>Ajouter un rapport</a></div>
    <h2 class='col-xs-12'><i class="fa fa-clone" aria-hidden="true"></i> Rendez vous avec l'étudiant</h2>
    <div class='col-xs-2'></div>
    <?php echo $table_1;?>
    <h2 class='col-xs-12'><i class="fa fa-clone" aria-hidden="true"></i> Rendez vous avec sa famille</h2>
    <div class='col-xs-2'></div>
    <?php echo $table_2;?>
    
</div>
<br/>
<?php
    include 'bas.php';
?>