<!--page haut php-->
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
                        <li><a href='edit_etu.php'>Modifier Etudiant</a>&nbsp;</li>
                        <li><a href='deconnexion.php'>Deconnexion</a></li> 
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <br />
            <header class='row'>
                <div class='col-md-12 header'><img  src='../image/bts.png' alt='le bts sio'/></div>
            </header>
            <section>
            <br />
            <div class='row contenu'>
                <!-- la c'est la descri du prof -->
                <aside class='col-md-3 myDiv' >
                    <div class='row'>
                         <div class='titre col-md-12 '><i class="fa fa-user" aria-hidden="true"></i> ENSEIGNANT</div>
                        <p class='col-xs-6'>Nom: </p><p class='col-xs-6'><?php echo $_SESSION['ens_nom'];?></p>
                        <p class='col-xs-6'>Prenom: </p><p class='col-xs-6'><?php echo $_SESSION['ens_prenom'];?></p>
                        <p class='col-xs-6'>Matricule: </p><p class='col-xs-6'><?php echo $_SESSION['ens_mat'];?></p>
                        <br />
                        <div class='col-xs-12'>
                            <a href='' class='col-xs-12 btn btn-large btn-success' data-toggle="modal" data-target="#modal_edit" id='buttonEdit'>Editer</a>
                            <br />
                            <a href='' class='col-xs-12 btn btn-large btn-success' data-toggle="modal" data-target="#modal_add" id='buttonAdd'>Ajouter</a>
                            <br />     
                        </div> 
                    </div> 
                </aside>
                <!--  modale edition  -->
                <div class="modal fade" id="modal_edit" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Editer</h4>
                      </div>
                        <form method="post" action="" id='editer' class='list-group-item col-xs-12 modal-body' >
                             <div class='alert alert-danger' id='alertEditBad' role='alert'>UPDATE IMPOSSIBLE !</div>
                             <div class='alert alert-info' id='alertEditGood' role='alert'>UPDATE REUSSIT !</div>
                            <!--nom-->
                            <div class="alert alert-warning" id='tooledit1'>minimum 3 caractères</div>
                            <div class="input-group">
                                <div class="input-group-addon" id='nomedit'>
                                  Nom
                                  <i id='nomed1' style='color:green' class="fa fa-check " aria-hidden="true"></i>
                                  <i id='nomed2' style='color:red' class="fa fa-ban " aria-hidden="true"></i>
                                </div>
                                <input type="text" class="form-control" id="nom_ens" name='nom_ens' title="minimum 3 caractères" value='<?php echo $_SESSION['ens_nom'];?>' placeholder="nom" />
                            </div>
                            <!--prenom-->
                            <br />
                            <div class="alert alert-warning" id='tooledit2'>minimum 3 caractères</div>
                            <div class="input-group">
                                <div class="input-group-addon" id='prenomedit'>
                                    Prenom&nbsp;
                                    <i id="preed1" style='color:green' class="fa fa-check" aria-hidden="true"></i>
                                    <i id="preed2" style='color:red' class="fa fa-ban" aria-hidden="true"></i>
                                </div>
                                <input type='text' class='form-control' id='prenom_ens' name='prenom_ens' title="minimum 3 caractères" value='<?php echo $_SESSION['ens_prenom'];?>'  placeholder="Prenom" />
                            </div>
                            <!--login-->
                            <br />
                            <div class="alert alert-warning" id='tooledit3'>minimum 6 caractères</div>
                            <div class="input-group">
                                <div class="input-group-addon" id='loginedit'>
                                    Login&nbsp;
                                    <i id="loged1" style='color:green' class="fa fa-check" aria-hidden="true"></i>
                                    <i id="loged2" style='color:red' class="fa fa-ban" aria-hidden="true"></i>
                                </div>
                                <input type='text' class='form-control' id='login_ens' name='login_ens' title="minimum 6 caractères" value='<?php echo $_SESSION['ens_login'];?>'  placeholder="Login" />
                                
                            </div>
                            <!--bouton-->
                            <br />
                            <span class='col-xs-3'></span>
                            <input type='button' id='boutonEdit' value='valider' class='col-xs-6 	btn btn-info'/>
                            <br />
                        </form>
                      <div class="modal-footer">
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div>
                <!-- modale ajouter -->
                <div class="modal fade" id="modal_add" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Ajouter</h4>
                      </div>
                        <form method="post" action="" id='ajouter' class='list-group-item col-xs-12 modal-body' >
                             <div class='alert alert-danger' id='alertAddBad' role='alert'>AJOUT IMPOSSIBLE !</div>
                             <div class='alert alert-info' id='alertAddGood' role='alert'>AJOUT REUSSIT !</div>
                            <!--nom-->
                            <div class="alert alert-warning" id='tooladd1'>minimum 3 caractères</div>
                            <div class="input-group">
                                <div class="input-group-addon" id='nomadd'>
                                  Nom
                                  <i id='nomad1' style='color:green' class="fa fa-check " aria-hidden="true"></i>
                                  <i id='nomad2' style='color:red' class="fa fa-ban " aria-hidden="true"></i>
                                </div>
                                <input type="text" class="form-control" id="nom_ens_add" name='nom_ens_add' title="minimum 3 caractères" value='' placeholder="nom" />
                            </div>
                            <!--prenom-->
                            <br />
                            <div class="alert alert-warning" id='tooladd2'>minimum 3 caractères</div>
                            <div class="input-group">
                                <div class="input-group-addon" id='prenomadd'>
                                    Prenom&nbsp;
                                    <i id="pread1" style='color:green' class="fa fa-check" aria-hidden="true"></i>
                                    <i id="pread2" style='color:red' class="fa fa-ban" aria-hidden="true"></i>
                                </div>
                                <input type='text' class='form-control' id='prenom_ens_add' name='prenom_ens_add' title="minimum 3 caractères" value=''  placeholder="Prenom" />
                            </div>
                            <!--login-->
                            <br />
                            <div class="alert alert-warning" id='tooladd3'>minimum 6 caractères</div>
                            <div class="input-group">
                                <div class="input-group-addon" id='loginadd'>
                                    Login&nbsp;
                                    <i id="logad1" style='color:green' class="fa fa-check" aria-hidden="true"></i>
                                    <i id="logad2" style='color:red' class="fa fa-ban" aria-hidden="true"></i>
                                </div>
                                <input type='text' class='form-control' id='login_ens_add' name='login_ens_add' title="minimum 6 caractères" value=''  placeholder="Login" />
                                
                            </div>
                             <!--mot de passe-->
                            <br />
                            <div class="alert alert-warning" id='tooladd4'>minimum 6 caractères</div>
                            <div class="input-group">
                                <div class="input-group-addon" id='passadd'>
                                    Mot de Passe&nbsp;
                                    <i id="pasad1" style='color:green' class="fa fa-check" aria-hidden="true"></i>
                                    <i id="pasad2" style='color:red' class="fa fa-ban" aria-hidden="true"></i>
                                </div>
                                <input type='password' class='form-control' id='pass_ens_add' name='pass_ens_add' title="minimum 6 caractères" value=''  placeholder="Pass" />
                                
                            </div>
                            <!--bouton-->
                            <br />
                            <span class='col-xs-3'></span>
                            <input type='button' id='boutonAdd' value='valider' class='col-xs-6 	btn btn-info'/>
                            <br />
                        </form>
                      <div class="modal-footer">
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div>
                <!--la c'est le contenu de la page-->
                <div class="col-md-1"></div>
                <article class='col-md-8 myDiv'>