<script type="text/javascript">
    
let podaci = [
{    
    grad:"beograd",
    mesto:"dom omladine",
    pocetak:"10:30",
    datum:"2016-10-07",
    ucesnici:"neki tamo",
    naziv:"glavni naslov",
    opis:"Opis dogadjaja koji se desava",
    link:"http://www.google.com"
}
];



</script>


<div id="content-inner">

    <?php  
            include_once 'misc/array_group_by.php';
            
            $var_podaci =<<<POD
            [{    
                "grad":"beograd",
                "mesto":"dom omladine",
                "pocetak":"10:30",
                "datum":"2016-10-07",
                "ucesnici":"neki tamo",
                "naziv":"Neki dugacak naslov sa elementima svega glavni naslov",
                "opis":"Opis dogadjaja koji se desava",
                "link":"http://www.google.com"
            },
            {    
                "grad":"subotica",
                "mesto":"dom omladine",
                "pocetak":"10:30",
                "datum":"2016-10-07",
                "ucesnici":"neki tamo",
                "naziv":"glavni naslov",
                "opis":"Opis dogadjaja koji se desava",
                "link":"http://www.google.com"
            },
            {    
                "grad":"beograd",
                "mesto":"dom omladine",
                "pocetak":"11:30",
                "datum":"2016-10-07",
                "ucesnici":"neki tamo",
                "naziv":"Opis dogadjaja koji se desava u Beogradu u domu omladine",
                "opis":"Opis dogadjaja koji se desava",
                "link":"http://www.google.com"
            },
            {    
                "grad":"beograd",
                "mesto":"sava centar",
                "pocetak":"10:30",
                "datum":"2016-10-07",
                "ucesnici":"neki tamo",
                "naziv":"glavni naslov",
                "opis":"Opis dogadjaja koji se desava",
                "link":"http://www.google.com"
            }

            ]
POD;

$niz_podataka = json_decode($var_podaci);

                $temp = array_group_by($niz_podataka,'grad','pocetak');

                       
                $intervali = $temp['beograd'];

                //mora da ide grupisanje po danu i filtriranje po vremenima    
                
                        
                $periodi = '';
                

                foreach ($intervali as $int_key=>$interval_value) {
                    $unosi = "";

                    foreach ($interval_value as  $value) {
                        $id = md5($value->naziv);

                    $unosi .= <<<UNOS
                       <span class="event ev_2  ev_2_sub_2"><a href="{$value->link}" class="name" id="$id">{$value->naziv}<span class="vs">{$value->mesto}</span><span class="event-evpeople">{$value->opis}</span></a>
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
                    $dan_nedelja = "Ponedeljak";
                    $dan_mesec = "27 novembar";

                   $main_template = <<<MAIN
                    <a class="container-anchor" id="$datum"></a>

                        <div class="container-header ">
                            <div class="container-dates">
                                <div class="current-date"><b>$dan_nedelja</b>, $dan_mesec</div>
                            </div>
                        </div>
                        <div class="container-top">&nbsp;</div>

                        $periodi

                        

MAIN;
                    echo $main_template;
               

            ?>
</div>



