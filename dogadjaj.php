<?php  

 	include_once 'misc/array_group_by.php';
    include_once 'misc.php';

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

    $boja_i_grad = boja_i_grad($event->lcity);
    $boja = $boja_i_grad [0];

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title><?php echo $naslov; ?> | Недељa парламентаризма</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap-custom.css">
    <link rel="stylesheet" type="text/css" href="../style.css">
    <link rel="stylesheet" type="text/css" href="../style2.css">

    <style type="text/css">
		.ucesnik {
		    display: inline-block;
		    margin: 0 10px;
		}
		h2{
		    margin-left: 150px;
		}
		.event-type{
		    text-align: center;
		}

		.tip-description{
			padding: 20px;
		}

		.event{
			margin: 10px;
			padding: 10px;
		}
		.tip-roles > div > div:nth-child(5) {
			margin: 20px;
		}

		a{
			color: black;
		}

    </style>
</head>

<body>


    <div class="container-inner">

<?php  


                $sadrzaj_detalji = detalji_eventa( $event, $ucesnici );    

                $sadrzaj_detalji = str_replace("img/2poslanici.png","../img/2poslanici.png",$sadrzaj_detalji)	;


                $unosi .= <<<UNOS
                    <span class="event $boja" mesto='$mesto' tag='{$event->etip}'>
                       {$event->ename}<span class="vs">{$event->lcity}</span><span class="event-evpeople">{$event->epartneri} {$event->lname}, {$event->ladres} - {$event->lcity}</span>
                    </span> 
                    
                    <div class="">
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
