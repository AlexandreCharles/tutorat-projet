<?php
session_start();
$pse="";
$pwd="";
$alerte="";
//test varaible session existante
if (isset($_SESSION['ens_mat'])) {
     header('Location: index.php');
}
//test envoie de donner par le formulaire : 2 eme chargement de la page
if(isset($_POST['login']) && isset($_POST['mdp'])){ 
    include 'BDD.php';
    $connexion=new BDD('tutorat'); 
    //les variables sont securisé
    $pse=htmlspecialchars(addslashes($_POST['login']));
    $pwd=htmlspecialchars(addslashes($_POST['mdp']));
    
    // requete et recherche des données dans la bdd
    $requete="select * from ens where ens_login=:login;";
    $param=array(':login'=>$pse);
    $ligne = $connexion->prepare_select($requete,$param);
    if(isset($ligne[0])){
        //si bon on crée notre session et on redirige vers index
        $pass=$ligne[0]['ens_mdp'];
        if(password_verify($pwd,$pass)){
            $_SESSION['ens_mat'] = $ligne[0]['ens_mat'];
            $_SESSION['ens_nom'] = $ligne[0]['ens_nom'];
            $_SESSION['ens_prenom'] = $ligne[0]['ens_prenom'];
            $_SESSION['ens_login'] = $ligne[0]['ens_login'];
           header('Location:index.php'); 
        }else{
           $alerte="<div class='alert alert-danger' id='alert' role='alert'>IDENTIFICATION INVALIDE !</div>"; 
        }
           
    }else{
        //sinon on fait afficher un message
        $alerte="<div class='alert alert-danger' id='alert' role='alert'>IDENTIFICATION INVALIDE !</div>";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/png" href="../image/favicon.png" />
        
        <script src="../js/jquery.js"></script>
        <script src="../css/bootstrap/js/bootstrap.min.js"></script>
        
        <link rel="stylesheet" href="../css/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="../css/font/css/font-awesome.min.css">
        <link rel="stylesheet" href="../css/style.css">
        <title>Tutorat - Login</title>
    </head>
    <body>
        <nav id="topBar" class="navbar navbar-inverse navbar-static-top">
            <p class="navbar-brand" >BTS SIO</p>
            <div class="container">
                <div class="navbar-header">
                </div>
            </div>
        </nav>
        <div class="container">
            <br />
            <!--header-->
            <header class='row'>
                <div class='col-md-12 header'><img src='../image/bts.png' alt='le bts sio'/></div>
            </header>
            <!--section-->
            <section>
                <br />
                <p class='row'>
                    <div class='col-xs-4'></div>
                    <div class='col-md-4' id='myLogin'>
                        <div class="row">
                            <div id='titreLogin' class='col-md-12'>
                                <i class="fa fa-sign-in" aria-hidden="true"></i> CONNEXION
                            </div>

                            <div class='col-md-2'></div>
                            <form method="POST" id='suiteLogin' class='col-md-8' autocomplete="off">
                                <br />
                                <?php if($alerte!=""){echo $alerte;}?>
                                <!--pseudo-->
                                <div class="alert alert-warning" id='tool1'>minimum 6 caractères</div>
                                <div class='row'>

                                    <div class="input-group">
                                        <div class="input-group-addon" id='loglab'>
                                          Login
                                          <i id='pse' style='color:green' class="fa fa-check " aria-hidden="true"></i>
                                          <i id='pse1' style='color:red' class="fa fa-ban " aria-hidden="true"></i>
                                        </div>
                                        <input type="text" class="form-control" id="login" name='login' title="minimum 6 caractères" value='<?php echo $pse;?>' placeholder="Pseudo" />
                                    </div> 
                                </div>
                                <br />
                                <!-- password-->
                                <div class="alert alert-warning" id='tool2'>minimum 6 caractères</div>
                                <div class='row'>

                                    <div class="input-group">
                                        <div class="input-group-addon" id='passlab'>
                                            Pass&nbsp;
                                            <i id="mdp1" style='color:green' class="fa fa-check" aria-hidden="true"></i>
                                            <i id="mdp2" style='color:red' class="fa fa-ban" aria-hidden="true"></i>
                                        </div>
                                        <input type='password' class='form-control' id='password' name='mdp' title="minimum 6 caractères" value='<?php echo $pwd;?>'  placeholder="Password" />
                                    </div> 
                                </div>
                                <!--bouton-->
                                <div class='row'>
                                    <br />
                                    <span class='col-xs-3'></span>
                                    <input type='submit' id='bouton' value='valider' class='col-xs-6 	btn btn-info'/>
                                </div>
                                <br />
                            </form>
                        </div>
                    </div>
                    <div class='col-md-4'></div>
                </p>
            </section>
        </div>
    
        <br />
        <!--footer-->
        <footer>
            BTS SIO - Lycée Merleau Ponty
        </footer>
    </body>
</html>
    <!--script-->
    <script src="../js/jquery.js"></script>
    <script>
        //pseudo
        $(document).ready(function() {
            //on rend invisible le visible
            $("#tool1").hide();
            $("#tool2").hide();
            $("#pse").hide();
            $("#pse1").hide();
            $("#mdp1").hide();
            $("#mdp2").hide();
            //bouton desactiver
            $("#bouton").attr("disabled",true);
            //lorsqu'on entre un truc dans le champs login
            $("#login").keyup(function(){
                testInput(this,"#pse","#pse1","#tool1");
            });
            //lorsqu'on entre un truc dans le champs password
            $("#password").keyup(function(){
                testInput(this,"#mdp1","#mdp2","#tool2");
            });
            //function à executée
            function testInput(div,p1,p2,tool){
                //si il y a assez de caractères
                if($(div).val().length>5){
                    $(tool).hide();
                    $(p1).show();
                    $(p2).hide();
                    $(div).css("background-color","lightgreen");
                    //testons si tous les input sont valide
                    if($("#login").val().length>5 && $("#password").val().length>5){
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
</html>
        