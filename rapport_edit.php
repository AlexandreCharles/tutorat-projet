<?php
$titrePage="Edit Rapport";
    include 'haut.php';
    if(isset($_GET['id_rap']) && isset($_GET['id_red'])){
        $id_rap=$_GET['id_rap'];
        $id_red=$_GET['id_red'];
        $alerte="";
        $descri="";
        
        $requete='SELECT rdv_descri FROM rdv WHERE rdv_id=:rdv_id;';
        $param=array(':rdv_id'=>$id_rap);
        $ligne = $connexion->prepare_select($requete,$param);
        if(is_string($ligne)){
            echo $ligne;
        }else{
           if(isset($ligne[0])){
                $descri=$ligne[0]["rdv_descri"];
            }else{
               header("Location: index.php");
           }
        }
    }
    elseif(isset($_POST['text']) && isset($_POST['id'])){
        $text=addslashes($_POST['text']);
        $text=htmlspecialchars($text);
        $id=$_POST['id'];
        $requete="UPDATE rdv SET rdv_descri='".$text."' WHERE rdv_id=".$id.";";
        $ligne = $connexion->insert($requete);
        if($ligne==""){
            $alerte="<div class='alert alert-info' id='alert' role='alert'>Modification executé !<br /> <a href='rapport_read.php?id=".$id."'>Retour au rapport</a></div>";
            $descri=$text;
        }else{
            $alerte="<div class='alert alert-danger' id='alert' role='alert'>".$ligne."</div>";
        }
        
        
    }else{
        header("Location: index.php");
    }
?>
<div class='row'>
    <h2 class='col-xs-12'><i class="fa fa-clone" aria-hidden="true"></i> Edition Rapport <?php echo $id_rap; ?></h2>
    <div class="col-xs-12">
        <form method="POST" action='rapport_edit.php' id='edit' class='col-md-12' autocomplete="off">
            <br />
            <?php echo $alerte;?>
                <input type='text' name='id' value='<?php echo $id_rap;?>' style='display:none;'/>
                <div class='row'>
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
                <input type='submit' id='bouton' value='valider' class='col-xs-6 	btn btn-info'/>
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
            
            $("#text1").hide();
            $("#text2").hide();
            $("#bouton").attr("disabled",true);
            $("#text").keyup(function(){
                testInput(this,"#text1","#text2");
            });
            
            function testInput(div,p1,p2){
                if($(div).val().length>50){
                    //this
                    $(p1).show();
                    $(p2).hide();
                    $(div).css("background-color","lightgreen");
                    if($("#text").val().length>50){
                        $("#bouton").attr("disabled",false);
                    }
                }else{
                    $(p2).show();
                    $(p1).hide();
                    $(div).css("background-color","lightcoral");
                    $("#bouton").attr("disabled",true);
                    
                }
            }    
        });
    </script>
