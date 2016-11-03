<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Говорници Недеље парламентаризма</title>
	<meta property="og:title" content="Програм Недеље парламентаризма"/>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="http://www.nedeljaparlamentarizma.rs/program/"/><meta property="og:site_name" content="Nedelja Parlamentarizma"/><meta property="og:image" content="http://nedeljaparlamentarizma.rs/wp-content/uploads/2016/11/np.png"/>

	<link rel="stylesheet" href="css/bootstrap-custom.css">
	<link rel="stylesheet" href="style2.css?3">
	<link rel="stylesheet" type="text/css" href="style.css">

	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.8.0/jquery.modal.min.js"></script>


	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.8.0/jquery.modal.min.css">
    

</head>
<body>


	<?php 

        $active_link = "ucesnici"; 
        include 'menu.php';

    ?>

<div class="container-inner container-wide">
    <div class="container-people">

	<?php 

	include_once 'misc/array_group_by.php';
	//kada se klikne na jednog
	//da se otvara popup sa njegovim detaljima

	$podaci = file_get_contents("http://program.nedeljaparlamentarizma.rs/api/speakerswithevents"); //speakers
	
	$podaci  = json_decode($podaci);

	$podaci  = array_group_by($podaci,'sid');
	

	foreach ($podaci as $key => $za_ucesnika) { //key <=> id ucesnika, 
		
		echo ucesnik($key , $za_ucesnika ); 
	}
	

	?>

    <br style="clear:both">
    </div>
    <br style="clear:both">
</div>


<?php  


function ucesnik($index, $podaci_ucesnik)
{
	$ucesnik = new stdClass();

	if(count($podaci_ucesnik) >= 1)
		$ucesnik = $podaci_ucesnik[0];
	else 
		return "";

	$link_ucesnik = "/acters/" . $ucesnik->sid;
	$ime_ucesnika = $ucesnik->sname;
	$slika_ucesnika =  "http://program.nedeljaparlamentarizma.rs/spkimages/". $ucesnik->simg;

	if( empty($ucesnik->simg) ) 
		$slika_ucesnika = "img/2poslanici.png";
	// $ucesnik->simg;
	$kompanija =  $ucesnik->sorg ; 
	$pozicija =  $ucesnik->stitula ; 

	$lista_eventova = "";

	foreach ($podaci_ucesnik as $value) {
		$id_event = $value->eid;
		$name_event = $value->ename;	
		$lista_eventova .= "<a href='events/$id_event'>$name_event</a> <br/>";
	}


	//$ucesnik->sdesc;
	
	$biografija = "some description ";/*"Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad quaerat ipsam corporis. Harum pariatur beatae delectus, porro similique accusantium quis ex earum quidem voluptates! Eveniet qui dicta necessitatibus aliquam harum.";*/

	$stampa_ucesnika = <<<LALA
		


		        <div class="person" >
		            <a class="avatar" href="#modal$index" rel="modal:open" title="$ime_ucesnika">
		            <span><img src="$slika_ucesnika" alt="avatar" ></span></a>
		            <h2><a href="#modal$index" rel="modal:open" title="Pogledajte profile i njihov raspored">
		             $ime_ucesnika</a></h2>
		            <div class="event-details-role">
		                <div class="event-details-company">$kompanija
		                    <br>
		                </div>
		                <div class="event-details-position">
		                    $pozicija </div>
		            </div>

		        </div>


		        <div class="person" id="modal$index" style="display:none;">
		            
		            <span><img src="$slika_ucesnika" alt="avatar" style="max-width: 200px;"></span>
		            <h2>$ime_ucesnika</h2>
		            <div class="event-details-role">
		                <div class="event-details-company">$kompanija
		                    <br>
		                </div>
		                <div class="event-details-position">
		                    $pozicija </div>
		            </div>
					
					<div id="page-me-profile-about" >
		            	$lista_eventova
		            </div>

					<a href="#" rel="modal:close" style="float:right">Close</a>
		        </div>




		        
LALA;

	return $stampa_ucesnika;
}



?>


</body>
</html>