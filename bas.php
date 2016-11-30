                    </article>
                </div>
            </section>
        </div>
        <br />
        <footer class="navbar navbar-inverse navbar-static-bottom">
            BTS SIO - Lycée Merleau Ponty
        </footer>
    </body>
</html>
<script>
$(document).ready(function() {
    //edition
    //tooltip
    $('#tooledit1').hide();
    $('#tooledit2').hide();
    $('#tooledit3').hide();
    
    $('#preed1').hide();
    $('#preed2').hide();
    
    $('#nomed1').hide();
    $('#nomed2').hide();
    
    $('#loged1').hide();
    $('#loged2').hide();
    
    //alert
    $("#alertEditBad").hide();
    $("#alertEditGood").hide();
    //button
    $("#boutonEdit").attr("disabled",true);
    
     //lorsqu'on entre un truc dans le champs prenom
    $("#prenom_ens").keyup(function(){
        testInputEd(this,"#preed1","#preed2","#tooledit2",3);
    });
    //lorsqu'on entre un truc dans le champs nom
    $("#nom_ens").keyup(function(){
        testInputEd(this,"#nomed1","#nomed2","#tooledit1",3);
    });
    //login
    $("#login_ens").keyup(function(){
        testInputEd(this,"#loged1","#loged2","#tooledit3",6);
    });
    //
    $('#boutonEdit').click(function(){
            ajaxEdit();
        });
    //formu add
    //disparition
    //tooltip
    $('#tooladd1').hide();
    $('#tooladd2').hide();
    $('#tooladd3').hide();
    $('#tooladd4').hide();
    //icone
    $('#pread1').hide();
    $('#pread2').hide();
    
     $('#nomad1').hide();
    $('#nomad2').hide();
    
    $('#logad1').hide();
    $('#logad2').hide();
    
    $('#pasad1').hide();
    $('#pasad2').hide();
    
    //alerte
    $("#alertAddBad").hide();
    $("#alertAddGood").hide();
    //button
    $("#boutonAdd").attr("disabled",true);
    //et on dynamise
    //prenom
    $("#prenom_ens_add").keyup(function(){
        testInputAd(this,"#pread1","#pread2","#tooladd2",3);
    });
    //nom
    $("#nom_ens_add").keyup(function(){
        testInputAd(this,"#nomad1","#nomad2","#tooladd1",3);
    });
    //login
    $("#login_ens_add").keyup(function(){
        testInputAd(this,"#logad1","#logad2","#tooladd3",6);
    });
    //pass
    $("#pass_ens_add").keyup(function(){
        testInputAd(this,"#pasad1","#pasad2","#tooladd4",6);
    });
    //bouton add
    $('#boutonAdd').click(function(){
            ajaxAdd();
        });
     //on utilise ajax add
    function ajaxAdd(){
        var text=$("#ajouter").serialize();
        
        $.ajax({
            'url' : 'ajax_add.php',
            'type' : 'POST',
            'data' : text,
            'dataType' : 'html',
            'success' : function(donneesJSON, statut){
               if(donneesJSON == ""){
                   $("#alertAddGood").show();
                   $("#alertAddBad").hide();
                  
               }else{
                    $("#alertAddBad").html(donneesJSON);
                    $("#alertAddBad").show();
                    $("#alertAddGood").hide();
               }
                
             }
        })
    }
    //on utilise ajax edit
    function ajaxEdit(){
        var text=$("#editer").serialize();
        
        $.ajax({
            'url' : 'ajax_edit.php',
            'type' : 'POST',
            'data' : text,
            'dataType' : 'html',
            'success' : function(donneesJSON, statut){
               if(donneesJSON == ""){
                   $("#alertEditGood").show();
                   $("#alertEditBad").hide();
               }else{
                    $("#alertEditBad").html(donneesJSON);
                    $("#alertEditBad").show();
                    $("#alertEditGood").hide();
               }
                
             }
        })
    }
    //function à executée
    //edit
    function testInputEd(div,p1,p2,tool,nb){
        //si il y a assez de caractères
        if($(div).val().length>=nb){
            $(tool).hide();
            $(p1).show();
            $(p2).hide();
            $(div).css("background-color","lightgreen");
             //testons si tous les input sont valide
            if($("#nom_ens").val().length>=3 && $("#login_ens").val().length>=6 && $("#prenom_ens").val().length>=3){
                $("#boutonEdit").attr("disabled",false);
            }
            //sinon
        }else{
            $(tool).show();
            $(p2).show();
            $(p1).hide();
            $(div).css("background-color","lightcoral");
            $("#boutonEdit").attr("disabled",true);
        }
    } 
    //add
    function testInputAd(div,p1,p2,tool,nb){
        //si il y a assez de caractères
        if($(div).val().length>=nb){
            $(tool).hide();
            $(p1).show();
            $(p2).hide();
            $(div).css("background-color","lightgreen");
             //testons si tous les input sont valide
            if($("#nom_ens_add").val().length>=3 && $("#login_ens_add").val().length>=6  && $("#pass_ens_add").val().length>=6 && $("#prenom_ens_add").val().length>=3){
                $("#boutonAdd").attr("disabled",false);
            }
            //sinon
        }else{
            $(tool).show();
            $(p2).show();
            $(p1).hide();
            $(div).css("background-color","lightcoral");
            $("#boutonAdd").attr("disabled",true);
        }
    } 
});
</script>
