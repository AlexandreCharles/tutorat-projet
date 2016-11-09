<?php
session_start();
$pse="";
$pwd="";
$alerte="";
if (isset($_SESSION['ens_mat'])) {
     header('Location: index.php');
  }else{
    
}


                
if(isset($_POST['login']) && isset($_POST['mdp'])){ 
    include 'BDD.php';
    $connexion=new BDD('tutorat'); 
    //les variables
    $pse=htmlspecialchars($_POST['login']);
    $pwd=htmlspecialchars($_POST['mdp']);
    $requete="select * from ens where ens_login=:login && ens_mdp=:mdp;";
    $param=array(':login'=>$pse,':mdp'=>$pwd);
    $ligne = $connexion->prepare_select($requete,$param);
    if(isset($ligne[0])){
        $_SESSION['ens_mat'] = $ligne[0]['ens_mat'];
        $_SESSION['ens_nom'] = $ligne[0]['ens_nom'];
        $_SESSION['ens_prenom'] = $ligne[0]['ens_prenom'];
        $_SESSION['ens_login'] = $ligne[0]['ens_login'];
       header('Location:index.php');    
    }else{
        
        $alerte="<div class='alert alert-danger' id='alert' role='alert'>IDENTIFICATION INVALIDE !</div>";
         
       
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="css/font/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/style.css">
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
            <header class='row'>
                <div class='col-md-12 header'><img src='css/bts.png' alt='le bts sio'/></div>
            </header>
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
                            <?php echo $alerte;?>
                            <div class='row'>
                                <div class="input-group">
                                    <div class="input-group-addon" id='loglab'>
                                      Login
                                      <i id='pse' style='color:green' class="fa fa-check " aria-hidden="true"></i>
                                      <i id='pse1' style='color:red' class="fa fa-ban " aria-hidden="true"></i>
                                    </div>
                                    <input type="text" class="form-control" id="login" name='login' value='<?php echo $pse;?>' placeholder="Pseudo" />
                                </div> 
                                <br />
                            </div>
                            <div class='row'>
                                <div class="input-group">
                                    <div class="input-group-addon" id='passlab'>
                                        Pass&nbsp;
                                        <i id="mdp1" style='color:green' class="fa fa-check" aria-hidden="true"></i>
                                        <i id="mdp2" style='color:red' class="fa fa-ban" aria-hidden="true"></i>
                                    </div>
                                    <input type='password' class='form-control' id='password' name='mdp' value='<?php echo $pwd;?>'  placeholder="Password" />
                                </div>  
                                <br />
                            </div>
                            <div class='row'>
                                <span class='col-xs-3'></span>
                                <input type='submit' id='bouton' value='valider' class='col-xs-6 	btn btn-info'/>
                            </div>
                            <br />
                        </form>
                    </div>
                </div>
                <div class='col-md-4'></div>
            </p>
                            </article>
                </div>
            </section>
        </div>
        
        <br />
        <footer>
            BTS SIO - Lycée Merleau Ponty
        </footer>
    </body>
</html>
    <script src="jquery.js"></script>
    <script>
        console.log("c'est qui le bosss ????? c'est bibiiiiiiiiiiiiiiiiiiiiiiiiiii !!!!");
        //pseudo
        $(document).ready(function() {
            
            $("#pse").hide();
            $("#pse1").hide();
            $("#mdp1").hide();
            $("#mdp2").hide();
            $("#bouton").attr("disabled",true);
            $("#login").keyup(function(){
                testInput(this,"#pse","#pse1");
            });
            //password
            $("#password").keyup(function(){
                testInput(this,"#mdp1","#mdp2");
            });
            function testInput(div,p1,p2){
                if($(div).val().length>5){
                    //this
                    $(p1).show();
                    $(p2).hide();
                    $(div).css("background-color","lightgreen");
                    if($("#login").val().length>5 && $("#password").val().length>5){
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
</html>
        