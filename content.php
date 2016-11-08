<style type="text/css">


.ucesnik{
    margin: 20px 0;
}

.prosao{cursor: pointer;}
.prosao>.periodi{display: none;}

</style>


<script type="text/javascript">
    
    $(".event a, span.event ").on('click tap',function(ev) {
        ev.preventDefault();

        var el_temp = $(this);

        if(this.tagName=="A"){

            el_temp = $(this).parent().parent();
        }


        console.log(el_temp);
        el_temp.next().toggleClass('hidden', 1000);

    })


    $(function() {
        $(".prosao").on("click tap", function (ev) {
            $(this).children('.periodi').toggle();
        })
    })
    
</script>


<div id="content-inner">

    <?php  
            include_once 'misc/array_group_by.php';
            include_once 'misc.php';


            $ceo_tekst = "";

            $var_podaci = file_get_contents("http://program.nedeljaparlamentarizma.rs/api/events") ;                   
            $niz_podataka = json_decode($var_podaci);

            

            $var_ucesnici = file_get_contents("http://program.nedeljaparlamentarizma.rs/api/speakerswithevents") ; 
            $ucesnici = json_decode( $var_ucesnici );

            //vrati samo one kojima eid nije null
            $not_null_ucesnici = array_filter($ucesnici, function ($el){
                return !empty($el->eid);
            });
               

            $not_null_ucesnici = array_reverse($not_null_ucesnici);         
               
            $temp_ucesnici = array_group_by($not_null_ucesnici,'eid');    

            $temp = array_group_by($niz_podataka,'edate','etime');

               
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
                            $id = md5($value->ename);

                        $temp_vals = boja_i_grad( $value->lcity );    

                        $boja = $temp_vals[0];
                        $mesto = $temp_vals[1];

                        $sadrzaj_detalji = detalji_eventa( $value, $temp_ucesnici[$value->eid]  );    


                        $unosi .= <<<UNOS
                            <span class="event $boja" mesto='$mesto' tag='{$value->etip}'>
                                <a href="{$value->elink}" class="name" id="$id">{$value->ename}<span class="vs">{$value->lcity}</span><span class="event-evpeople">{$value->epartneri} {$value->lname}, {$value->ladres} - {$value->lcity}</span></a>
                            </span> 
                            
                            <div class="hidden">
                                <br style="clear:both">
                                $sadrzaj_detalji
                                <br>
                                <a href="http://program.nedeljaparlamentarizma.rs/dogadjaj/{$value->eid}" target="_blank">Линк</a>    
                                <br style="clear:both">
                            </div> 
                            
UNOS;
                    } // end of unos; value

                  
                    $vreme =  substr($int_key,0,-3);

                    $jedan_period = <<<PERIOD
                        <div class="jedan_period">
                            <h3>$vreme</h3>
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
                        $dan = @strtotime($dan_mesec) ;
                        $formated_date = @date('d. m. Y.', $dan );
                        

                        $prosao = "";

                           

                        if($dan < time()  -(60*60*24)) 
                            $prosao = "prosao";

                       $main_template = <<<MAIN
                            <div class="jedan_dan $prosao" date="$dan_mesec">
                                <a class="container-anchor" id="$dan_mesec"></a>
        
                                <div class="container-header ">
                                    <div class="container-dates">
                                        <div class="current-date"><b>$dan_nedelja</b> $formated_date</div>
                                    </div>
                                </div>
                                <div class="container-top">&nbsp;</div>
                                <div class="periodi">
                                    $periodi
                                </div>
                                

                            </div>               

MAIN;
                   $ceo_tekst .= $main_template;
               }

                echo $ceo_tekst;

            ?>
</div>

