<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ucesnici</title>

	<link rel="stylesheet" href="css/bootstrap-custom.css">
	<link rel="stylesheet" href="style2.css">

	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.8.0/jquery.modal.min.js"></script>


	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.8.0/jquery.modal.min.css">
    

</head>
<body>


<div class="container-inner container-wide">
    <div class="container-people">

	<?php 

	//kada se klikne na jednog
	//da se otvara popup sa njegovim detaljima

	$podaci = file_get_contents("http://program.nedeljaparlamentarizma.rs/api/speakers"); //speakers

	$podaci  = json_decode($podaci);

	foreach ($podaci as $key => $ucesnik) {
		echo ucesnik($key , $ucesnik ); 
	}
	

	?>

    <br style="clear:both">
    </div>
    <br style="clear:both">
</div>


<?php  


function ucesnik($index, $ucesnik)
{
	$link_ucesnik = "/acters/" . $ucesnik->sid;
	$ime_ucesnika = $ucesnik->sname;
	$slika_ucesnika = "http://lorempixel.com/g/300/300/people";
	// $ucesnik->simg;
	$kompanija = "organizacija";// $ucesnik->sorg ; 
	$pozicija = "pozicija"; $ucesnik->stitula ; 


	//$ucesnik->sdesc;
	
	$biografija = "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad quaerat ipsam corporis. Harum pariatur beatae delectus, porro similique accusantium quis ex earum quidem voluptates! Eveniet qui dicta necessitatibus aliquam harum.";

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
		            
		            <span><img src="$slika_ucesnika" alt="avatar" ></span>
		            <h2>$ime_ucesnika</h2>
		            <div class="event-details-role">
		                <div class="event-details-company">$kompanija
		                    <br>
		                </div>
		                <div class="event-details-position">
		                    $pozicija </div>
		            </div>
					
					<div id="page-me-profile-about" >
		            	dogadjaji na kojima ucestvuje

		            	
		            </div>

					<a href="#" rel="modal:close">Close</a>
		        </div>




		        
LALA;

	return $stampa_ucesnika;
}



?>


</body>
</html>