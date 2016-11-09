<?php
$titrePage= "Index";
include 'haut.php';

?>
<div class='row'>
    <h2 class='col-md-12'><i class="fa fa-users" aria-hidden="true"></i> Etudiants</h2>
    <br />
    <div class="input-group">
        
        <div class="input-group-addon" id='searchlab'>
          Recherche
        </div>
        <input type="text" class="form-control" id="search" name='search'  placeholder="Nom" />
    </div> 
    <br />
    <div class='col-sm-2 xs-hidden-down'></div>
    <table id='table' class="table col-md-8">
    </table>
    
</div>
<br/>
<?php
include 'bas.php';
?>
<script>
    
        $(document).ready(function() {
            //fonction liste juron
            function listeTable(donneesJSON){
                var nb=donneesJSON.length;
                var ens;
                var resultat='<tr class="row"><th class="col-md-3">Matricule</th><th class="col-md-3">Nom</th><th class="col-md-3">Prenom</th><th class="col-md-3">Tuteur</th></tr>';
                if(nb>0){
                    for(var i=0;i<nb;i++){
                        if(donneesJSON[i].ens_nom=="" && donneesJSON[i].ens_prenom==""){
                            ens="AUCUN TUTEUR";
                        }else{
                            ens=donneesJSON[i].ens_nom+" "+donneesJSON[i].ens_prenom;
                        }
                        resultat+='<tr class="row"><td class="col-md-3"><form method="get" action="etudiant.php"><input type="text" value="'+donneesJSON[i].etu_mat+'" name="id" class="none"/> <input type="submit" value="'+donneesJSON[i].etu_mat+'" class="btn btn-info" /></form></td><td class="col-md-3">'+donneesJSON[i].etu_nom+'</td><td class="col-md-3">'+donneesJSON[i].etu_prenom+'</td><td class="col-md-3">'+ens+'</td></tr>';
                    }
                }else{
                    resultat="<tr><th>AUCUN ETUDIANT TROUVER<th></tr>";
                }
                return resultat;
            }
            //au lancement de la page
            search=$("#search");
            liste=$("#table");
            text=search.val();
            $.ajax({
                'url' : 'ajax_search.php',
                'type' : 'POST',
                'data' : 'val='+text,
                'dataType' : 'json',
                'success' : function(donneesJSON, statut){
                    var resultat=listeTable(donneesJSON);
                    liste.html(resultat);
                 },
                'error' : function (){
                    liste.html("<tr><th>Erreur: "+statut+"</th></tr>");
                }
            })
            //quand on rajoute/supprime un caractère 
            search.keyup(function(){
                 text=search.val();
                $.ajax({
                    'url' : 'ajax_search.php',
                    'type' : 'POST',
                    'data' : 'val='+text,
                    'dataType' : 'json',
                    'success' : function(donneesJSON, statut){
                        var resultat=listeTable(donneesJSON);
                        liste.html(resultat);
                     },
                    'error' : function (){
                        liste.html("<tr><th>Erreur: "+statut+"</th></tr>");
                    }
                })
            });
        });
    </script>