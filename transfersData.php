<?php
include_once 'connexionDb.php';
define("ARRAY_CHUNK_LENGHT",     150);

function transfersCSVtoMysql(){
    // initialise time
    $t0 = time();
    // set 2 variables for start at line 4
    $lineNo = 0;
    $startLine = 4;

    //connexion database
    $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
    $db = new PDO('mysql:host=localhost;dbname=tickets_appel', 'root', '', $options);
    // Read a CSV file
    $handle = fopen("tickets_appels_201202.csv", "r");

// the loop its currently iterating over
    $lineNumber = 1;

// Iterate over every line of the file
    while (($raw_string = fgets($handle)) !== false) {
        // encode in UTF-8 every row
        $raw_string = utf8_encode($raw_string);

        $lineNo++;

        if ($lineNo >= $startLine){

            // transform a string into an array
            $row = explode(';', $raw_string);

            // check data
            if (!is_numeric($row[2])){
                continue;
            }

            //
            $numAbo = addTild($row[2]);
            $date = addTild($row[3]);
            $hours = addTild($row[4]);
            $realTimeVolume = addTild($row[5]);
            $realTimeCharge = addTild($row[6]);
            $type = addTild($row[7]);

            $imports[] = array($numAbo,$date,$hours,$realTimeVolume,$realTimeCharge,$type);
            }

        // Increase the current line
        $lineNumber++;
    }
    // Separates an array into smaller arrays
    $importarrays = array_chunk($imports, ARRAY_CHUNK_LENGHT);

    $z = 0;
    foreach($importarrays as $arr) {
        $sql = "INSERT INTO `data_tickets` (`abonne`, `date`, `heure`, `duree_volume_reel`, `duree_volume_facture`, `type`) VALUES ";
        $max = count($arr);
        $i = 0;
        foreach ($arr as $line)
        {
            $i++;$z++;
            $sql .= "(" . implode(',',$line) .")";
            if ($i < $max){
                $sql .= ', ';
            }

        }
        try {
            $query = $db->prepare($sql);
            $query->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    fclose($handle);
    $t1 = time();
    echo('La fonction a pris ' . ($t1 - $t0) . ' seconde(s) pour s\'executer. <br>');
    echo $z . " lignes on été insérées.";

}

/**
 * @param $string
 * @return string
 */
 function addTild($string)
{
//    return '"'. $string .'"';
    return "'". addslashes($string)."'";
}
?>