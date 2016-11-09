<?php
include 'haut.php';
?>

<form method="post" action="test.php" enctype="multipart/form-data">
<label for="mon_fichier">Fichier (format CSV | max. 1 Mo) :</label><br />
<input type="hidden" name="MAX_FILE_SIZE" value="1048576" />
<input type="file" name="mon_fichier" value='mon_fichier'/></br>
<input type="submit" name="submit" value="Envoyer"/></br>
</form>
<?php

$etu_nom='';
$etu_prenom='';
/*include 'BDD.php';
$connexion = new BDD('tutorat');*/

if(isset($_FILES['mon_fichier'])){
//Vérification de l'extension du fichier
$extensions_valides = array( 'csv' );

$extension_upload = strtolower(  substr(  strrchr($_FILES['mon_fichier']['name'], '.')  ,1)  );

if ( in_array($extension_upload,$extensions_valides) ) echo "Extension correcte</br>";

//mkdir('csv/1/', 0777, true);
$id_membre=md5(uniqid(rand(), true));
$nom = "csv/{$id_membre}.{$extension_upload}";
$nomf="{$id_membre}.{$extension_upload}";
$resultat = move_uploaded_file($_FILES['mon_fichier']['tmp_name'],$nom);
if ($resultat) 
{
	echo "Transfert réussi</br>";
}else
{
	echo "transfert échoué</br>";
	}

//Controlfile a faire avec upload
$row=1;
$nom=$_FILES['mon_fichier']['name'];

if (($handle = fopen("csv/$nomf", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ";",'"')) !== FALSE) {
        $num = count($data);
        $row++;
        $etu_nom=$data[0];
		$etu_prenom=$data[1];
		$requete="insert into etu (etu_nom,etu_prenom) values ('$etu_nom','$etu_prenom');";
		$message = $connexion->insert($requete);
			if ($message==""){
					$message="Ligne bien insérée.";
				}
					else{
					 $message="Problème d'insertion";
				}
    }
    fclose($handle);
}
}

echo "";



include 'bas.php';





/*$row = 1;
if (($handle = fopen('D:\wamp64\www\PPE3\LISTESIO.csv', "r")) !== FALSE) {
    while (($data = fgetcsv($handle[, 1000[, ";"]])) !== FALSE) {
        $num = count($data);
        for ($c=0; $c < $num; $c++) {
			$ligne = $data[$c];
			$etu_nom=$ligne['nom'];
			$etu_prenom=$ligne['prenom'];
			echo $requete;
            $message = $connexion->insert($requete);
				if ($message==""){
					$message="Ligne bien insérée.";
				}
					else{
					 $message="Problème d'insertion";
				}
        }
    }
    fclose($handle);
}*/
?>
