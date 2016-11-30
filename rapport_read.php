<?php
    $titrePage="Rapport";
    include 'config.php';
    if(isset($_GET['id'])){
        $id_rap=$_GET['id'];
        //initialisation
        $mat_ens="";
        $date_rdv="";
        $desc_rap="";
        $rdv_type="";
        $etudiant="";
        $enseignant="";
        //requete
        $requete='SELECT rdv_date,rdv_descri,rdv_type,etu_nom,etu_prenom,ens_nom,ens_prenom,rdv.ens_mat FROM rdv INNER JOIN ens ON rdv.ens_mat=ens.ens_mat INNER JOIN etu ON rdv.etu_mat=etu.etu_mat WHERE rdv_id=:rdv_id;';
        $param=array(':rdv_id'=>$id_rap);
        $ligne = $connexion->prepare_select($requete,$param);
        if(is_string($ligne)){
            echo $ligne;
        }else{
           if(isset($ligne[0])){
                $lg=$ligne[0];
                $mat_ens=$lg['ens_mat'];
                $date=$lg['rdv_date'];
                $date_rdv=date_create($date);
                $date_rdv=date_format($date_rdv,"d/m/Y");
                $desc_rap=$lg['rdv_descri'];
                if($lg['rdv_type']==1){
                    $rdv_type="la famille";
                }else{
                    $rdv_type="l'etudiant";
                }
                $etudiant=$lg['etu_nom']." ".$lg['etu_prenom'];
                $enseignant=$lg['ens_nom']." ".$lg['ens_prenom'];
            } else{
               header("Location: index.php");
           }
        }
    }else{
        header("Location: index.php");
    }
        
  include 'haut.php';  
?>

<div class='row'>
    <h2 class='col-xs-12'><i class="fa fa-clone" aria-hidden="true"></i> Rapport <?php echo $id_rap; ?></h2>
    <div class="col-xs-12">
    <?php 
        $fiche_rap='
            <ul class="list-group">
                <li class="list-group-item">date: '.$date_rdv.' </li>
                <li class="list-group-item">etudiant: '.$etudiant.'</li>
                <li class="list-group-item">redacteur: '.$enseignant.'</li>
                <li class="list-group-item"> Rendez vous avec '.$rdv_type.'</li>
            </ul>';
        echo $fiche_rap;
        ?>
        </div>
        <?php
    
       if($_SESSION['ens_mat'] == $mat_ens){
           echo '<div type="button" class="col-xs-12"><span class="col-md-8"></span>
           <form action="rapport_edit.php" method="post"><input type="text" name="id_rap"  style="display:none" value="'.$id_rap.'"/><input type="text" name="id_red" style="display:none" value="'.$ens_mat.'"/> <input type="submit" value="Edition du rapport"  class="btn btn-info"/> </form>
           
           </div>';
       }
        
    ?>
    <h2 class='col-xs-12'><i class="fa fa-clone" aria-hidden="true"></i> Description</h2>
    <div class='col-xs-2'></div>
    <div class='col-xs-12'>
        <div class='list-group'>
            <div class='list-group-item'>
                <?php  echo $desc_rap; ?> 
            </div>
        </div>
    </div>
    
    
       
</div>
<br />
<?php include 'bas.php';?>