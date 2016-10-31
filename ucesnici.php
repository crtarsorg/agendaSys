<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ucesnici</title>
</head>
<body>


<div class="container-inner container-wide">
    <div class="container-people">

	<?php echo ucesnik("la"); ?>

    <br style="clear:both">
    </div>
    <br style="clear:both">
</div>


<?php  


function ucesnik($ucesnik)
{
	$link_ucesnik = "http://google.com";
	$ime_ucesnika = "Petrovic Petar";
	$slika_ucesnika = "";
	$kompanija = "";
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