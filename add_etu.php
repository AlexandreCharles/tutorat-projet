<?php
$titrePage="Ajout Etudiant";
include 'config.php';
include 'haut.php';
$select="";
$requete='SELECT ens_mat,ens_nom,ens_prenom FROM ens WHERE ens_mat<>0;';
$tab = $connexion->select($requete);
foreach($tab as $ligne){
    $select=$select."<option value='".$ligne['ens_mat']."'>".$ligne['ens_nom']." ".$ligne['ens_prenom']."</option>";
}
?>
<div class='row'>
    <div class='col-xs-12'>
        <div aria-label="Page navigation">
            <ul class="pagination col-xs-12">
                <li><a href="#" id="but1">IMPORTATION</a></li>
                <li><a href="#" id="but2">CREATION</a></li>
            </ul>
        </div>
        <!-- importation csv -->
        <div id='import' class='col-xs-12'>
            <h2 class='col-md-12'><i class="fa fa-users" aria-hidden="true"></i> Importation CSV</h2>
            <br />
            <div class='row'>
                <form method="post" action="" class='list-group-item col-xs-12' enctype="multipart/form-data">
                    <label for="mon_fichier">Fichier (format CSV | max. 1 Mo) :</label><br />
                    <input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
                    <input type="file" name="mon_fichier"  value='mon_fichier'/></br>
                    <input type="submit" name="submit" class="btn btn-info" value="Envoyer"/></br>
                </form>
            </div>
            <br />
        <?php

            $etu_nom='';
            $etu_prenom='';

            if(isset($_FILES['mon_fichier'])){
                $extensions_valides = array( 'csv' );
                $extension_upload = strtolower(  substr(  strrchr($_FILES['mon_fichier']['name'], '.')  ,1)  );

                if ( in_array($extension_upload,$extensions_valides) ){
                     //Vérification de l'extension du fichier
                     echo "Extension correcte</br>";

                    //mkdir('csv/1/', 0777, true);
                    $id_membre=md5(uniqid(rand(), true));
                    $nom = "../csv/{$id_membre}.{$extension_upload}";
                    $nomf="{$id_membre}.{$extension_upload}";
                    $resultat = move_uploaded_file($_FILES['mon_fichier']['tmp_name'],$nom);
                    if ($resultat) 
                    {
                        echo "Transfert réussi</br>";
                    }else
                    {
                        echo "transfert échoué</br>";
                        }

                    //Controlfile a faire avec upload
                    $row=1;
                    $nom=$_FILES['mon_fichier']['name'];

                if (($handle = fopen("../csv/$nomf", "r")) !== FALSE) {
                    while (($data = fgetcsv($handle, 1000, ";",'"')) !== FALSE) {
                        $num = count($data);
                        $row++;
                        $etu_nom=$data[0];
                        $etu_prenom=$data[1];
                        $requete="insert into etu (etu_nom,etu_prenom,ens_mat) values ('$etu_nom','$etu_prenom',0);";
                        $message = $connexion->insert($requete);
                            if ($message==""){
                                    $message="Ligne bien insérée.";
                                }
                                    else{
                                     $message="Problème d'insertion";
                                }
                    }
                    fclose($handle);
                }
                }else{
                 echo 'Selectionner un fichier CSV';
             }
            }
    echo "";
        ?>
        </div>
        <!-- creation ligne -->
        <div id='ligne' class='col-xs-12'>
            <h2 class='col-md-12'><i class="fa fa-users" aria-hidden="true"></i> Ajouter un Etudiant</h2>
            <br />
            <div class='row'>
                <form method="post" action="" id='crea' class='list-group-item col-xs-12' >
                     <div class='alert alert-danger' id='alertBad' role='alert'>INSERTION IMPOSSIBLE !</div>
                     <div class='alert alert-info' id='alertGood' role='alert'>INSERTION REUSSIT !</div>
                    <!--nom-->
                    <div class="alert alert-warning" id='tool1'>minimum 3 caractères</div>
                    <div class="input-group">
                        <div class="input-group-addon" id='nomlab'>
                          Nom
                          <i id='nom1' style='color:green' class="fa fa-check " aria-hidden="true"></i>
                          <i id='nom2' style='color:red' class="fa fa-ban " aria-hidden="true"></i>
                        </div>
                        <input type="text" class="form-control" id="nom" name='nom' title="minimum 3 caractères" value='<?php if(isset($nom)){echo $nom;}?>' placeholder="nom" />
                    </div>
                    <!--prenom-->
                    <br />
                    <div class="alert alert-warning" id='tool2'>minimum 3 caractères</div>
                    <div class="input-group">
                        <div class="input-group-addon" id='prenomlab'>
                            Prenom&nbsp;
                            <i id="pre1" style='color:green' class="fa fa-check" aria-hidden="true"></i>
                            <i id="pre2" style='color:red' class="fa fa-ban" aria-hidden="true"></i>
                        </div>
                        <input type='text' class='form-control' id='prenom' name='prenom' title="minimum 3 caractères" value='<?php if(isset($prenom)){echo $prenom;}?>'  placeholder="Prenom" />
                    </div>
                    <!--tuteur-->
                    <br />
                    <div class="input-group">
                        <div class="input-group-addon" name='tut' id='tut'>
                            Tuteur
                        </div>
                        <select class="form-control" id="tuteur" name="tuteur">
                            <?php echo $select?>
                        </select>
                    </div>
                    <!--bouton-->
                    <div class='row'>
                        <br />
                        <span class='col-xs-3'></span>
                        <input type='button' id='bouton' value='valider' class='col-xs-6 	btn btn-info'/>
                    </div>
                    <br />
                </form>
            </div>
            <br />
        </div>
    </div>    
</div>

<?php

include 'bas.php';


?>
<script>
$(document).ready(function() {
    //importation
    $('#ligne').hide();
    $('#but1').click(function(){
        $('#import').show();
        $('#ligne').hide();
    });
    $('#but2').click(function(){
        $('#import').hide();
        $('#ligne').show();
    });
    //creation
    $('#tool1').hide();
    $('#tool2').hide();
    $('#pre1').hide();
    $('#pre2').hide();
    $('#nom1').hide();
    $('#nom2').hide();
    $("#alertBad").hide();
    $("#alertGood").hide();
    $("#bouton").attr("disabled",true);
    
     //lorsqu'on entre un truc dans le champs prenom
    $("#prenom").keyup(function(){
        testInput(this,"#pre1","#pre2","#tool2");
    });
    //lorsqu'on entre un truc dans le champs nom
    $("#nom").keyup(function(){
        testInput(this,"#nom1","#nom2","#tool1");
    });
    //
    $('#bouton').click(function(){
            ajaxInsert();
        });
    //on utilise ajax
    function ajaxInsert(){
        var text=$("#crea").serialize();
        $.ajax({
            'url' : 'ajax_insert.php',
            'type' : 'POST',
            'data' : text,
            'dataType' : 'html',
            'success' : function(donneesJSON, statut){
               if(donneesJSON == ""){
                   $("#alertGood").show();
                   $("#alertBad").hide();
               }else{
                    $("#alertBad").html(donneesJSON);
                    $("#alertBad").show();
                    $("#alertGood").hide();
               }
                
             }
        })
    }
    //function à executée
    function testInput(div,p1,p2,tool){
        //si il y a assez de caractères
        if($(div).val().length>=3){
            $(tool).hide();
            $(p1).show();
            $(p2).hide();
            $(div).css("background-color","lightgreen");
            //testons si tous les input sont valide
            if($("#nom").val().length>=3 && $("#prenom").val().length>=3){
                $("#bouton").attr("disabled",false);
            }
            //sinon
        }else{
            $(tool).show();
            $(p2).show();
            $(p1).hide();
            $(div).css("background-color","lightcoral");
            $("#bouton").attr("disabled",true);
        }
    } 
});
</script>
