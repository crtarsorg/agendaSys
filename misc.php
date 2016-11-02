<?php 


    function listaMesta($podaci)
    {
        $samo_gradovi = array_map(function ($el)
        {
            return trim($el->lcity);
        } , $podaci);

        $samo_gradovi = array_unique($samo_gradovi);

        return $samo_gradovi;      
    }


    function ucesnik( $user='' )
    {

               
        

        $slika_ucesnika = 
            "http://program.nedeljaparlamentarizma.rs/spkimages/". $user->simg;

        if( empty( $user->simg )  )
            $slika_ucesnika = "img/2poslanici.png";
        $link_ucesnik ="#"; //kad bude napravljenja stranica za svakog ucesnika pojedinacno
        $ime_ucesnika = $user->sname;
        $biografija = "";
        $org = $user->sorg;
        $pozicija = $user->stitula;

        return <<<ORD
            <div class="ucesnik">
                <a  href="$link_ucesnik">
                    <img class="avatar" src="$slika_ucesnika" alt="avatar">                            
                </a>
                <div>
                    <h2><a href="$link_ucesnik">$ime_ucesnika</a></h2>
               
                    <div class="event-details-role">
                        <div class="event-details-company">$org
                            <br>
                        </div>
                        <div class="event-details-position">
                            $pozicija </div>
                    </div>

                </div>
            </div>

ORD;
    }

    function detalji_eventa( $event, $ucesnici )
    {
        //AIzaSyCIqFRtib8fmSMLKsEPzbQ5AREGUnhUTNQ
        

        $opis_dogadjaja = $event->edesc;
        
        $koordinate_mesta = $event->lcoordx . ",".$event->lcoordy;
        if(empty($event->lcoordx ))
            $koordinate_mesta = "44.820517,20.427263";

        $link_koord = str_replace(",","+", $koordinate_mesta);

        $korisnici = "";
        

        for ($i=0; $i < count($ucesnici) ; $i++) { 
            $korisnici .= ucesnik( $ucesnici[ $i ] );
        } 


        $mapa = '<img src="https://maps.googleapis.com/maps/api/staticmap?center='. $koordinate_mesta .'&zoom=16&size=400x400&markers=color:blue%7Clabel:S%7C'. $koordinate_mesta .'&markers=size:tiny%7Ccolor:green%7CDelta+Junction,AK&markers=size:mid%7Ccolor:0xFFFF00%7Clabel:C%7CTok,AK&key=AIzaSyCIqFRtib8fmSMLKsEPzbQ5AREGUnhUTNQ" alt="">';




        $temp_sadrzaj = <<<TEMP_SADR

        <div class="">
    
            <hr style="clear:both">

            <div class="tip-roles">
                
                <div class="event-details-roles has-avatars">
                    
                    <div class="scrollable-details">
                        <div class="tip-description">
                        $opis_dogadjaja
                        </div>
                    </div>
                    
                    <hr style="clear:both">

                    <strong>Učesnici</strong>
                    
                    $korisnici    

                </div>
                <br class="s-clr">
            </div>
            <hr style="clear:both">
            
            <div class="event-type">                
                
                <a href="http://maps.google.com/maps?&z=16&q=$link_koord&ll=$link_koord" target='_blank'>
                $mapa      
                </a>           
            </div>
            
        </div>

TEMP_SADR;

    return $temp_sadrzaj;
    }


    function boja_i_grad( $grad_val='' )
    {
        #problem je kako numerisati boje kad im se salje samo jedna vrednost
        
        # verovatno treba niz svih gradova i, na osnovu indeksa staviti da bude ta boja 

        /*$grad_val = strtolower($grad_val);
        $grad_val = str_replace(' ','_',$grad_val);
        //replace ćčšžđ
        $grad_val = str_replace(array('ć','č','š','ž','đ'), array('c','c','s','z','dj'), $grad_val);*/

        $temp_vals =  array( );

        switch ( trim($grad_val)) {
            case "Београд":$boja = 'boja1';$mesto="beograd";break;
            case "Ниш":$boja = 'boja2';$mesto="nis";break;
            case "Панчево":$boja = 'boja3';$mesto="pancevo";break;
            case "Азања":$boja = 'boja4';$mesto="azanja";break;
            case "Рашка":$boja = 'boja5';$mesto="raska";break;
            case "Бујановац":$boja = 'boja6';$mesto="bujanovac";break;
            case "Зрењанин":$boja = 'boja7';$mesto="zrenjanin";break;
            case "Трстеник":$boja = 'boja8';$mesto="trstenik";break;
            case "Пожаревац":$boja = 'boja9';$mesto="pozarevac";break;
            case "Кикинда":$boja = 'boja10';$mesto="kikinda";break;
             
            default:
                    # code...
                    break;
        }   

        $temp_vals[] = $boja;
        $temp_vals[] = $mesto;

        return $temp_vals;

    }



    function tipovi_dogadjaja($tip_dogadjaja='')
    {

              
        
         switch ($tip_dogadjaja) {
             case "Панел дискусија": $tip = "панел дискусија";break;
             case "Дебата": $tip = "дебата";break;
             case "Дан отворених врата": $tip = "дан отворених врата";break;
             case "Едукативна радионица": $tip = "едукативна радионица";break;
             case "Неформални састанак": $tip = "неформални састанак";break;
             case "Трибина": $tip = "трибина";break;
             case "Симулација седнице": $tip = "симулација седнице";break;
             case "Инфо сесија": $tip = "инфо сесија";break;
             case "Презентација": $tip = "презентација";break;
             case "Округли сто": $tip = "округли сто";break;
             case "Улична акција": $tip = "улична акција";break;

             
            default:
                    # code...
                    break;
        }   

        return $tip_dogadjaja;
    }


    function tipovi( $niz ='' )
    {
        $tipovi = array_map(function ($el)
        {
            return $el->etip;
        } , $niz);

        $tipovi = array_unique($tipovi);

        return $tipovi;  
    }

?>