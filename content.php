<style type="text/css">
    .boja1{background-color: red;}
    .boja2{background-color: blue;}
    .boja3{background-color: green;}
    .boja4{background-color: grey;}
    .boja5{background-color: orange;}
    .boja6{background-color: yellow;}
    .boja6{background-color: brown;}

</style>



<div id="content-inner">

    <?php  
            include_once 'misc/array_group_by.php';
            


            $ceo_tekst = "";

            $var_podaci = file_get_contents("data.json") ;

                   
            $niz_podataka = json_decode($var_podaci);

            

                $temp = array_group_by($niz_podataka,'datum','pocetak');

                   
                //XXX ovo radi kad su dani jednog meseca u pitanju    
                uksort($temp , function($a, $b) {
                    return explode('-',$a)[2] > explode('-',$b)[2];
                });

                      
                

                $dani = $temp ; //array_reverse($temp) ;//['beograd'];

                //mora da ide grupisanje po danu i filtriranje po vremenima    
                
                        
                $periodi = '';
                
                foreach ($dani as $dan_key => $intervali) {
                    
                $unosi = "";

                //sortiranje po vremenu u jednom danu
                ksort($intervali);

                    foreach ($intervali as $int_key=>$interval_value) {
                       

                        foreach ($interval_value as  $value) {
                            $id = md5($value->naziv);

                        switch ($value->grad) {
                            case "Beograd": $boja = 'boja1'; break;
                            case "Nis": $boja = 'boja2'; break;
                            case "Subotica": $boja = 'boja3'; break;
                            case "Novi Sad": $boja = 'boja4'; break;
                            case "Uzice": $boja = 'boja5'; break;
                            case "Prijepolje": $boja = 'boja6'; break;
                            case "Leskovac": $boja = 'boja7'; break;
                             
                                
                                default:
                                    # code...
                                    break;
                            }    

                        $unosi .= <<<UNOS
                           <span class="event $boja"><a href="{$value->link}" class="name" id="$id">{$value->naziv}<span class="vs">{$value->mesto}</span><span class="event-evpeople">{$value->opis}</span></a>
                            </span>  
UNOS;
                    }

                  


                    $jedan_period = <<<PERIOD
                        <h3>$int_key</h3>
                            <div class="container">
                                <div class="container-inner">
                                    $unosi  

                                <br style="clear:both"> </div>
                                </div>
PERIOD;

                    $periodi .= $jedan_period;

                    }

                        //ok ima samo niz dana i datuma, tako da nije previse tesko
                        $dan_nedelja = "";
                        $dan_mesec = $dan_key ;

                       $main_template = <<<MAIN
                        <a class="container-anchor" id="$datum"></a>

                            <div class="container-header ">
                                <div class="container-dates">
                                    <div class="current-date"><b>$dan_nedelja</b> $dan_mesec</div>
                                </div>
                            </div>
                            <div class="container-top">&nbsp;</div>

                            $periodi

                            

MAIN;
                   $ceo_tekst .= $main_template;
               }

                echo $ceo_tekst;

            ?>
</div>



