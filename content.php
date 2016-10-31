<style type="text/css">

.boja1{background-color: #2077B4; } 
.boja2{background-color: #B0E0F8; } 
.boja3{background-color: #7660AA; } 
.boja4{background-color: #D67896; } 
.boja5{background-color: #CB99C5; } 
.boja6{background-color: #FEDDBD; } 
.boja7{background-color: #FFDF80; } 
.boja8{background-color: #DFBD2C; } 
.boja9{background-color: #A3D17C; } 
.boja10{background-color: #54B954; } 


.boja10{background-color: #2BBAA6 ; } 
.boja11{background-color: #1CBECF ; } 
.boja12{background-color: #7DCCC3 ; } 
.boja13{background-color: #F37F6D ; } 
.boja14{background-color: #F8B8A9 ; } 
.boja15{background-color: #CBBF8E ; } 
.boja16{background-color: #C7C6C6 ; } 
.boja17{background-color: #9E9893 ; } 
.boja18{background-color: #4E777F ; } 
.boja19{background-color: #626262 ; } 


</style>


<script type="text/javascript">
    
    $(".event a").click(function(ev) {
        ev.preventDefault();

         $(this).parent().next().toggleClass('hidden', 1000);

    })
</script>


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
                
                        
                
                
                foreach ($dani as $dan_key => $intervali) {
                    
                

                //sortiranje po vremenu u jednom danu
                ksort($intervali);

                    $periodi = '';

                    foreach ($intervali as $int_key=>$interval_value) {
                       
                        $unosi = "";
                        foreach ($interval_value as  $value) {
                            $id = md5($value->naziv);

                        switch ($value->grad) {
                            case "Beograd": $boja = 'boja1'; $mesto="beograd";  break;
                            case "Nis": $boja = 'boja2'; $mesto="nis"; break;
                            case "Subotica": $boja = 'boja3'; $mesto="subotica"; break;
                            case "Novi Sad": $boja = 'boja4'; $mesto="novi_sad"; break;
                            case "Uzice": $boja = 'boja5'; $mesto="uzice"; break;
                            case "Prijepolje": $boja = 'boja6'; $mesto="prijepolje"; break;
                            case "Leskovac": $boja = 'boja7'; $mesto="leskovac"; break;
                             
                                
                                default:
                                    # code...
                                    break;
                            }    

                        $sadrzaj_detalji = detalji_eventa( $id_event );    


                        $unosi .= <<<UNOS
                            <span class="event $boja" mesto='$mesto' tag='{$value->tip}'>
                                <a href="{$value->link}" class="name" id="$id">{$value->naziv}<span class="vs">{$value->mesto}</span><span class="event-evpeople">{$value->opis}</span></a>
                            </span> 
                            
                            <div class="hidden">
                                <br style="clear:both">
                                $sadrzaj_detalji
                                <br style="clear:both">
                            </div> 
                            
UNOS;
                    } // end of unos; value

                  


                    $jedan_period = <<<PERIOD
                        <div class="jedan_period">
                            <h3>$int_key</h3>
                            <div class="container">
                                <div class="container-inner">
                                    $unosi  

                                <br style="clear:both"> </div>
                            </div>
                        </div>
PERIOD;

                    $periodi .= $jedan_period;

                    } // end of intervali

                        //ok ima samo niz dana i datuma, tako da nije previse tesko
                        $dan_nedelja = "";
                        $dan_mesec = $dan_key ;

                       $main_template = <<<MAIN
                            <div class="jedan_dan" date="$dan_mesec">
                                <a class="container-anchor" id="$dan_mesec"></a>
        
                                <div class="container-header ">
                                    <div class="container-dates">
                                        <div class="current-date"><b>$dan_nedelja</b> $dan_mesec</div>
                                    </div>
                                </div>
                                <div class="container-top">&nbsp;</div>

                                $periodi

                            </div>               

MAIN;
                   $ceo_tekst .= $main_template;
               }

                echo $ceo_tekst;

            ?>
</div>






<?php 

    function detalji_eventa( $id_event )
    {


        $opis_dogadjaja ="par reci o dogadjaju";
        $link_ucesnik ="http://www.google.com";
        $ime_ucesnika = "Mario Maric";
        $biografija = "par recu o ucesniku";
        $koordinate_mesta = "20, 44";
        $slika_ucesnika = "https://placeholdit.imgix.net/~text?txtsize=28&bg=0099ff&txtclr=ffffff&txt=Neki kul header ovde&w=320&h=320&fm=png";

        $temp_sadrzaj = <<<TEMP_SADR

        <div class="">
    
            <hr style="clear:both">

            <div class="tip-roles">
                <strong>Učesnici</strong>
                <div class="event-details-roles has-avatars">
                    
                    <div class="scrollable-details">
                        <div class="tip-description">
                        $opis_dogadjaja
                        </div>
                    </div>

                    <div class="person">
                        <a class="avatar" href="$link_ucesnik">
                            <span>
                                <img src="$slika_ucesnika" alt="avatar" >
                            </span>
                        </a>
                        <h2><a href="$link_ucesnik">$ime</a></h2>
                       
                        <div class="event-details-role-bio">$biografija</div>
                    </div>
                    
                    
                    
                    
                </div>
                <br class="s-clr">
            </div>
            <hr style="clear:both">
            
            <div class="event-type">
                $koordinate_mesta
            </div>
            
        </div>

TEMP_SADR;

return $temp_sadrzaj;
    }

?>