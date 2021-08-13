<?php

class Request
{

//     function findAllRealCalls(){
//        $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
//        $db = new PDO('mysql:host=localhost;dbname=tickets_appel', 'root', '', $options);
//
//        $array = array();
//        $sql =  'SELECT date,type,duree_volume_reel FROM data_tickets WHERE type LIKE "%appel%" AND date >= 15-02-2012';
//        $query = $db->query($sql);
//        $midnight = strtotime("0:00");
//
////        var_dump($query);die();
//        foreach  ($query as $row) {
//            $array[] .= $row['duree_volume_reel'];
////            var_dump($array);
//            foreach ($array as $line)
//            {
//
//            }
//        }
//
//        return $sum;
//    }

    public function getCountSmsAllClient()
    {
        $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
        $db = new PDO('mysql:host=localhost;dbname=tickets_appel', 'root', '', $options);

        $sql = 'SELECT type FROM data_tickets WHERE type LIKE "%sms%"';
        $query = $db->query($sql);

        $count = 0;

        foreach ($query as $sms) {
            $count += 1;
        }

        echo $count;
    }

    public function getTop10DataFacturerByAbonne()
    {
        $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
        $db = new PDO('mysql:host=localhost;dbname=tickets_appel', 'root', '', $options);

        $sql = "SELECT abonne, duree_volume_facture FROM data_tickets  WHERE NOT (heure BETWEEN '08:00' AND '18:00') order by abonne,duree_volume_facture desc;";
        $query = $db->query($sql);
        foreach ($query as $key => $line)
        {
            echo 'Abonné ' . $line[0] . ' Volume Data Facturé : ' . $line[1] . '<br>';       }
    }
}