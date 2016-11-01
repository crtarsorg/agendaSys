<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ucesnici</title>

	<link rel="stylesheet" href="css/bootstrap-custom.css">
	<link rel="stylesheet" href="style2.css">

	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    

</head>
<body>


<div class="container-inner container-wide">
    <div class="container-people">

	<?php 

	//kada se klikne na jednog
	//da se otvara popup sa njegovim detaljima

	$podaci = file_get_contents("http://program.nedeljaparlamentarizma.rs/api/speakers"); //speakers

	$podaci  = json_decode($podaci);

	foreach ($podaci as  $ucesnik) {
		echo ucesnik( $ucesnik ); 
	}
	

	?>

    <br style="clear:both">
    </div>
    <br style="clear:both">
</div>


<?php  


function ucesnik($ucesnik)
{
	$link_ucesnik = "/acters/" . $ucesnik->sid;
	$ime_ucesnika = $ucesnik->sname;
	$slika_ucesnika = "http://lorempixel.com/g/300/300/people";
	// $ucesnik->simg;
	$kompanija = $ucesnik->sorg ; 
	$pozicija = $ucesnik->stitula ; 

	$stampa_ucesnika = <<<LALA
		


		        <div class="person">
		            <a class="avatar" href="$link_ucesnik" title="$ime_ucesnika">
		            <span><img src="$slika_ucesnika" alt="avatar" ></span></a>
		            <h2><a href="$link_ucesnik" title="Pogledajte profile i njihov raspored">
		             $ime_ucesnika</a></h2>
		            <div class="event-details-role">
		                <div class="event-details-company">$kompanija
		                    <br>
		                </div>
		                <div class="event-details-position">
		                    $pozicija </div>
		            </div>
		        </div>




		        
LALA;

	return $stampa_ucesnika;
}


	function ucesnik1()
	{
		

	$link = "http://google.com";
	$ime_ucesnika = "Petar Petrovic";
	$kompanija = "crta";
	$pozicija = "Levo";
	$biografija = "desno";

	$temp =  <<<LALA

		    <div id="page-me-profile">
		        <span id="page-me-profile-avatar"><span><img src="$link" alt="avatar"  ></span></span>
		        <h1 id="page-me-name">$ime_ucesnika</h1>
		        <div id="page-me-profile-data" class="event-details-role-company">
		            <strong>$komanija</strong>
		            <br> $pozicija
		            <br>
		        </div>
		        <div id="page-me-profile-about">
		            <strong>Biografija:</strong> $biografija
		            <br>
		            <br> </div>
		    </div>
LALA;

	return $temp ;
	}

?>

	<script>
		$(function() {

			$(".person a").click(function(ev) {
				ev.preventDefault();

				alert("asdad")
			});
		})
	</script>
</body>
</html>