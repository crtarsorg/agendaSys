<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, GET, POST");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
?>

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



	<meta property="og:title" content="<?php echo $naslov; ?> | Недељa парламентаризма"/>
    
    <meta property="og:description" content="Погледајте детаље за догађај <?php echo $naslov; ?>">
    <meta property="og:url" content="http://www.nedeljaparlamentarizma.rs/program/"/>
    <meta property="og:site_name" content="Nedelja Parlamentarizma"/>
    <meta property="og:image" content="http://nedeljaparlamentarizma.rs/wp-content/uploads/2016/11/np.png"/>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap-custom.css">
    <link rel="stylesheet" type="text/css" href="../style.css">
    <link rel="stylesheet" type="text/css" href="../style2.css">
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

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
		#logo-orginal{
		    max-width: 30%;
		    display: inline-block;
		}
		.logo-description{
		    top: 15px;
    		position: absolute;
		    display: inline-block;
		    /* float: right; */
		    max-width: 50%;
		    margin: 10px 50px;
		}
		.logo-container{
		    width: 85%;
		    margin: auto;
			}

    </style>

    <script>
    	$(function() {
    		if(window.location == window.parent.location)
    			/*(window.location.href.indexOf("program.nedelja") > 0)*/ {
    			$("#header-dogadjaj").show()
    		}

    	console.log(window.parent.location);	

    	})
    </script>
</head>

<body>


	<div id="header-dogadjaj" style="display: none">
    <div class="main-menu-container" style="display: none;">
        <div class="menu-main-menu-container">
            <ul id="menu-main-menu" class="menu">
                <li id="menu-item-8" class=""><a href="http://www.nedeljaparlamentarizma.rs/">Почетна</a></li>
                <li id="menu-item-62" class=""><a href="http://www.nedeljaparlamentarizma.rs/o-nama/">О нама</a></li>
                <li id="menu-item-908" class=""><a href="http://www.nedeljaparlamentarizma.rs/program/">Програм 2016</a></li>
                <li id="menu-item-766" class=""><a href="http://www.nedeljaparlamentarizma.rs/category/vesti-2016/">Вести</a></li>
                <li id="menu-item-51" class=""><a href="http://www.nedeljaparlamentarizma.rs/partneri/">Партнери</a></li>
                <li id="menu-item-85" class=""><a href="http://www.nedeljaparlamentarizma.rs/kontakt/">Kонтакт</a></li>
                <li id="menu-item-723" class=""><a href="#">2015</a>
                    <ul class="sub-menu">
                        <li id="menu-item-724" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-724"><a href="http://www.nedeljaparlamentarizma.rs/category/dogadjaji-2015/">Dogadjaji</a></li>
                        <li id="menu-item-725" class="menu-item menu-item-type-taxonomy menu-item-object-category menu-item-725"><a href="http://www.nedeljaparlamentarizma.rs/category/vesti-2015/">Vesti</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        
    </div>
    
    <div class="logo-container">
        <div id="logo-orginal" class="">
            <a href="http://www.nedeljaparlamentarizma.rs/"><img src="http://www.nedeljaparlamentarizma.rs/wp-content/themes/responsive/img/недеља-парламентаризма-лого.png" alt="Nedelja Parlamentarizma"></a>
        </div>
        
        <div class="logo-description">“Недеља парламентаризма је серија догађаја и активности којима се отвара форум за разговор о парламентарној демократији и учешћу грађана у демократским процесима.”</div>
    </div>
</div>

<div id="container-header-menu">
    <ul>
        <li id="menu-link-schedule" class="menu-link">
            <a href="../index.php" class="menu-link-active">Распоред</a>
        </li>
        <li id="menu-speakers" class="menu-link"><a href="../ucesnici.php" class="">Говорници</a></li>
        
    </ul>
    <br class="s-clr">
</div>




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
