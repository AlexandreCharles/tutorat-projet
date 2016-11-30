<?php
$titrePage="Modifier Etudiant";
include "config.php";
include "haut.php";


 $requete2 = "select ens_nom, ens_prenom, ens_mat from ens;";
			$tab2 = $connexion->select($requete2);
            
//on recupere la taille du tableau
			$resultat2="";
			
			foreach($tab2 as $ligne2){
				$resultat2=$resultat2."<option id='tut_ens_".$ligne2['ens_mat']."' class='option'  value='".$ligne2['ens_mat']."'>".$ligne2['ens_nom']." ".$ligne2['ens_prenom']."</option>";
			}
//pour chaque ligne du tableau
             
             $tableau="<table class='table col-md-8'><tr class='row'><th class='col-md-3'>Matricule étudiant</th><th class='col-md-3'>Nom</th><th class='col-md-3'>Prenom</th><th class='col-md-3'>Tuteur</th></tr>";
			 $requete = "select etu_mat ,etu_nom ,etu_prenom ,ens.ens_mat, ens_nom, ens_prenom from etu inner join ens where etu.ens_mat=ens.ens_mat order by etu_mat;";

			 $tab = $connexion->select($requete);
			 
            
             foreach($tab as $ligne) {
                 //variables
				$etu_mat=$ligne['etu_mat'];
				$etu_nom=$ligne['etu_nom'];
				$etu_prenom=$ligne['etu_prenom'];
				$ens_mat=$ligne['ens_mat'];
				$ens_nom=$ligne['ens_nom'];
				$ens_prenom=$ligne['ens_prenom'];
                 //tableau
                $tableau= $tableau."<tr class='row'><td class='col-md-3'><button class='btn btn-info btn-user' type='button' id='".$etu_mat."' data-toggle='modal' data-target='#myModal' data-whatever='".$etu_mat."'>". $etu_mat."</td>
				<td class='col-md-3' id='nom_".$etu_mat."'>".$etu_nom."</td><p class='".$etu_mat."' name='ens_".$etu_mat."' id='ens_".$ens_mat."' style='display:none'>".$ens_mat."</p>
				<td class='col-md-3' id='prenom_".$etu_mat."'>".$etu_prenom."</td>
				<td class='col-md-3'>".$ens_nom." ".$ens_prenom."</td></tr>";
            }
			$tableau=$tableau."</table>";
			echo "<h2 class='col-md-12'><i class='fa fa-users' aria-hidden='true'></i> Modifier Etudiants</h2>";
			echo $tableau;
?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Modifier étudiant</h4>
        </div>
        <div class="modal-body">
          <form action='post' id="edition_etu">
            <div class='alert alert-danger' id='alertEtuBad' role='alert'>UPDATE IMPOSSIBLE !</div>
            <div class='alert alert-info' id='alertEtuGood' role='alert'>UPDATE REUSSIT !</div>
            <div class="form-group">
              <label for="nom-name" class="form-control-label">Nom étudiant:</label>
              <input type="text" class="form-control" name="nom_name" id="nom-name">
            </div>
              <input type="text" name="matri" id="matri" style='display:none;'/>
			<div class="form-group">
              <label for="prenom-name" class="form-control-label">Prenom étudiant:</label>
              <input type="text" class="form-control" name="prenom_name" id="prenom-name">
            </div>
			<div class="form-group">
              <label for="tuteur-name" class="form-control-label">Tuteur:</label>
              <select class="form-control" name="tuteur-name" id="tuteur-name"> <?php echo $resultat2;?>
			  </select>
			  <br />
            <span class='col-xs-3'></span>
            <input type='button' id='boutonEditEtu' value='valider' class='col-xs-6 	btn btn-info'/>
            <br />
            </div>
          </form>
        </div>
        <div class="modal-footer">
         
        </div>
      </div>
    </div>
  </div>

<script>

$(document).ready(function(){
    //on rend invisible les alerte
    $("#alertEtuBad").hide();
    $("#alertEtuGood").hide();
    //
$('#myModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget); // Button that triggered the modal
  var recipient = button.data('whatever'); // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this);
  modal.find('.modal-title').text("Modifier l'etudiant n°" + recipient);
  
});
$(".btn-user").click(function(){
	
    var idi=$(this).attr('id')
	var nom = "#nom_"+idi;
	
	var prenom = "#prenom_"+$(this).attr('id');
	$("#nom-name").val($(nom).text());
	$("#prenom-name").val($(prenom).text());
	$("#matri").val(idi);
	var classe = '.'+$(this).attr('id');
	var ens = "#tut_ens_"+$(classe).text();
	
	$("#tuteur-name option:selected").prop("selected", false);
	$(ens).prop("selected",true);
	

});
$("#boutonEditEtu").click(function(){
    ajaxEditEtu();
});
    function  ajaxEditEtu(){
        var text=$("#edition_etu").serialize();
        $.ajax({
            'url' : 'ajax_edit_etu.php',
            'type' : 'POST',
            'data' : text,
            'dataType' : 'html',
            'success' : function(donneesJSON, statut){
               if(donneesJSON == ""){
                   $("#alertEtuGood").show();
                   $("#alertEtuBad").hide();
               }else{
                    $("#alertEtuBad").html(donneesJSON);
                    $("#alertEtuBad").show();
                    $("#alertEtuGood").hide();
               }
                
             }
        })
    }
 
});
</script>

<?php
include "bas.php";
?>
