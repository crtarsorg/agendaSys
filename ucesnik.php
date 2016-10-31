<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ucesnik</title>
</head>
<body>
	
<div class="container-inner container-wide">

	<?php echo ucesnik(); ?>
</div>

<?php  

function ucesnik()
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
	

</body>
</html>