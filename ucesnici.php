<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ucesnici</title>

	<link rel="stylesheet" href="css/bootstrap-custom.css">
	<link rel="stylesheet" href="style2.css">
</head>
<body>


<div class="container-inner container-wide">
    <div class="container-people">

	<?php 

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
	$kompanija = $ucesnik->sdesc;
	$pozicija = "";

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

?>

	
</body>
</html>