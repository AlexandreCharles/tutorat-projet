<?php
session_start();
//test session timeout
if (isset($_SESSION['timeout']) && $_SESSION['timeout']+ 100 * 60 < time()) {
     header('Location: deconnexion.php');
} 
//test session existance
if (!isset($_SESSION['ens_mat'])) {
    header('Location: login.php');
}
//reinitialiser le timeout
$_SESSION['timeout'] = time();
//la bdd
include 'BDD.php';
$connexion=new BDD('tutorat');
?>