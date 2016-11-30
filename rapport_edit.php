<?php
$titrePage="Edit Rapport";
    include 'config.php';
    $ale="";
    if(isset($_POST['id_rap']) && isset($_POST['id_red'])  ){
        $id_rap=$_POST['id_rap'];
        $id_red=$_POST['id_red'];
            $alerte="";
            $descri="";
        $date="";
            $requete='SELECT rdv_descri,rdv_date FROM rdv WHERE rdv_id="'.$id_rap.'";';
            $ligne = $connexion->select($requete);
            if(is_string($ligne)){
                $ale="<div class='alert alert-info' id='alert' role='alert'>".$ligne."</div>";
            }else{
               if(isset($ligne[0])){
                   $descri=$ligne[0]["rdv_descri"];
                    $date=$ligne[0]["rdv_date"];
                   //le navigateur utilisateur pour la date
                   $user_agent = getenv("HTTP_USER_AGENT");//on recupere le va
                   if (strpos($user_agent, "Firefox")==true || strpos($user_agent, "Mozilla")==true){
                        $date=date_create($date);
                        $date=date_format($date,"d/m/Y");
                   }
                    
                    
                   
                }else{
                   //header("Location: index.php");
                   echo $requete;
               }
            }
    }
    elseif(isset($_POST['text']) && isset($_POST['id']) && isset($_POST['date'])){
        $text=addslashes($_POST['text']);
        $text=htmlspecialchars($text);
        $date=addslashes($_POST['date']);
        $date=htmlspecialchars($date);
        $regex = "/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/";
        
        if(preg_match($regex, $date)){
            $tabDate = explode("/", $date);
            $date =$tabDate[2]."-".$tabDate[1]."-".$tabDate[0];
        }
        $id=$_POST['id'];
        $requete="UPDATE rdv SET rdv_descri='".$text."', rdv_date='".$date."' WHERE rdv_id='".$id."';";
        $ligne = $connexion->insert($requete);
        if($ligne==""){
            $alerte="<div class='alert alert-info' id='alert' role='alert'>Modification executé !<br /><a href='rapport_read.php?id=".$id."' class=''>Retour</a> </form></div>";
            $descri=$text;
        }else{
            $alerte="<div class='alert alert-danger' id='alert' role='alert'>".$ligne."</div>";
        }
        $date=date_create($date);
        $date=date_format($date,"d/m/Y");
        
        
    }else{
        header("Location: index.php");
    }
include 'haut.php';
?>
<div class='row'>
    <h2 class='col-xs-12'><i class="fa fa-clone" aria-hidden="true"></i> Edition Rapport <?php echo $id_rap; ?></h2>
    <div class="col-xs-12">
        <form method="POST" action='rapport_edit.php' id='edit' class='col-md-12' autocomplete="off">
            
            <?php  if($alerte!=""){echo "<br />",$alerte;}
                    if($ale!=""){echo "<br />",$ale;}?>
            <br />
                <input type='text' name='id' value='<?php echo $id_rap;?>' style='display:none;'/>
            <br />
                <!-- date -->
                <div class="alert alert-warning" id='tool1'>Il faut une date JJ/MM/AAAA</div>
                <div class='row'>
                    <div class=" input-group">
                        <div class="input-group-addon" id='datelab'>
                            Date
                            <i id="date1" style='color:green' class="fa fa-check" aria-hidden="true"></i>
                            <i id="date2" style='color:red' class="fa fa-ban" aria-hidden="true"></i>
                        </div>
                        <input class="form-control" type="date" id='date' placeholder="JJ/MM/AAAA" value='<?php echo $date; ?>' name='date' />
                    </div> 
                </div>
            <br />
                <!--descri-->
                <div class="alert alert-warning" id='tool2'>minimum 50 caractères</div>
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
        $(document).ready(function() {
            $("#tool1").hide();
            $("#tool2").hide();
            $("#date1").hide();
            $("#date2").hide();
            $("#text1").hide();
            $("#text2").hide();
            $("#bouton").attr("disabled",true);
            //descri
            $("#text").keyup(function(){
                testInput(this,"#text1","#text2",'#tool2',50);
            });
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
            function testInput(div,p1,p2,tool,num){
                if($(div).val().length>num){
                    //this
                    $(tool).hide();
                    $(p1).show();
                    $(p2).hide();
                    $(div).css("background-color","lightgreen");
                    if($('#text').val().length>50 && $('#date').val().length>6 ){
                        $("#bouton").attr("disabled",false);
                    }
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
