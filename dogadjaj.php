<?php  
	$id_dogadjaja = "4";
	if( is_numeric($_GET['evtid']) )
		$id_dogadjaja = $_GET['evtid'];
			
  	$var_podaci = file_get_contents("http://program.nedeljaparlamentarizma.rs/api/events/" . $id_dogadjaja) ;                   
    $niz_podataka = json_decode($var_podaci);
    $event = $niz_podataka[0];

    $naslov = $event->ename ;              

    $var_ucesnici = file_get_contents("http://program.nedeljaparlamentarizma.rs/api/events/".$id_dogadjaja."/speakers/") ; 
    $ucesnici = json_decode($var_ucesnici);
	
	
	// meni koji vraca na zbirni prikaz

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?php echo $naslov; ?> | Недељa парламентаризма</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap-custom.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="style2.css">
</head>

<body>


    <div class="container-inner">

<?php  

 include_once 'misc/array_group_by.php';
            include_once 'misc.php';

                $sadrzaj_detalji = detalji_eventa( $event, $ucesnici );    


                $unosi .= <<<UNOS
                    <span class="event $boja" mesto='$mesto' tag='{$event->etip}'>
                        <a href="{$event->elink}" class="name" id="$id">{$event->ename}<span class="vs">{$event->lcity}</span><span class="event-evpeople">{$event->epartneri} {$event->lname}, {$event->ladres} - {$event->lcity}</span></a>
                    </span> 
                    
                    <div class="hidden">
                        <br style="clear:both">
                        $sadrzaj_detalji
                        <br style="clear:both">
                    </div> 
                            
UNOS;

echo "$unosi";

?>

       
        <br style="clear:both"> </div>
</body>

</html>
