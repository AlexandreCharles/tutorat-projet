<?php
    $titrePage="New Rapport";
$requete="";
    include 'haut.php';
    if(isset($_GET['id_etu'])){
       $alerte=""; 
        $id_etu=$_GET['id_etu'];
        $type="";
        $dateP="";
        $descri="";
    }elseif(isset($_POST['date']) && isset($_POST['type']) && isset($_POST['id_etu']) && isset($_POST['text'])){
        //variable
        $id_etu=addslashes($_POST['id_etu']);
        $id_ens=$_SESSION['ens_mat'];
        $type=addslashes($_POST['type']);
        $dateP=addslashes($_POST['date']);
        $descri=addslashes($_POST['text']);
        //requete
        $requete="INSERT INTO rdv(rdv_date,rdv_descri,rdv_type,ens_mat,etu_mat) VALUES ('$dateP', '$descri', '$type', '$id_ens', '$id_etu');";
        
        $ligne = $connexion->insert($requete);
        if($ligne==""){
            $alerte="<div class='alert alert-info' id='alert' role='alert'>Rapport créé !<br /> <a href='rapport_read.php?id=".$id_etu."'>Voir rapport</a></div>";
        }else{
            $alerte="<div class='alert alert-danger' id='alert' role='alert'>".$ligne."</div>";
        }
    }else{
        header("Location: index.php");
    }
?>
<div class='row'>
    <h2 class='col-xs-12'><i class="fa fa-clone" aria-hidden="true"></i> Nouveau Rapport </h2>
    <div class="col-xs-12">
        <form method="POST" action='rapport_add.php' id='new' class='col-md-12' autocomplete="off">
            <br />
            <?php echo $alerte;?>
            
                <div class='row'>
                    <input type='text' name='id_etu' value='<?php echo $id_etu;?>' style='display:none;'/>
                    <!-- type -->
                    <div class="input-group">
                        <div class="input-group-addon" id='typelab'>
                            Type
                        </div>
                        <select class="form-control" id="type" name="type">
                          <option value="false" <?php if($type==false){echo 'checked';}?>>Etudiant</option>
                            <option value="true" <?php if($type==true){echo 'checked';}?>>Famille</option>
                        </select>
                    </div>
                    <!-- date -->
                    <div class=" input-group">
                        <div class="input-group-addon" id='datelab'>
                            Date
                            <i id="date1" style='color:green' class="fa fa-check" aria-hidden="true"></i>
                            <i id="date2" style='color:red' class="fa fa-ban" aria-hidden="true"></i>
                        </div>
                        <input class="form-control" type="date" id='date' value='<?php echo $dateP; ?>' name='date' />
                    </div> 
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
            $("#date1").hide();
            $("#date2").hide();
            $("#text1").hide();
            $("#text2").hide();
            $("#bouton").attr("disabled",true);
            //date
            var regex = /^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/;
            $("#date").focusout(function(){
                if(Date.parse($('#date').val())){
                    $("#date1").show();
                        $("#date2").hide();
                        $(this).css("background-color","lightgreen");
                        if(Date.parse($('#date').val()) && $("#text").val().length>5){
                            $("#bouton").attr("disabled",false);
                        }
                }else{
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
                    $("#text1").show();
                    $("#text2").hide();
                    $(this).css("background-color","lightgreen");
                    if(Date.parse($('#date').val()) && $("#text").val().length>5){
                        $("#bouton").attr("disabled",false);
                    }
                }else{
                    $("#text2").show();
                    $("#text1").hide();
                    $(this).css("background-color","lightcoral");
                    $("#bouton").attr("disabled",true);
                    
                }
            }); 
        });

    </script>