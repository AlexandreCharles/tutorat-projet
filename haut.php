<?php
session_start();
if (isset($_SESSION['timeout']) && $_SESSION['timeout']+ 100 * 60 < time()) {
     header('Location: deconnexion.php');
  } 
if (isset($_SESSION['ens_mat'])) {
     
  }else{
    header('Location: login.php');
}
 $_SESSION['timeout'] = time();
include 'BDD.php';
$connexion=new BDD('tutorat'); 
                

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="jquery.js"></script>
        <link rel="icon" type="image/png" href="css/favicon.png" />
        <link rel="stylesheet" href="css/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="css/font/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/style.css">
        <title>Tutorat<?php if(isset($titrePage)){ echo ' - ',$titrePage;} ?></title>
    </head>
    <body>
        
        <nav id="topBar" class="navbar navbar-inverse navbar-static-top">
            <p class="navbar-brand" >BTS SIO</p>
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                
                <div class="navbar-collapse collapse" id="navbar" >
                    <ul id="navI" class="nav navbar-nav">
                        <li><a href='index.php'>Etudiants</a>&nbsp;</li>
                        <li><a href='add_etu.php'>Ajouter Etudiant</a>&nbsp;</li>
                        <li><a href=''>Modifier Etudiant</a>&nbsp;</li>
                        <li><a href='deconnexion.php'>Deconnexion</a></li> 
                    </ul>
                </div>
            </div>
        </nav>
        
        <div class="container">
            <br />
            <header class='row'>
                <div class='col-md-12 header'><img  src='css/bts.png' alt='le bts sio'/></div>
            </header>
            <section>
            <br />
            <div class='row contenu'>
                <aside class='col-md-3 myDiv' >

                    <div class='row'>
                         <div class='titre col-md-12 '><i class="fa fa-user" aria-hidden="true"></i> ENSEIGNANT</div>
                        <p class='col-xs-6'>Nom: </p><p class='col-xs-6'><?php echo $_SESSION['ens_nom'];?></p>
                        <p class='col-xs-6'>Prenom: </p><p class='col-xs-6'><?php echo $_SESSION['ens_prenom'];?></p>
                        <p class='col-xs-6'>Matricule: </p><p class='col-xs-6'><?php echo $_SESSION['ens_mat'];?></p>
                        <br />
                        <div class='col-xs-12'>
                            <a href='' class='col-xs-12 btn btn-large btn-success' id='buttonEdit'>Editer</a>
                            <br />
                            <a href='' class='col-xs-12 btn btn-large btn-success' id='buttonAdd'>Ajouter</a>
                            <br />
                                
                        </div>
                        
                        
                    </div>
                    
                </aside>
                <div class="col-md-1"></div>
                <article class='col-md-8 myDiv'>



