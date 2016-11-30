<?php
    // le titre de la page
    $titrePage="New Rapport";
    //include
    include 'config.php';
    $requete="";
    //  si on recoit des données derriere l'url
    if(isset($_GET['id_etu'])){
       $alerte=""; 
        $id_etu=$_GET['id_etu'];
        $type="";
        $dateP="";
        $descri="";
    // si on recoit des données du par le formulaire
    }elseif(isset($_POST['date']) && isset($_POST['type']) && isset($_POST['id_etu']) && isset($_POST['text'])){
        //variable
        $mat='';
        $id_etu=addslashes($_POST['id_etu']);
        $id_ens=$_SESSION['ens_mat'];
        //recup les rdv de l'etudiant
        $requete='SELECT rdv_id FROM rdv WHERE etu_mat=:id;';
        $nb=1;
        $param=array(':id'=>$id_etu);
        $ligne1 = $connexion->prepare_select($requete,$param);
        if($ligne1!=null){
            if(is_string($ligne1)){
                $alerte= $ligne1;
            }else{
                $nb=count($ligne1);
                $nb=$nb+1;
            }
        }
        //le type avec le matricule
       $type=$_POST['type'];
        if($type=="TRUE"){
            $mat=$id_etu."-".$id_ens."-F-".$nb;
        }else{
            $mat=$id_etu."-".$id_ens."-E-".$nb;
        }
        //securisation donnée input
        $dateP=htmlspecialchars(addslashes($_POST['date']));
        $regex = "/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/";
        
        if(preg_match($regex, $dateP)){
            $tabDate = explode("/", $dateP);
            $dateP =$tabDate[2]."-".$tabDate[1]."-".$tabDate[0];
        }
        
        $descri=htmlspecialchars(addslashes($_POST['text']));
        //requete
        /*$requete="INSERT INTO rdv(rdv_id,rdv_date,rdv_descri,rdv_type,ens_mat,etu_mat) VALUES (:mat,:dateP, :descri, :type,:id_ens, :id_etu);";
         $param=array(':mat'=>$mat,':dateP'=>$dateP,':descri'=>$descri,':type'=>$type,':id_ens'=>$id_ens,':id_etu'=>$id_etu);
        
        $ligne = prepare_insert($requete,$param);*/
        //requete
        $requete="INSERT INTO rdv(rdv_id,rdv_date,rdv_descri,rdv_type,ens_mat,etu_mat) VALUES ('$mat','$dateP','$descri',$type,$id_ens, $id_etu);";
        $ligne = $connexion->insert($requete);
        //si on recoit une chaine vide
        if($ligne==""){
            $alerte="<div class='alert alert-info' id='alert' role='alert'>Rapport créé !<br /> <a href='etudiant.php?id=".$id_etu."'>retour à l'etudiant</a></div>";
        //sinon
        }else{
            $alerte="<div class='alert alert-danger' id='alert' role='alert'>".$ligne."</div>";
        }
    // sinon
    }else{
        header("Location: index.php");
    }
include 'haut.php';
?>
<div class='row'>
    <h2 class='col-xs-12'><i class="fa fa-clone" aria-hidden="true"></i> Nouveau Rapport </h2>
    <div class="col-xs-12">
        <form method="POST" action='rapport_add.php' id='new' class='col-md-12' autocomplete="off">
            <?php if($alerte!=""){echo "<br />",$alerte;}?>
            
                <div class='row'>
                    <br />
                    <input type='text' name='id_etu' value='<?php echo $id_etu;?>' style='display:none;'/>
                    <!-- type -->
                    <div class="input-group">
                        <div class="input-group-addon" id='typelab'>
                            Type
                        </div>
                        <select class="form-control" id="type" name="type">
                            <option value="FALSE" <?php if($type==false){echo 'checked';}?>>Etudiant</option>
                            <option value="TRUE" <?php if($type==true){echo 'checked';}?>>Famille</option>
                        </select>
                    </div>
                    <!-- date -->
                    <br />
                    <div class="alert alert-warning" id='tool1'>Il faut une date JJ/MM/AAAA</div>
                   
                    <div class=" input-group">
                        <div class="input-group-addon" id='datelab'>
                            Date
                            <i id="date1" style='color:green' class="fa fa-check" aria-hidden="true"></i>
                            <i id="date2" style='color:red' class="fa fa-ban" aria-hidden="true"></i>
                        </div>
                        <input class="form-control" type="date" id='date' placeholder="JJ/MM/AAAA" value='<?php echo $dateP; ?>' name='date' />
                    </div> 
                    <br />
                     <div class="alert alert-warning" id='tool2'>minimum 50 caractères</div>
                    
                    <!-- descri -->
                    <div class=" input-group">
                        <div class="input-group-addon" id='textlab'>
                            Description
                            <i id="text1" style='color:green' class="fa fa-check" aria-hidden="true"></i>
                            <i id="text2" style='color:red' class="fa fa-ban" aria-hidden="true"></i>
                        </div>
                        <textarea rows="40" class='form-control' id='text' name='text'><?php echo $descri;?></textarea>
                    </div>  
                    <br />
                </div>
            </div>
           
            <div class='row'>
                <span class='col-xs-3'></span>
                <input type='submit' id='bouton' value='valider' class='col-xs-6 btn btn-info'/>
            </div>
            <br />
        </form>
       
    </div>          
</div>
<br />    
<?php
    include 'bas.php';
?>
 <script>
        //pseudo
        $(document).ready(function() {
            $("#tool1").hide();
            $("#tool2").hide();
            $("#date1").hide();
            $("#date2").hide();
            $("#text1").hide();
            $("#text2").hide();
            $("#bouton").attr("disabled",true);
            //date
            var regex = /^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/;
            $("#date").change(function(){
                var yopDate=$('#date').val();
                if (yopDate==regex){
                    var yopDate=String(yopDate);
                    var tab=yopDate.split('/');
                    yopDate=tab[2]+"-"+tab[1]+"-"+tab[0];
                   
                }
                
                if(Date.parse(yopDate)){
                    $("#date1").show();
                        $("#tool1").hide();
                        $("#date2").hide();
                        $(this).css("background-color","lightgreen");
                        if(Date.parse($('#date').val()) && $("#text").val().length>5){
                            $("#bouton").attr("disabled",false);
                        }
                }else{
                    $("#tool1").show();
                    $("#date2").show();
                    $("#date1").hide();
                    $(this).css("background-color","lightcoral");
                    $("#bouton").attr("disabled",true);
                }
            });
            //descri
            $("#text").keyup(function(){
                if($(this).val().length>50){
                    //this
                    $("#tool2").hide();
                    $("#text1").show();
                    $("#text2").hide();
                    $(this).css("background-color","lightgreen");
                    if(Date.parse($('#date').val()) && $("#text").val().length>5){
                        $("#bouton").attr("disabled",false);
                    }
                }else{
                    $("#tool2").show();
                    $("#text2").show();
                    $("#text1").hide();
                    $(this).css("background-color","lightcoral");
                    $("#bouton").attr("disabled",true);
                    
                }
            }); 
        });

    </script>