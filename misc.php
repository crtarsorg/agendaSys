<?php 


    function listaMesta($podaci)
    {
        $samo_gradovi = array_map(function ($el)
        {
            return $el->grad;
        } , $podaci);

        $samo_gradovi = array_unique($samo_gradovi);

        return $samo_gradovi;      
    }

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


    function boja_i_grad( $grad_val='' )
    {
        $temp_vals =  array( );

        switch ($grad_val) {
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

        $temp_vals[] = $boja;
        $temp_vals[] = $mesto;

        return $temp_vals;

    }

?>