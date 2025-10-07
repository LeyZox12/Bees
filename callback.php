<?PHP

// http://localhost/callback.php?nom=ruche2&value_tempi=22.3&value_tempe=19.7&value_humidite=080&value_masse=44.5

$nom = htmlspecialchars( $_GET["nom"] );
$tempi =  htmlspecialchars( $_GET["value_tempi"] );
$tempe =  htmlspecialchars( $_GET["value_tempe"] );
$humidite =  htmlspecialchars( $_GET["value_humidite"] );
$masse =  htmlspecialchars( $_GET["value_masse"] );
$date = date('d-m-y h:i:s');

// affichage retour pour site de test uniquement
echo '<p> données reçues à la date du '.$date.'</p>';
echo '<p> Nom ruche: '.$nom.'</p>';
echo '<p> Température intérieure: '.$tempi.'</p>';
echo '<p> Température extérieure: '.$tempe.'</p>';
echo '<p> Humidité: '.$humidite.'</p>';
echo '<p> Masse: '.$masse.'</p>';


// vérification que les noms de ruches soient valides
 $tables_autorisees = ["ruche1", "ruche2"]; 
 
 // test validité de la variable $nom = nom de la ruche = nom de la table

 if ( in_array( $nom, $tables_autorisees)) {
    

   // connexion à la base ruches avec les identifiants de ruche_user
   $link = mysqli_connect("localhost", "ruche_user", "ruche_user", "ruches" );
   // si connexion OK
   if ( $link ) {

        echo '<p> connexion à la BDD OK </p>';
        
        $resultat = mysqli_query ( $link, "INSERT INTO `$nom` ( nom, date, temp_int, temp_ext, humidite, masse ) VALUES ( '".$nom."','".$date."',".$tempi." , ".$tempe." , ".$humidite.", ".$masse.")"  );
        
        if ($resultat) {
            echo "Données insérées avec succès.";
        } 
        
        // siNon erreur d'insertion
	    else 
        
        {
            echo "Erreur lors de l'insertion : " . mysqli_error($link);
        }

        // fermeture de la connexion à la base de données
        mysqli_free_result($link);
        mysqli_close($link); 
                      
    }

 }
// siNon = nom ruche pas autorisée
 else {

    echo "Table non autorisée.";

 }

?>